<?php
require_once "test.php";

function calculateBowlingScore($rolls){
    $score = 0;
    $frame = 0;
    $rollIndex = 0;
    $frameScore = [];

    //Itereren door alle worpen voor elke frame
    while ($frame < 10){
        if (isStrike($rolls, $rollIndex)){
            //Strike: 10 punten + volgende 2 worpen 
            $score += 10 + strikeBonus($rolls, $rollIndex);
            $frameScore[] = $score;
            $rollIndex++; //Naar de volgende worp gaan
        }

        elseif(isSpare($rolls, $rollIndex)){
            //Spare: 10 punten + de volgende worp
            $score += 10 + spareBonus($rolls, $rollIndex);
            $frameScore[] = $score;
            $rollIndex += 2;
        }

        else{
            $score += sumOfTwoRolls($rolls, $rollIndex);
            $frameScore[] = $score;
            $rollIndex += 2;
        }
        $frame ++;
    }
    return $frameScore;
}

function isStrike($rolls, $rollIndex){
    return $rolls[$rollIndex] === 10;
}

function strikeBonus($rolls, $rollIndex){
    return $rolls[$rollIndex + 1] + $rolls[$rollIndex + 2];
}

function isSpare($rolls, $rollIndex){
    return $rolls[$rollIndex] + $rolls[$rollIndex + 1] === 10;
}

function spareBonus($rolls, $rollIndex){
    return $rolls[$rollIndex + 2];
}

function sumOfTwoRolls($rolls, $rollIndex){
    return $rolls[$rollIndex] + $rolls[$rollIndex + 1];

}

function determineWinner($player_1_score, $player_2_score){
    if ($player_1_score == $player_2_score){
        echo "Het is gelijkspel!";
    }
    
    elseif ($player_1_score > $player_2_score){
        echo "Speler 1 wint!";
    }

    else{
        echo "Speler 2 wint!";
    }

}

?>