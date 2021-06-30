<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\YatzyCheat;
use App\Models\Score;

class Yatzy
{
    use HasFactory;

    use YatzyCheat;

    private $playerhand;
    private $presentationHand;
    private array $scoreboard;
    private int $round = 1;
    private int $rolls = 0;
    private ?string $disable = null;

    public function __construct($dicehand, $dice, $amount)
    {
        $this->playerhand = new $dicehand($dice, $amount);
        $this->scoreboard = [
            1 => 0,
            2 => 0,
            3 => 0,
            4 => 0,
            5 => 0,
            6 => 0,
            "summa" => 0,
            "bonus" => 0
        ];
    }

    public function presentGame()
    {
        $score = new Score;
        error_log("SCORE");
        error_log($score->all()->sortByDesc('score')->offsetExists(9) ? 9 : 0);
        error_log("SCORE END");
        $this->presentationHand = new YatzyHand("App\Models\DiceCheat", 5);
        $data = [
            "header" => "Yatzy",
            "title" => "Yatzy",
            "action" => "/yatzy",
            "playlabel" => "Börja",
           ];

        $this->presentationHand->roll();
        $present = $this->presentationHand->getLastGraphic();
        $data["present"] = "";
        foreach ($present as $die) {
            $data["present"] .= "<label>{$die}</label> ";
        }

        $data["score"] = $this->scoreboard;
        return $data;
    }

    private function highScore()
    {
        $score = new Score;
        $tenth = $score->all()->offsetExists(9) ? $score->all()->sortByDesc('score')->last()->score : 0;
        if ($this->scoreboard["summa"] > $tenth) {
            $score->score = $this->scoreboard["summa"];
            $score->all()->sortByDesc('score')->last()->delete();
            $score->save();
        }
    }

    public function playGame()
    {
        $data = [
            "header" => "Yatzy",
            "title" => "Yatzy",
            "action" => "/yatzy",
            "playlabel" => "Kasta",
           ];

        $this->playerhand->resetSave();
        $this->disable = null;

        if (isset($_POST["dice"])) {
            foreach ($_POST["dice"] as $val) {
                $this->playerhand->saveDice(intval($val));
            };
        }

        $this->rolls++;
        $this->playerhand->roll();

        if ($this->rolls == 3) {
            foreach ($this->playerhand->getLastRoll()[0] as $die) {
                if ($die == $this->round) {
                    $this->scoreboard[$this->round]++;
                }
            }
            $this->rolls = 0;
            $this->disable = "disabled";
            $this->round++;
        }

        $this->calcScore();

        if ($this->round > 6) {
            $this->disable = "disabled";
            $data["playlabel"] = "Börja om";
            $data["action"] = "/yatzy/restart";

            $this->highScore();
        }

        $data["checkbox"] = implode(" ", $this->playerhand->checkDice($this->disable));
        $data["score"] = $this->scoreboard;
        return $data;
    }

    public function calcScore()
    {
        $score = 0;
        for ($i = 1; $i <= 6; $i++) {
            $score += $this->scoreboard[$i] * $i;
        }
        if ($score >= 63) {
            $score += 50;
            $this->scoreboard["bonus"] = 50;
        }

        $this->scoreboard["summa"] = $score;
        return ["score" => $score, "scoreboard" => $this->scoreboard];
    }
}
