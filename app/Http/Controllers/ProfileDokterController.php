<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ProfileDokterController extends Controller
{
    public function index()
    {
        $anggota = Anggota::where('user_id', Auth::id())->first();
        $documents = Document::where('user_id', Auth::id())->orderBy('upload_date', 'desc')->get();
        // dd($documents);

        return view('member.profile-dokter', compact('anggota', 'documents'));
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
                'user_id' => auth()->user()->id, // atau custom user_id
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

            return back()->with('success', 'File berhasil dihapus');


            return redirect()->back()->with('success', 'File berhasil dihapus!');
        } catch (\Throwable $e) {
            Log::error('Article store error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return redirect()->back()->with('error', 'Failed to add Document. Please try again.');
        }
    }
}
