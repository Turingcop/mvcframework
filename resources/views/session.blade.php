@include('header')

@php

$url = url("/session/destroy");

echo <<<EOD
<h1>Session</h1>
<p> Reload this page to see the counter increment itself.</p>
<p>You may <a href="$url">flush the session</a> if you like.</p>
EOD;

var_dump(session("counter"));

var_dump(session("game"));



@endphp

@include('footer')