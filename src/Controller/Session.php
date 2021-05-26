<?php

declare(strict_types=1);

namespace siev20\Controller;

use Psr\Http\Message\ResponseInterface;

use function Mos\Functions\{
    destroySession,
    renderView,
    url
};

/**
 * Controller for the session routes.
 */
class Session extends ControllerBase
{
    public function index(): ResponseInterface
    {
        $body = renderView("layout/session.php");
        return view('session');
    }

    public function destroy(): ResponseInterface
    {
        $request->session()->flush();
        return $redirect(url("/session"));
    }
}
