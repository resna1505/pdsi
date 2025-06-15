<?php

namespace App\Http\Controllers;

use App\Models\CategoriesWorkshops;
use App\Models\tag_workshop;
use App\Models\Tags;
use App\Models\Workshops;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class WorkshopsController extends Controller
{
    public function index()
    {
        $articles = Workshops::orderBy('created_at', 'desc')->get();
        $categories = CategoriesWorkshops::all();
        $tags = Tags::all();

        return view('admin.workshops', compact('articles', 'categories', 'tags'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'image' => 'nullable|image',
                'title' => 'required|string',
                'category_id' => 'required|integer',
                'tag' => 'required',
                'tagline' => 'required',
                'summary' => 'required|string',
                'description' => 'required|string',
                'price' => 'required',
            ]);

            $imagePath = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = $image->hashName();
                $image->move(public_path('storage/workshops'), $filename);
                $imagePath = $filename;
            }

            $workshops = Workshops::create([
                'image' => $imagePath,
                'title' => $request->title,
                'category_id' => $request->category_id,
                'price' => $request->price,
                'tagline' => $request->tagline,
                'short_description' => $request->summary,
                'description' => $request->description,
            ]);

            foreach ($request->tag as $tagId) {
                tag_workshop::create([
                    'workshop_id' => $workshops->id,
                    'tag_id' => (int) $tagId,
                ]);
            }

            return redirect()->back()->with('success', 'Workshops added successfully!');
        } catch (\Throwable $e) {
            Log::error('Workshops store error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return redirect()->back()->with('error', 'Failed to add Workshops. Please try again.');
        }
    }

    public function destroy($id)
    {
        try {
            $article = Workshops::findOrFail($id);
            $tagworkshop = tag_workshop::where('workshop_id', $id)->get();
            foreach ($tagworkshop as $tag) {
                $tag->delete();
            }

            if ($article->image) {
                Storage::disk('public')->delete($article->image);
            }

            $article->delete();

            return redirect()->back()->with('success', 'Workshop deleted successfully!');
        } catch (\Throwable $e) {
            Log::error('Workshop delete error: ' . $e->getMessage(), [
                'Workshop_id' => $id,
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return redirect()->back()->with('error', 'Failed to delete Workshop. Please try again.');
        }
    }

    public function edit($id)
    {
        try {
            $articles = Workshops::findOrFail($id);
            $categories = CategoriesWorkshops::all();
            $tags = Tags::all();

            return response()->json([
                'success' => true,
                'article' => $articles,
                'categories' => $categories,
                'tags' => $tags,
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
            $article = Workshops::findOrFail($id);

            $request->validate([
                'image' => 'nullable|image',
                'title' => 'required|string',
                'category_id' => 'required|integer',
                // 'tag' => 'required',
                'tagline' => 'required',
                'summary' => 'required|string',
                'description' => 'required|string',
                'price' => 'required',
            ]);

            $imagePath = $article->image;

            if ($request->hasFile('image')) {
                if ($article->image) {
                    Storage::disk('public')->delete('workshops/' . $article->image);
                }

                $image = $request->file('image');
                $filename = $image->hashName();
                $image->storeAs('public/workshops', $filename);
                $imagePath = $filename;
            }

            $article->update([
                'image' => $imagePath,
                'title' => $request->title,
                'category_id' => $request->category_id,
                'price' => $request->price,
                'tagline' => $request->tagline,
                'short_description' => $request->summary,
                'description' => $request->description,
            ]);

            tag_workshop::where('workshop_id', $id)->delete();
            foreach ($request->tag as $tagId) {
                tag_workshop::create([
                    'workshop_id' => $id,
                    'tag_id' => (int) $tagId,
                ]);
            }
            return redirect()->back()->with('success', 'Workshop updated successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Throwable $e) {
            Log::error('Workshop update error: ' . $e->getMessage(), [
                'Workshop_id' => $id,
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return redirect()->back()->with('error', 'Failed to update Workshop. Please try again.');
        }
    }
}
