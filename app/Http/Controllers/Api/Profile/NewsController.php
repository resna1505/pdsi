<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NewsController extends Controller
{
    public function index()
    {
        try {
            $articles = Article::ordered()->get();

            return response()->json([
                'status' => 'success',
                'data' => [
                    'articles' => $articles,
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal mengambil data: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data',
            ], 500);
        }
    }
}
