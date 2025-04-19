<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FAQCategory;


class FAQController extends Controller
{
    public function index()
    {
        $categories = FAQCategory::with('items')->get();
        return view('admin.faq', compact('categories'));
    }
}
