<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LeaderBoardsController extends Controller
{
    public function index()
    {
        return view('admin.apps-leaderboards');
    }
}
