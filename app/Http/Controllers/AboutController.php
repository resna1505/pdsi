<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\CategoryMitra;
use App\Models\Mitra;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    public function index()
    {
        $video = Video::with('learningMethods')->get();

        $activity = Activity::with('photos')->get();
        $articles = Mitra::orderBy('created_at', 'desc')->get();
        $categories = CategoryMitra::all();

        // dd($articles);
        return view('admin.about', compact('articles', 'categories'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'email' => 'required|email',
                'telephone' => 'required|string|max:50',
                'address' => 'required|string',
                'website' => 'required|string',
                'image' => 'nullable|image|max:2048'
            ]);

            $imagePath = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = $image->hashName();
                $image->storeAs('public/mitras', $filename);
                $imagePath = $filename;
            }

            Mitra::create([
                'image' => $imagePath,
                'category_id' => $request->category_id,
                'title' => $request->title,
                'telephone' => $request->telephone,
                'email' => $request->email,
                'address' => $request->address,
                'website' => $request->website,
            ]);

            return redirect()->back()->with('success', 'Mitra added successfully!');
        } catch (\Throwable $e) {
            Log::error('Mitra store error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return redirect()->back()->with('error', 'Failed to add Mitra. Please try again.');
        }
    }

    public function destroy($id)
    {
        try {
            $article = Mitra::findOrFail($id);

            if ($article->attachment) {
                Storage::disk('public')->delete($article->attachment);
            }

            $article->delete();

            return redirect()->back()->with('success', 'Mitra deleted successfully!');
        } catch (\Throwable $e) {
            Log::error('Mitra delete error: ' . $e->getMessage(), [
                'article_id' => $id,
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return redirect()->back()->with('error', 'Failed to delete mitra. Please try again.');
        }
    }

    public function edit($id)
    {
        try {
            $article = Mitra::findOrFail($id);
            $categories = CategoryMitra::all(); // Sesuaikan dengan model Category Anda

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

    // // 3. Method update di ArticleController
    public function update(Request $request, $id)
    {
        try {
            $article = Mitra::findOrFail($id);

            $request->validate([
                'image' => 'nullable|image',
                'category_id' => 'required|integer',
                'title' => 'required|string|max:255',
                'telephone' => 'required|string',
                'email' => 'required|string',
                'address' => 'required|string',
                'website' => 'required|string',
            ]);

            $imagePath = $article->image;

            // Handle new image upload
            if ($request->hasFile('image')) {
                if ($article->image) {
                    Storage::disk('public')->delete('mitras/' . $article->image);
                }

                $image = $request->file('image');
                $filename = $image->hashName();
                $image->storeAs('public/mitras', $filename);
                $imagePath = $filename;
            }

            // Update article
            $article->update([
                'image' => $imagePath,
                'category_id' => $request->category_id,
                'title' => $request->title,
                'telephone' => $request->telephone,
                'email' => $request->email,
                'address' => $request->address,
                'website' => $request->website
            ]);

            return redirect()->back()->with('success', 'Mitra updated successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Throwable $e) {
            Log::error('Mitra update error: ' . $e->getMessage(), [
                'Mitra_id' => $id,
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return redirect()->back()->with('error', 'Failed to update Mitra. Please try again.');
        }
    }
}
