<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Article;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
        $categories = Category::with('articles')->get();
        $allArticles = Article::latest()->get();

        return view('member.announcement', compact('categories', 'allArticles'));
    }

    public function show($id)
    {
        $article = Article::where('id', $id)->firstOrFail();
        return view('member.announcement-detail', compact('article'));
    }
}
