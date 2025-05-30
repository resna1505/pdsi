<?php

namespace App\Http\Controllers;

use App\Models\FAQCategory;
use App\Models\FAQItem;
use Illuminate\Http\Request;

class FAQDokterController extends Controller
{
    public function index()
    {
        $articles = FAQItem::orderBy('created_at', 'desc')->get();
        $categories = FAQCategory::with('items')->get();

        return view('admin.faq', compact('articles', 'categories'));
    }
}
