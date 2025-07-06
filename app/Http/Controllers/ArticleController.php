<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::orderBy('created_at', 'desc')->get();
        $categories = Category::with('articles')->get();

        // dd($articles);
        return view('admin.news-management', compact('articles', 'categories'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        try {
            $request->validate([
                'image' => 'nullable|image',
                'category_id' => 'required|integer',
                'title' => 'required|string',
                'description' => 'required|string',
                'author' => 'required|string|max:100',
            ]);


            $imagePath = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = $image->hashName(); // atau time().'.'.$image->getClientOriginalExtension()
                $image->move(public_path('storage/articles'), $filename);
                $imagePath = $filename; // Hanya nama file, tanpa folder
            }

            Article::create([
                'attachment' => $imagePath,
                'category_id' => $request->category_id,
                'title' => $request->title,
                'description' => $request->description,
                'author' => $request->author,
            ]);

            return redirect()->back()->with('success', 'Article added successfully!');
        } catch (\Throwable $e) {
            Log::error('Article store error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return redirect()->back()->with('error', 'Failed to add article. Please try again.');
        }
    }

    public function destroy($id)
    {
        try {
            $article = Article::findOrFail($id);

            // Hapus file gambar jika ada
            if ($article->attachment) {
                Storage::disk('public')->delete($article->attachment);
            }

            // Hapus record dari database
            $article->delete();

            return redirect()->back()->with('success', 'Article deleted successfully!');
        } catch (\Throwable $e) {
            Log::error('Article delete error: ' . $e->getMessage(), [
                'article_id' => $id,
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return redirect()->back()->with('error', 'Failed to delete article. Please try again.');
        }
    }

    public function edit($id)
    {
        try {
            $article = Article::findOrFail($id);
            $categories = Category::all(); // Sesuaikan dengan model Category Anda

            return response()->json([
                'success' => true,
                'article' => $article,
                'categories' => $categories
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Article not found'
            ], 404);
        }
    }

    // 3. Method update di ArticleController
    public function update(Request $request, $id)
    {
        try {
            $article = Article::findOrFail($id);

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
                // $image->storeAs('public/articles', $filename);                
                $image->move(public_path('public/articles'), $filename);
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

            return redirect()->back()->with('success', 'Article updated successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Throwable $e) {
            Log::error('Article update error: ' . $e->getMessage(), [
                'article_id' => $id,
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return redirect()->back()->with('error', 'Failed to update article. Please try again.');
        }
    }
}
