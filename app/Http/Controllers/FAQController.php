<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\FAQCategory;
use App\Models\FAQItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class FAQController extends Controller
{
    public function index()
    {
        $articles = FAQItem::orderBy('created_at', 'desc')->get();
        $categories = FAQCategory::with('items')->get();

        return view('admin.faq', compact('articles', 'categories'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'category_id' => 'required|integer',
                'question' => 'required|string|max:255',
                'answer' => 'required|string',
            ]);

            FAQItem::create([
                'faq_category_id' => $request->category_id,
                'question' => $request->question,
                'answer' => $request->answer,
            ]);

            return redirect()->back()->with('success', 'FAQ added successfully!');
        } catch (\Throwable $e) {
            Log::error('FAQ store error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return redirect()->back()->with('error', 'Failed to add FAQ. Please try again.');
        }
    }

    public function destroy($id)
    {
        try {
            $article = FAQItem::findOrFail($id);

            // Hapus record dari database
            $article->delete();

            return redirect()->back()->with('success', 'FAQ deleted successfully!');
        } catch (\Throwable $e) {
            Log::error('FAQ delete error: ' . $e->getMessage(), [
                'FAQ_id' => $id,
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return redirect()->back()->with('error', 'Failed to delete FAQ. Please try again.');
        }
    }

    public function edit($id)
    {
        try {
            $article = FAQItem::findOrFail($id);
            $categories = FAQCategory::all(); // Sesuaikan dengan model Category Anda

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
            $article = FAQItem::findOrFail($id);

            $request->validate([
                'category_id' => 'required|integer',
                'question' => 'required|string|max:255',
                'answer' => 'required|string',
            ]);

            // Update article
            $article->update([
                'faq_category_id' => $request->category_id,
                'question' => $request->question,
                'answer' => $request->answer,
            ]);

            return redirect()->back()->with('success', 'FAQ updated successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Throwable $e) {
            Log::error('FAQ update error: ' . $e->getMessage(), [
                'FAQ_id' => $id,
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return redirect()->back()->with('error', 'Failed to update FAQ. Please try again.');
        }
    }
}
