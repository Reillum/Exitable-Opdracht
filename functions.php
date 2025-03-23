<?php
require_once "test.php";

function calculateBowlingScore($rolls) {
    $score = 0;
    $frame = 0;
    $rollIndex = 0;
    $frameScores = [];
    $throws = [];

    while ($frame < 10) {
        // Sla de eerste worp op
        $throws[$frame + 1][] = $rolls[$rollIndex];

        if ($frame == 9){ // Speciale behandeling voor het 10e frame
            // Voeg de tweede worp toe
            $throws[$frame + 1][] = $rolls[$rollIndex + 1];

            // Controleer of een derde worp nodig is (bij strike of spare)
            if ($rolls[$rollIndex] == 10 || ($rolls[$rollIndex] + $rolls[$rollIndex + 1] == 10)) {
                $throws[$frame + 1][] = $rolls[$rollIndex + 2];
                $score += $rolls[$rollIndex] + $rolls[$rollIndex + 1] + $rolls[$rollIndex + 2];
            } else {
                $score += $rolls[$rollIndex] + $rolls[$rollIndex + 1];
            }

            $frameScores[$frame + 1] = $score;
            break;
        }

        if (isStrike($rolls, $rollIndex)){
            $score += 10 + strikeBonus($rolls, $rollIndex);
            $frameScores[$frame + 1] = $score;
            $rollIndex++;
        } 
        
        elseif (isSpare($rolls, $rollIndex)){
            $throws[$frame + 1][] = $rolls[$rollIndex + 1];
            $score += 10 + spareBonus($rolls, $rollIndex);
            $frameScores[$frame + 1] = $score;
            $rollIndex += 2;
        } 
        
        else {
            $throws[$frame + 1][] = $rolls[$rollIndex + 1];
            $score += sumOfTwoRolls($rolls, $rollIndex);
            $frameScores[$frame + 1] = $score;
            $rollIndex += 2;
        }

        $frame++;
    }

    return ['scores' => $frameScores, 'throws' => $throws];
}


function isStrike($rolls, $rollIndex) {
    return $rolls[$rollIndex] === 10;
}

function strikeBonus($rolls, $rollIndex) {
    return ($rolls[$rollIndex + 1] ?? 0) + ($rolls[$rollIndex + 2] ?? 0);
}

function isSpare($rolls, $rollIndex) {
    return ($rolls[$rollIndex] + ($rolls[$rollIndex + 1] ?? 0)) === 10;
}

function spareBonus($rolls, $rollIndex) {
    return $rolls[$rollIndex + 2] ?? 0;
}

function sumOfTwoRolls($rolls, $rollIndex) {
    return ($rolls[$rollIndex] ?? 0) + ($rolls[$rollIndex + 1] ?? 0);
}

function determineWinner($player_1_score, $player_2_score) {
    if ($player_1_score == $player_2_score) {
        $winner = "Het is gelijkspel!\n";
    } 
    
    elseif ($player_1_score > $player_2_score) {
        $winner = "Speler 1 wint!\n";
    } 
    
    else {
        $winner = "Speler 2 wint!\n";
    }
    return $winner;
}

function renderPageBegin(){
    echo "<!DOCTYPE html>";
    echo "<html>";
    echo "<head>";
    echo "<title>Bowling Score</title>";
    echo "<link rel='stylesheet' href='style.css'>";
    echo "</head>";
    echo "<body>";
}

function renderPageEnd(){
    echo "</body>";
    echo "</html>";
}

?>
