<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Score;

class ScoreController extends Controller
{
    public function show()
    {
        $data = [];
        $score = new Score();
        $data["score"] = $score->all()->sortByDesc('score')->slice(0, 10);
        return view('score', $data);
    }
}