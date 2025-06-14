<?php

namespace App\Http\Controllers;

use App\Models\CategoriesWorkshops;
use App\Models\Tags;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $category = CategoriesWorkshops::all();
        $tags = Tags::all();
        $workshops = DB::table('workshops as ws')
            ->select(
                'ws.id',
                'ws.price',
                'ws.title',
                'ws.description',
                'ws.created_at',
                'ws.image',
                'cw.name'
            )
            ->join('categories_workshops as cw', 'cw.id', '=', 'ws.category_id')
            ->where('ws.is_active', '=', '1')
            ->get();

        $tagworkshops = DB::table('tag_workshop as tw')
            ->select(
                'tw.workshop_id',
                'tg.name'
            )
            ->join('tags as tg', 'tg.id', '=', 'tw.tag_id')
            ->get();

        $ratings = DB::select("
            SELECT
                workshop_id,
                CEIL(AVG(stars)) AS rounded_rating
            FROM
                ratings
            GROUP BY
                workshop_id
        ");

        return view('member.training', compact('category', 'tags', 'workshops', 'tagworkshops', 'ratings'));
    }
}
