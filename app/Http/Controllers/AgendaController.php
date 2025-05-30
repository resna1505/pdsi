<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\CategoryAgenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AgendaController extends Controller
{
    public function index()
    {
        $articles = Agenda::orderBy('created_at', 'desc')->get();
        $categories = CategoryAgenda::with('agenda')->get();

        return view('admin.agenda', compact('articles', 'categories'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'image' => 'nullable|image',
                'category_id' => 'required|integer',
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'author' => 'required|string|max:100',
            ]);

            $imagePath = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = $image->hashName();
                $image->move(public_path('storage/articles'), $filename);
                $imagePath = $filename;
            }

            Agenda::create([
                'attachment' => $imagePath,
                'category_id' => $request->category_id,
                'title' => $request->title,
                'description' => $request->description,
                'author' => $request->author,
            ]);

            return redirect()->back()->with('success', 'Agenda added successfully!');
        } catch (\Throwable $e) {
            Log::error('Agenda store error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return redirect()->back()->with('error', 'Failed to add Agenda. Please try again.');
        }
    }

    public function destroy($id)
    {
        try {
            $article = Agenda::findOrFail($id);

            // Hapus file gambar jika ada
            if ($article->attachment) {
                Storage::disk('public')->delete($article->attachment);
            }

            // Hapus record dari database
            $article->delete();

            return redirect()->back()->with('success', 'Agenda deleted successfully!');
        } catch (\Throwable $e) {
            Log::error('Agenda delete error: ' . $e->getMessage(), [
                'Agenda_id' => $id,
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return redirect()->back()->with('error', 'Failed to delete Agenda. Please try again.');
        }
    }

    public function edit($id)
    {
        try {
            $article = Agenda::findOrFail($id);
            $categories = CategoryAgenda::all(); // Sesuaikan dengan model Category Anda

            return response()->json([
                'success' => true,
                'article' => $article,
                'categories' => $categories
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Agenda not found'
            ], 404);
        }
    }

    // 3. Method update di ArticleController
    public function update(Request $request, $id)
    {
        try {
            $article = Agenda::findOrFail($id);

            $request->validate([
                'image' => 'nullable|image',
                'category_id' => 'required|integer',
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'author' => 'required|string|max:100',
            ]);

            $imagePath = $article->attachment; // Keep existing image if no new image uploaded

            // Handle new image upload
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($article->attachment) {
                    Storage::disk('public')->delete('articles/' . $article->attachment);
                }

                // Store new image
                $image = $request->file('image');
                $filename = $image->hashName();
                $image->storeAs('public/articles', $filename);
                $imagePath = $filename;
            }

            // Update article
            $article->update([
                'attachment' => $imagePath,
                'category_id' => $request->category_id,
                'title' => $request->title,
                'description' => $request->description,
                'author' => $request->author,
            ]);

            return redirect()->back()->with('success', 'Agenda updated successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Throwable $e) {
            Log::error('Agenda update error: ' . $e->getMessage(), [
                'Agenda_id' => $id,
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return redirect()->back()->with('error', 'Failed to update Agenda. Please try again.');
        }
    }
}
