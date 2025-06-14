<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\Workshop_properties;
use App\Models\Workshops;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductDetailController extends Controller
{
    public function index($id)
    {
        $workshops = DB::table('workshops as ws')
            ->select(
                'ws.id',
                'ws.price',
                'ws.title',
                'ws.description',
                'ws.created_at',
                'ws.image',
                'ws.category_id',
                'cw.name'
            )
            ->join('categories_workshops as cw', 'cw.id', '=', 'ws.category_id')
            ->where('ws.id', '=', $id)
            ->first();

        $ratings = DB::select("
            SELECT
                workshop_id,
                CEIL(AVG(stars)) AS rounded_rating
            FROM
                ratings
            WHERE
                workshop_id = $id
            GROUP BY
                workshop_id
        ");

        // $related = Workshops::where('category_id', $workshops->category_id)->where('id', '!=', $id)->orderBy('created_at', 'desc')->get();
        $related = Workshops::where('category_id', $workshops->category_id)->orderBy('created_at', 'desc')->get();
        $relatedratings = DB::select("
            SELECT
                workshop_id,
                CEIL(AVG(stars)) AS rounded_rating
            FROM
                ratings
            GROUP BY
                workshop_id
        ");

        $property = Workshop_properties::where('workshop_id', $id)->get();
        $comments = DB::table('comments AS cm')
            ->join('anggotas AS ag', 'ag.user_id', '=', 'cm.user_id')
            ->where('cm.workshop_id', $id)
            ->select('ag.avatar', 'ag.nama', 'cm.content', 'cm.created_at')
            ->limit(5)
            ->get();

        return view('member.product-detail', compact('workshops', 'ratings', 'property', 'related', 'comments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'workshop_id' => 'required|integer|exists:workshops,id',
        ]);

        DB::table('comments')->insert([
            'user_id' => Auth::id(),
            'workshop_id' => $request->workshop_id,
            'content' => $request->content,
        ]);

        return back()->with('success', 'Comment submitted!');
    }
}
