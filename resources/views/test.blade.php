@include('header')


{{ $res }}

<form method="post" action="/test">
@csrf

<input type="submit"></form>

@include('footer')