<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Score;

class ScoreController extends Controller
{
    public function show()
    {
        $data = [];
        $data['score'] = [];
        $score = new Score();
        $data["score"] = $score->all()->sortByDesc('score')->values();
        return view('score', $data);
    }
}
