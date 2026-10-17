<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Document;
use App\Models\Education;
use App\Models\Practice;
use App\Services\KtaService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB; // 🆕 TAMBAHAN
use Illuminate\Support\Str;
use Mpdf\Mpdf;

class ProfileDokterController extends Controller
{
    public function index(KtaService $kta)
    {
        $anggota = Anggota::where('user_id', Auth::id())->first();

        if (!$anggota) {
            return redirect()->back()->with('error', 'Data anggota tidak ditemukan');
        }

        // Load documents
        $documents = Document::where('user_id', Auth::id())->orderBy('upload_date', 'desc')->get();

        // Load educations dengan sorting berdasarkan tahun mulai
        $educations = Education::byAnggota($anggota->id)
            ->orderBy('start_year', 'desc')
            ->get();

        // Load practices dengan sorting berdasarkan tanggal mulai
        $practices = Practice::byAnggota($anggota->id)
            ->orderBy('start_date', 'desc')
            ->get();

        $profilePercentage = $anggota->getProfilePercentage();
        $progressColor = $anggota->getProgressColor();

        $ktaData = $anggota->no_kartu_anggota ? $kta->cardData($anggota, false) : null;

        return view('member.profile-dokter', compact('anggota', 'documents', 'educations', 'practices', 'profilePercentage', 'progressColor', 'ktaData'));
    }

    /**
     * Anggota milik user login yang sudah punya nomor kartu (sudah disetujui).
     */
    private function anggotaWithKta(): ?Anggota
    {
        return Anggota::where('user_id', Auth::id())->whereNotNull('no_kartu_anggota')->first();
    }

    // Download KTA (PDF, 2 halaman ukuran kartu: depan & belakang)
    public function downloadCardPDF(KtaService $kta)
    {
        $anggota = $this->anggotaWithKta();

        if (!$anggota) {
            return redirect()->back()->with('error', 'Kartu anggota belum tersedia. Akun Anda belum diverifikasi.');
        }

        try {
            return $kta->pdf($anggota)->download($kta->filename($anggota, 'Lengkap', 'pdf'));
        } catch (\Exception $e) {
            Log::error('Error PDF: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal membuat PDF: ' . $e->getMessage());
        }
    }

    // Alternative method using mPDF (if you prefer)
    public function downloadCardPDFMpdf()
    {
        $anggota = Anggota::where('user_id', Auth::id())->first();

        if (!$anggota) {
            return redirect()->back()->with('error', 'Data anggota tidak ditemukan');
        }

        try {
            // Require mPDF (install first: composer require mpdf/mpdf)
            $mpdf = new Mpdf([
                'mode' => 'utf-8',
                'format' => 'A4',
                'orientation' => 'P',
                'margin_left' => 10,
                'margin_right' => 10,
                'margin_top' => 10,
                'margin_bottom' => 10,
            ]);

            // Convert images to base64
            $avatarPath = public_path('storage/images/users/' . $anggota->avatar);
            $avatarBase64 = '';

            if (file_exists($avatarPath)) {
                $imageData = file_get_contents($avatarPath);
                $base64 = base64_encode($imageData);
                $mimeType = mime_content_type($avatarPath);
                $avatarBase64 = 'data:' . $mimeType . ';base64,' . $base64;
            }

            $html = view('member.card-pdf-mpdf', compact('anggota', 'avatarBase64'))->render();

            $mpdf->WriteHTML($html);

            $filename = 'KTA_' . str_replace(' ', '_', $anggota->nama) . '_' . date('Y-m-d') . '.pdf';

            return response()->streamDownload(function () use ($mpdf) {
                echo $mpdf->Output('', 'S');
            }, $filename, ['Content-Type' => 'application/pdf']);
        } catch (\Exception $e) {
            Log::error('Error mPDF: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal membuat PDF: ' . $e->getMessage());
        }
    }

