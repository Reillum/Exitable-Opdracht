<?php

function calculateBowlingScore($rolls){
    $score = 0;
    $frame = 0;
    $rollIndex = 0;

    //Itereren door alle worpen voor elke frame
    while ($frame < 10){
        if (isStrike($rolls, $rollIndex)){
            //Strike: 10 punten + volgende 2 worpen 
            $score += 10 + strikeBonus($rolls, $rollIndex);
            $rollIndex++ //Naar de volgende worp gaan
        }

        elseif(isSpare($rolls, $rollIndex)){
            //Spare: 10 punten + de volgende worp
            $score += 10 + spareBonus($rolls, $rollIndex);
            $rollIndex += 2;
        }

        else{
            $score += sumOfTwoRolls($rolls, $rollIndex);
            $rollIndex += 2;
        }
        $frame ++;
    }
    return $score;
}

function isStrike($rolls, $rollsIndex){
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



?>