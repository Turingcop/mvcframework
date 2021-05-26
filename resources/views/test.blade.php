@include('header')


<p>{{ $res }}</p>

<form method="post" action={{url("/test")}}>
@csrf

<input type="submit" value="Kasta"></form>

@include('footer')