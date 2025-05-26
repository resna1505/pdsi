<?php

namespace App\Http\Controllers;

use App\Models\ProgramKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProgramKerjaController extends Controller
{
    public function index()
    {
        $visimisi = ProgramKerja::all();

        return view('admin.program-kerja', compact('visimisi'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'description' => 'required|string|max:255',
                'title' => 'required',
            ]);

            ProgramKerja::create([
                'kategori' => $request->title,
                'isi' => $request->description,
            ]);

            return redirect()->back()->with('success', 'Program Kerja added successfully!');
        } catch (\Throwable $e) {
            Log::error('Program Kerja store error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return redirect()->back()->with('error', 'Failed to add Program Kerja. Please try again.');
        }
    }

    public function destroy($id)
    {
        try {
            $article = ProgramKerja::findOrFail($id);
            $article->delete();

            return redirect()->back()->with('success', 'Visi Misi deleted successfully!');
        } catch (\Throwable $e) {
            Log::error('Visi Misi delete error: ' . $e->getMessage(), [
                'article_id' => $id,
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return redirect()->back()->with('error', 'Failed to delete Visi Misi. Please try again.');
        }
    }

    public function edit($id)
    {
        try {
            $article = ProgramKerja::findOrFail($id);
            // $categories = CategoryMitra::all(); // Sesuaikan dengan model Category Anda

            return response()->json([
                'success' => true,
                'article' => $article,
                // 'categories' => $categories
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Article not found'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $article = ProgramKerja::findOrFail($id);

            $request->validate([
                'description' => 'required|string|max:255',
                'title' => 'required',
            ]);

            $article->update([
                'kategori' => $request->title,
                'isi' => $request->description,
            ]);

            return redirect()->back()->with('success', 'Program Kerja updated successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Throwable $e) {
            Log::error('Program Kerja update error: ' . $e->getMessage(), [
                'VisiMisi_id' => $id,
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return redirect()->back()->with('error', 'Failed to update Program Kerja. Please try again.');
        }
    }
}
