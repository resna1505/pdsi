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
}
