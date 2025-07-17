<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Document;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Mpdf\Mpdf;

class ProfileDokterController extends Controller
{
    public function index()
    {
        $anggota = Anggota::where('user_id', Auth::id())->first();
        $documents = Document::where('user_id', Auth::id())->orderBy('upload_date', 'desc')->get();

        return view('member.profile-dokter', compact('anggota', 'documents'));
    }

    // Method untuk download PDF - FIXED VERSION
    public function downloadCardPDF()
    {
        $anggota = Anggota::where('user_id', Auth::id())->first();

        if (!$anggota) {
            return redirect()->back()->with('error', 'Data anggota tidak ditemukan');
        }

        try {
            // Convert image to base64 for PDF
            $avatarPath = public_path('storage/images/users/' . $anggota->avatar);
            $avatarBase64 = '';

            if (file_exists($avatarPath)) {
                $imageData = file_get_contents($avatarPath);
                $base64 = base64_encode($imageData);
                $mimeType = mime_content_type($avatarPath);
                $avatarBase64 = 'data:' . $mimeType . ';base64,' . $base64;
            }

            // Background images to base64
            $frontBgPath = public_path('build/images/kta_pdsi_depan.jpg');
            $backBgPath = public_path('build/images/kta_pdsi_belakang.jpg');

            $frontBgBase64 = '';
            $backBgBase64 = '';

            if (file_exists($frontBgPath)) {
                $frontImageData = file_get_contents($frontBgPath);
                $frontBase64 = base64_encode($frontImageData);
                $frontMimeType = mime_content_type($frontBgPath);
                $frontBgBase64 = 'data:' . $frontMimeType . ';base64,' . $frontBase64;
            }

            if (file_exists($backBgPath)) {
                $backImageData = file_get_contents($backBgPath);
                $backBase64 = base64_encode($backImageData);
                $backMimeType = mime_content_type($backBgPath);
                $backBgBase64 = 'data:' . $backMimeType . ';base64,' . $backBase64;
            }

            // Pass data to view
            $data = [
                'anggota' => $anggota,
                'avatarBase64' => $avatarBase64,
                'frontBgBase64' => $frontBgBase64,
                'backBgBase64' => $backBgBase64
            ];

            // Generate PDF
            $pdf = Pdf::loadView('member.card-pdf', $data);
            $pdf->setPaper('A4', 'portrait');

            $filename = 'KTA_' . str_replace(' ', '_', $anggota->nama) . '_' . date('Y-m-d') . '.pdf';

            return $pdf->download($filename);
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

    // Method untuk preview card (untuk screenshot)
    public function cardPreview($id)
    {
        $anggota = Anggota::findOrFail($id);
        return view('member.card-preview', compact('anggota'));
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

            return redirect()->back()->with('success', 'Document added successfully!');
        } catch (\Throwable $e) {
            Log::error('Article store error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return redirect()->back()->with('error', 'Failed to add Document. Please try again.');
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

            return redirect()->back()->with('success', 'File berhasil dihapus!');
        } catch (\Throwable $e) {
            Log::error('Article store error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return redirect()->back()->with('error', 'Failed to delete Document. Please try again.');
        }
    }

    public function downloadCardJPGFront()
    {
        $anggota = Anggota::where('user_id', Auth::id())->first();

        if (!$anggota) {
            return redirect()->back()->with('error', 'Data anggota tidak ditemukan');
        }

        try {
            // Convert images to base64
            $avatarBase64 = '';
            $frontBgBase64 = '';

            $avatarPath = public_path('storage/images/users/' . $anggota->avatar);
            if (file_exists($avatarPath)) {
                $avatarData = file_get_contents($avatarPath);
                $avatarBase64 = 'data:' . mime_content_type($avatarPath) . ';base64,' . base64_encode($avatarData);
            }

            $frontPath = public_path('build/images/kta_pdsi_depan.jpg');
            if (file_exists($frontPath)) {
                $frontData = file_get_contents($frontPath);
                $frontBgBase64 = 'data:' . mime_content_type($frontPath) . ';base64,' . base64_encode($frontData);
            }

            $data = compact('anggota', 'avatarBase64', 'frontBgBase64');
            $html = view('member.card-jpg-front', $data)->render();

            $filename = 'KTA_Depan_' . str_replace(' ', '_', $anggota->nama) . '_' . date('Y-m-d') . '.jpg';
            $filepath = storage_path('app/public/temp/' . $filename);

            if (!file_exists(storage_path('app/public/temp'))) {
                mkdir(storage_path('app/public/temp'), 0755, true);
            }

            // Optimized settings untuk single card
            \Spatie\Browsershot\Browsershot::html($html)
                ->noSandbox()
                ->timeout(30) // Reduced timeout
                ->setScreenshotType('jpeg', 90)
                ->windowSize(350, 550) // Exact card size
                ->deviceScaleFactor(2) // High quality
                ->dismissDialogs()
                ->ignoreHttpsErrors()
                ->setOption('no-first-run', true)
                ->setOption('disable-web-security', true)
                ->save($filepath);

            return response()->download($filepath)->deleteFileAfterSend(true);
        } catch (\Exception $e) {
            Log::error('Error JPG Front: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal membuat JPG Depan: ' . $e->getMessage());
        }
    }

    // Method 2: Download Kartu Belakang Saja
    public function downloadCardJPGBack()
    {
        $anggota = Anggota::where('user_id', Auth::id())->first();

        if (!$anggota) {
            return redirect()->back()->with('error', 'Data anggota tidak ditemukan');
        }

        try {
            $backBgBase64 = '';

            $backPath = public_path('build/images/kta_pdsi_belakang.jpg');
            if (file_exists($backPath)) {
                $backData = file_get_contents($backPath);
                $backBgBase64 = 'data:' . mime_content_type($backPath) . ';base64,' . base64_encode($backData);
            }

            $data = compact('anggota', 'backBgBase64');
            $html = view('member.card-jpg-back', $data)->render();

            $filename = 'KTA_Belakang_' . str_replace(' ', '_', $anggota->nama) . '_' . date('Y-m-d') . '.jpg';
            $filepath = storage_path('app/public/temp/' . $filename);

            if (!file_exists(storage_path('app/public/temp'))) {
                mkdir(storage_path('app/public/temp'), 0755, true);
            }

            \Spatie\Browsershot\Browsershot::html($html)
                ->noSandbox()
                ->timeout(30)
                ->setScreenshotType('jpeg', 90)
                ->windowSize(350, 550) // Exact card size
                ->deviceScaleFactor(2)
                ->dismissDialogs()
                ->ignoreHttpsErrors()
                ->setOption('no-first-run', true)
                ->setOption('disable-web-security', true)
                ->save($filepath);

            return response()->download($filepath)->deleteFileAfterSend(true);
        } catch (\Exception $e) {
            Log::error('Error JPG Back: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal membuat JPG Belakang: ' . $e->getMessage());
        }
    }

    // Method 3: Download Both Cards as ZIP
    // public function downloadCardJPGBoth()
    // {
    //     $anggota = Anggota::where('user_id', Auth::id())->first();

    //     if (!$anggota) {
    //         return redirect()->back()->with('error', 'Data anggota tidak ditemukan');
    //     }

    //     try {
    //         // Convert images to base64
    //         $avatarBase64 = '';
    //         $frontBgBase64 = '';
    //         $backBgBase64 = '';

    //         $avatarPath = public_path('storage/images/users/' . $anggota->avatar);
    //         if (file_exists($avatarPath)) {
    //             $avatarData = file_get_contents($avatarPath);
    //             $avatarBase64 = 'data:' . mime_content_type($avatarPath) . ';base64,' . base64_encode($avatarData);
    //         }

    //         $frontPath = public_path('build/images/kta_pdsi_depan.jpg');
    //         if (file_exists($frontPath)) {
    //             $frontData = file_get_contents($frontPath);
    //             $frontBgBase64 = 'data:' . mime_content_type($frontPath) . ';base64,' . base64_encode($frontData);
    //         }

    //         $backPath = public_path('build/images/kta_pdsi_belakang.jpg');
    //         if (file_exists($backPath)) {
    //             $backData = file_get_contents($backPath);
    //             $backBgBase64 = 'data:' . mime_content_type($backPath) . ';base64,' . base64_encode($backData);
    //         }

    //         // Generate front card
    //         $frontData = compact('anggota', 'avatarBase64', 'frontBgBase64');
    //         $frontHtml = view('member.card-jpg-front', $frontData)->render();

    //         $frontFilename = 'KTA_Depan_' . str_replace(' ', '_', $anggota->nama) . '.jpg';
    //         $frontFilepath = storage_path('app/public/temp/' . $frontFilename);

    //         if (!file_exists(storage_path('app/public/temp'))) {
    //             mkdir(storage_path('app/public/temp'), 0755, true);
    //         }

    //         \Spatie\Browsershot\Browsershot::html($frontHtml)
    //             ->noSandbox()
    //             ->timeout(30)
    //             ->setScreenshotType('jpeg', 90)
    //             ->windowSize(350, 550)
    //             ->deviceScaleFactor(2)
    //             ->dismissDialogs()
    //             ->ignoreHttpsErrors()
    //             ->save($frontFilepath);

    //         // Generate back card
    //         $backData = compact('anggota', 'backBgBase64');
    //         $backHtml = view('member.card-jpg-back', $backData)->render();

    //         $backFilename = 'KTA_Belakang_' . str_replace(' ', '_', $anggota->nama) . '.jpg';
    //         $backFilepath = storage_path('app/public/temp/' . $backFilename);

    //         \Spatie\Browsershot\Browsershot::html($backHtml)
    //             ->noSandbox()
    //             ->timeout(30)
    //             ->setScreenshotType('jpeg', 90)
    //             ->windowSize(350, 550)
    //             ->deviceScaleFactor(2)
    //             ->dismissDialogs()
    //             ->ignoreHttpsErrors()
    //             ->save($backFilepath);

    //         // Create ZIP
    //         $zipFilename = 'KTA_Complete_' . str_replace(' ', '_', $anggota->nama) . '_' . date('Y-m-d') . '.zip';
    //         $zipFilepath = storage_path('app/public/temp/' . $zipFilename);

    //         $zip = new \ZipArchive();
    //         if ($zip->open($zipFilepath, \ZipArchive::CREATE) === TRUE) {
    //             $zip->addFile($frontFilepath, $frontFilename);
    //             $zip->addFile($backFilepath, $backFilename);
    //             $zip->close();

    //             // Clean up individual files
    //             if (file_exists($frontFilepath)) unlink($frontFilepath);
    //             if (file_exists($backFilepath)) unlink($backFilepath);

    //             return response()->download($zipFilepath)->deleteFileAfterSend(true);
    //         } else {
    //             throw new \Exception('Cannot create ZIP file');
    //         }
    //     } catch (\Exception $e) {
    //         Log::error('Error JPG Both: ' . $e->getMessage());
    //         return redirect()->back()->with('error', 'Gagal membuat ZIP: ' . $e->getMessage());
    //     }
    // }
}
