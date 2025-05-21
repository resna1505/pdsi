<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Models\FAQCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FaqController extends Controller
{
    public function index()
    {
        try {
            $faq = FAQCategory::with('items')->get();

            return response()->json([
                'status' => 'success',
                'data' => [
                    'faq' => $faq,
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
