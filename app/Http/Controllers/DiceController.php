<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Dice;


class DiceController extends BaseController
{
   public function show() {
       $dice = new Dice();
       $dice->roll();

       return view('test', ['res' => $dice->getLastRoll()]);
   }
}