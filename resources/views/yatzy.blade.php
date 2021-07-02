@include('header')

@php

$message = $message ?? null;
$checkbox = $checkbox ?? null;
$action = $action ?? null;
$playlabel = $playlabel ?? null;
$name = $name ?? null;
$present = $present ?? null;
$score = $score ?? null;
$round = $round ?? null;
$disabled = $disabled ?? null;
$playername = $playername ?? null;

@endphp

<div class="yatzy">
<h1>Yatzy {{ $round ? ": Runda " . $round : "" }}</h1>
<div>

<form method="POST" action={{ $action }} class="dicecheck">
@csrf

    {!! $present !!}
    {!! $checkbox !!}
    <div class="space"></div>
    <input type="text" name="playername" placeholder="Ange namn" required {{ $disabled }} value='{{ $playername }}'>
    <br>
    <input type="submit" value='{{ $playlabel }}'>
    <p>{{ $flash ?? null }}</p>
</form>
</div>

<table>
  <tr>
    <th colspan="2">Poäng</th>
  </tr>
<tr>
    <td>Ettor</td>
    <td>{{ $score[1] * 1 }}</td>
</tr>
<tr>
    <td>Tvåor</td>
    <td>{{ $score[2] * 2 }}</td>
</tr>
<tr>
    <td>Treor</td>
    <td>{{ $score[3] * 3 }}</td>
</tr>
<tr>
    <td>Fyror</td>
    <td>{{ $score[4] * 4 }}</td>
</tr>
<tr>
    <td>Femmor</td>
    <td>{{ $score[5] * 5 }}</td>
</tr>
<tr>
    <td>Sexor</td>
    <td>{{ $score[6] * 6 }}</td>
</tr>
<tr>
    <td>Summa</td>
    <td>{{ $score["summa"] }}</td>
</tr>
<tr>
    <td>Bonus</td>
    <td>{{ $score["bonus"] }}</td>
</tr>
</table> 
</div>

@include('footer')