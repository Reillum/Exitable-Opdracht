<?php
require_once "functions.php";

$player_1_rolls = [10, 7, 3, 9, 1, 10, 10, 10, 2, 3, 6, 4, 10, 7, 2, 6, 4, 9, 1];

$player_2_rolls = [9, 0, 8, 2, 7, 3, 10, 5, 4, 9, 1, 8, 2, 7, 3, 10, 6, 4, 5];

$player_1_score = calculateBowlingScore($player_1_rolls);
$player_2_score = calculateBowlingScore($player_2_rolls);

echo "<h2>Bowling Score Tracker</h2>";

echo "<h3>Score Speler 1:</h3>";
for ($i = 0; $i < count($player_1_score); $i++) {
    echo "Frame " . ($i + 1) . ": " . $player_1_score[$i] . "<br>";
}

echo "<h3>Score Speler 2:</h3>";
for ($i = 0; $i < count($player_2_score); $i++) {
    echo "Frame " . ($i + 1) . ": " . $player_2_score[$i] . "<br>";
}

echo "<br>";

determineWinner($player_1_score,$player_2_score);
?>