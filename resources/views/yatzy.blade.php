@include('header')

<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

// declare(strict_types=1);

$message = $data['message'] ?? null;
$checkbox = $data['checkbox'] ?? null;
$action = $data['action'] ?? null;
$playlabel = $data['playlabel'] ?? null;
$present = $data['present'] ?? null;
$score = $data['score'] ?? null;

?>
<div class="yatzy">
<h1>Yatzy</h1>
<div>

<form method="POST" action='<?= $action ?>' class="dicecheck">
@csrf

    <?= $present ?>
    <?= $checkbox ?>
    <div class="space"></div>
    <input type="submit" value='<?= $playlabel ?>'>
</form>
</div>

<table>
  <tr>
    <th colspan="2">Poäng</th>
  </tr>
<tr>
    <td>Ettor</td>
    <td><?= $score[1] * 1 ?></td>
</tr>
<tr>
    <td>Tvåor</td>
    <td><?= $score[2] * 2 ?></td>
</tr>
<tr>
    <td>Treor</td>
    <td><?= $score[3] * 3 ?></td>
</tr>
<tr>
    <td>Fyror</td>
    <td><?= $score[4] * 4 ?></td>
</tr>
<tr>
    <td>Femmor</td>
    <td><?= $score[5] * 5 ?></td>
</tr>
<tr>
    <td>Sexor</td>
    <td><?= $score[6] * 6 ?></td>
</tr>
<tr>
    <td>Summa</td>
    <td><?= $score["summa"]?></td>
</tr>
<tr>
    <td>Bonus</td>
    <td><?= $score["bonus"]?></td>
</tr>
</table> 
</div>

@include('footer')