<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Yatzy;

class YatzyController extends Controller
{
    public function start()
    {
        $game = new Yatzy("App\Models\YatzyHand", "App\Models\DiceGraphic", 5);
        session(['game' => $game]);
        $data = $game->presentGame();
        return view('yatzy', ['data' => $data]);
    }

    public function play()
    {
        $data = session('game')->playGame();
        return view('yatzy', ['data' => $data]);
    }

    public function reset()
    {
        session(['game' => '']);
        return redirect("/yatzy");
    }
}
