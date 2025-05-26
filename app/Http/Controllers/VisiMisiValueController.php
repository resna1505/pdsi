<?php

namespace App\Http\Controllers;

use App\Models\VisiMisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VisiMisiValueController extends Controller
{
    public function index()
    {
        $visimisi = VisiMisi::all();

        return view('admin.visi-misi-value', compact('visimisi'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'description' => 'required|string|max:255',
                'type' => 'required',
            ]);

            VisiMisi::create([
                'title' => $request->title,
                'description' => $request->description,
                'type' => $request->type,
            ]);

            return redirect()->back()->with('success', 'Visi Misi added successfully!');
        } catch (\Throwable $e) {
            Log::error('Visi Misi store error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return redirect()->back()->with('error', 'Failed to add Visi Misi. Please try again.');
        }
    }

    public function destroy($id)
    {
        try {
            $article = VisiMisi::findOrFail($id);
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
            $article = VisiMisi::findOrFail($id);
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
            $article = VisiMisi::findOrFail($id);

            // dd($request->all());
            $request->validate([
                'description' => 'required|string|max:255',
                'category_id' => 'required',
            ]);

            $article->update([
                'title' => $request->title,
                'description' => $request->description,
                'type' => $request->category_id,
            ]);

            return redirect()->back()->with('success', 'Visi Misi updated successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Throwable $e) {
            Log::error('Visi Misi update error: ' . $e->getMessage(), [
                'VisiMisi_id' => $id,
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return redirect()->back()->with('error', 'Failed to update Visi Misi. Please try again.');
        }
    }
}
