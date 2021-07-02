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
    public ?string $playername = null;

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
        $this->presentationHand = new YatzyHand("App\Models\DiceCheat", 5);
        $data = [
            "header" => "Yatzy",
            "title" => "Yatzy",
            "action" => "/yatzy",
            "playlabel" => "Börja",
            "name" => 'playername'
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

    private function setName()
    {
        $data['playername'] = $_POST['playername'] ?? $this->playername;
        $this->playername = $_POST['playername'] ?? $this->playername;
        $data["disabled"] = 'disabled';
        return $data;
    }

    private function resetName()
    {
        $data["disabled"] = '';
        $data["playername"] = '';
        return $data;
    }

    private function highScore()
    {
        $tenth = Score::all()->offsetExists(9) ? $score->all()->sortByDesc('score')->last()->score : 0;
        if ($this->scoreboard["summa"] > $tenth) {
            $data['flash'] = "Grattis, din poäng placerar dig bland de tio bästa!";
            Score::create([
                'score' => $this->scoreboard["summa"],
                'name' => $this->playername,
            ]);
            return $data;
        }
    }

    public function playGame()
    {
        $data = [
            "header" => "Yatzy",
            "title" => "Yatzy",
            "action" => "/yatzy",
            "playlabel" => "Kasta",
            "round" => $this->round,
           ];
        $data = array_merge($data, $this->setName());
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

            $data = array_merge($data, $this->highScore());
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
