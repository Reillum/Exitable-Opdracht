<?php
require_once "functions.php";
echo renderPageBegin();


// Testspelers
$player1_rolls = [10, 7, 3, 9, 0, 10, 10, 8, 1, 9, 1, 10, 10, 7, 2, 10, 10, 8, 2, 9];
$player2_rolls = [9, 0, 8, 2, 7, 3, 10, 5, 4, 9, 1, 8, 2, 10, 6, 3, 10, 6, 4, 10];

$player1_data = calculateBowlingScore($player1_rolls);
$player2_data = calculateBowlingScore($player2_rolls);
$winner = determineWinner(end($player1_data['scores']), end($player2_data['scores']));

echo "<h2>Bowling Score Overzicht</h2>";

echo "<table>";

echo "<tr>";
echo "<th>Frame</th>";
echo "<th>Speler 1 Worpen</th>";
echo "<th>Speler 1 Score</th>";
echo "<th>Speler 2 Worpen</th>";
echo "<th>Speler 2 Score</th>";
echo "</tr>";

for ($i = 1; $i <= 10; $i++):
    echo "<tr>";
    echo "<td>" . $i . "</td>";
    echo "<td>" . (isset($player1_data['throws'][$i]) ? implode(", ", $player1_data['throws'][$i]) : "-") . "</td>";
    echo "<td>" . ($player1_data['scores'][$i] ?? 0) . "</td>";
    echo "<td>" . (isset($player2_data['throws'][$i]) ? implode(", ", $player2_data['throws'][$i]) : "-") . "</td>";
    echo "<td>" . ($player2_data['scores'][$i] ?? 0) . "</td>";
    echo "</tr>";    
    endfor;

echo "</table>";

echo "<h2>$winner</h2>";

echo renderPageEnd();

?>