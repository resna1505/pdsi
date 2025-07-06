<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Document;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Spatie\Browsershot\Browsershot;

class ProfileDokterController extends Controller
{
    public function index()
    {
        $anggota = Anggota::where('user_id', Auth::id())->first();
        $documents = Document::where('user_id', Auth::id())->orderBy('upload_date', 'desc')->get();

        return view('member.profile-dokter', compact('anggota', 'documents'));
    }

    // Method untuk download PDF
    // public function downloadCardPDF()
    // {
    //     $anggota = Anggota::where('user_id', Auth::id())->first();

    //     if (!$anggota) {
    //         return redirect()->back()->with('error', 'Data anggota tidak ditemukan');
    //     }

    //     // HTML SIMPLE INLINE - NO EXTERNAL TEMPLATE
    //     $html = '
    // <!DOCTYPE html>
    // <html>
    // <head>
    //     <meta charset="utf-8">
    //     <style>
    //         @page { margin: 0; size: 88mm 125mm; }
    //         body { font-family: Arial; margin: 0; padding: 5mm; }
    //         .card { border: 2px solid #0066cc; border-radius: 10px; padding: 10px; margin-bottom: 10px; }
    //         .header { background: #0066cc; color: white; text-align: center; padding: 8px; font-size: 11px; font-weight: bold; margin: -10px -10px 10px -10px; }
    //         .content { text-align: center; }
    //         .avatar { width: 60px; height: 60px; border-radius: 50%; border: 2px solid #0066cc; background: #ddd; margin: 10px auto; }
    //         .info { font-size: 12px; margin: 5px 0; }
    //         .qr { border: 1px solid #333; padding: 10px; background: white; margin: 10px auto; width: 60px; height: 60px; text-align: center; font-size: 8px; }
    //     </style>
    // </head>
    // <body>
    //     <!-- DEPAN -->
    //     <div class="card">
    //         <div class="header">PERKUMPULAN DOKTER SELURUH INDONESIA</div>
    //         <div class="content">
    //             <div style="font-size: 10px; margin: 5px;">www.pdsionline.org</div>
    //             <div class="avatar"></div>
    //             <div class="info"><strong>Nama:</strong> ' . $anggota->nama . '</div>
    //             <div class="info"><strong>ID:</strong> ' . $anggota->id . '</div>
    //             <div class="info"><strong>No.Anggota:</strong> ' . $anggota->id . '</div>
    //         </div>
    //     </div>

    //     <!-- BELAKANG -->
    //     <div class="card" style="page-break-before: always;">
    //         <div class="header">KARTU ANGGOTA - BELAKANG</div>
    //         <div class="content">
    //             <div class="qr">QR<br>ID: ' . $anggota->id . '</div>
    //             <div style="font-size: 9px; text-align: left; margin-top: 10px;">
    //                 <strong>Info:</strong><br>
    //                 1. Kartu identitas resmi PDSI<br>
    //                 2. Wajib dibawa saat praktek<br>
    //                 3. Hubungi sekretariat jika hilang<br><br>
    //                 <strong>Diterbitkan:</strong> ' . date('d/m/Y') . '
    //             </div>
    //         </div>
    //     </div>
    // </body>
    // </html>';

    //     try {
    //         $pdf = FacadePdf::loadHTML($html);
    //         $pdf->setPaper([0, 0, 249, 354], 'portrait'); // 88mm x 125mm in points

    //         $filename = 'KTA_' . str_replace(' ', '_', $anggota->nama) . '_' . date('Y-m-d') . '.pdf';

    //         return $pdf->download($filename);
    //     } catch (\Exception $e) {
    //         Log::error('Error PDF: ' . $e->getMessage());
    //         return redirect()->back()->with('error', 'Gagal membuat PDF: ' . $e->getMessage());
    //     }
    // }

    // // Method untuk download sebagai JPG
    // public function downloadCardJPG()
    // {
    //     $anggota = Anggota::where('user_id', Auth::id())->first();
    //     $html = view('member.card-preview', compact('anggota'))->render();

    //     // Simpan HTML ke file temporary
    //     $htmlPath = storage_path('app/public/temp_' . $anggota->id . '.html');
    //     file_put_contents($htmlPath, $html);

    //     // Gunakan wkhtmltoimage (instal terlebih dahulu)
    //     $imagePath = storage_path('app/public/kta_' . $anggota->id . '.jpg');
    //     exec("wkhtmltoimage --width 1200 --height 1800 $htmlPath $imagePath");

    //     if (!file_exists($imagePath)) {
    //         return back()->with('error', 'Gagal konversi HTML ke gambar');
    //     }

    //     return response()->download($imagePath)->deleteFileAfterSend(true);
    // }

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
}
