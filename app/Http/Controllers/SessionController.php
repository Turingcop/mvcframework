<?php

declare(strict_types=1);

namespace App\Http\Controllers;

/**
 * Controller for the session routes.
 */
class SessionController
{
    public function index()
    {
        session(["counter" => 1 + session("counter") ?? 0]);
        return view('session');
    }

    public function destroy()
    {
        session()->flush();
        return redirect(url("/session"));
    }
}
