<?php

declare(strict_types=1);

namespace App\Traits;

trait YatzyCheat
{
    private array $scoreboard;
    public function cheatScore()
    {
        $this->scoreboard = [
            1 => 3,
            2 => 3,
            3 => 3,
            4 => 3,
            5 => 3,
            6 => 3,
            "summa" => 0,
            "bonus" => 0
        ];
    }
}