    // Preview KTA (pemilik kartu atau admin)
    public function cardPreview($id, KtaService $kta)
    {
        $anggota = Anggota::findOrFail($id);

        if ((int) $anggota->user_id !== (int) Auth::id() && Auth::user()->level !== 'Admin') {
            abort(403);
        }

        if (!$anggota->no_kartu_anggota) {
            return redirect()->back()->with('error', 'Kartu anggota belum tersedia. Akun belum diverifikasi.');
        }

        return view('member.kta.preview', $kta->cardData($anggota, false));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'file' => 'required|file|max:10240', // max 10MB
            ]);

            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $type = $file->getClientMimeType();
            $size = round($file->getSize() / 1048576, 2) . ' MB';
            $upload_date = now()->toDateString();

            $file->move(public_path('uploads'), $filename);

            Document::create([
                'user_id' => auth()->user()->id,
                'filename' => $filename,
                'type' => $type,
                'size' => $size,
                'upload_date' => $upload_date,
            ]);

            // Redirect dengan hash untuk tetap di tab documents
            return redirect()->back()->with('success', 'Document uploaded successfully!')
                ->with('active_tab', 'documents');
        } catch (\Throwable $e) {
            Log::error('Document store error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return redirect()->back()->with('error', 'Failed to upload document. Please try again.')
                ->with('active_tab', 'documents');
        }
    }

    public function view($id)
    {
        $document = Document::findOrFail($id);
        $path = public_path('uploads/' . $document->filename);

        if (!file_exists($path)) abort(404);

        return response()->file($path);
    }

    public function download($id)
    {
        $document = Document::findOrFail($id);
        $path = public_path('uploads/' . $document->filename);

        if (!file_exists($path)) abort(404);

        return response()->download($path);
    }

    public function destroy($id)
    {
        try {
            $document = Document::findOrFail($id);
            $path = public_path('uploads/' . $document->filename);

            if (file_exists($path)) {
                unlink($path);
            }

            $document->delete();

            return redirect()->back()->with('success', 'Document deleted successfully!')
                ->with('active_tab', 'documents');
        } catch (\Throwable $e) {
            Log::error('Article store error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return redirect()->back()->with('error', 'Failed to delete document. Please try again.')
                ->with('active_tab', 'documents');
        }
    }

    public function downloadCardJPGFront(KtaService $kta)
    {
        return $this->downloadCardJPG($kta, 'front');
    }

    public function downloadCardJPGBack(KtaService $kta)
    {
        return $this->downloadCardJPG($kta, 'back');
    }

    private function downloadCardJPG(KtaService $kta, string $side)
    {
        $anggota = $this->anggotaWithKta();

        if (!$anggota) {
            return redirect()->back()->with('error', 'Kartu anggota belum tersedia. Akun Anda belum diverifikasi.');
        }

        try {
            $path = $kta->jpg($anggota, $side);
            $filename = $kta->filename($anggota, $side === 'back' ? 'Belakang' : 'Depan', 'jpg');

            return response()->download($path, $filename)->deleteFileAfterSend(true);
        } catch (\Exception $e) {
            Log::error('Error JPG ' . $side . ': ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal membuat JPG: ' . $e->getMessage());
        }
    }

    // Download KTA depan & belakang (ZIP)
    public function downloadCardJPGBoth(KtaService $kta)
    {
        $anggota = $this->anggotaWithKta();

        if (!$anggota) {
            return redirect()->back()->with('error', 'Kartu anggota belum tersedia. Akun Anda belum diverifikasi.');
        }

        $front = $back = null;

        try {
            $front = $kta->jpg($anggota, 'front');
            $back = $kta->jpg($anggota, 'back');

            $zipPath = storage_path('app/public/temp/' . Str::uuid() . '.zip');
            $zip = new \ZipArchive();
            if ($zip->open($zipPath, \ZipArchive::CREATE) !== true) {
                throw new \Exception('Cannot create ZIP file');
            }
            $zip->addFile($front, $kta->filename($anggota, 'Depan', 'jpg'));
            $zip->addFile($back, $kta->filename($anggota, 'Belakang', 'jpg'));
            $zip->close();

            return response()->download($zipPath, $kta->filename($anggota, 'Lengkap', 'zip'))->deleteFileAfterSend(true);
        } catch (\Exception $e) {
            Log::error('Error JPG Both: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal membuat ZIP: ' . $e->getMessage());
        } finally {
            foreach ([$front, $back] as $file) {
                if ($file && file_exists($file)) {
                    unlink($file);
                }
            }
        }
    }
}
