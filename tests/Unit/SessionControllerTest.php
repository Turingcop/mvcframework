<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Tests\TestCase;

class SessionControllerTest extends TestCase
{
    public function testIndex()
    {
        $controller = new SessionController();
        $controller->index();
        $this->assertEquals(1, session('counter'));
    }

    public function testDestroy()
    {
        $controller = new SessionController();
        $controller->index();
        $this->assertEquals(1, session('counter'));
        $controller->destroy();
        $this->assertEquals(null, session('counter'));
    }
}
