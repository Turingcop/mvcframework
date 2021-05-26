<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Tests\TestCase;

class DiceControllerTest extends TestCase
{
    public function testShow()
    {
        $controller = new DiceController();
        $res = $controller->show();
        $this->assertInstanceOf("Illuminate\View\View", $res);
    }
}
