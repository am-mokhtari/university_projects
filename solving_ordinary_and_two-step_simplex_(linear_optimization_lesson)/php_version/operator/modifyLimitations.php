<?php

function modifyLimitations($A, $b): array
{
    $needToTwoPhaseMethod = false;
    $slacksCount = 0;
    $columnCount = 0;
    $xb = [];
    $newB = [0];
    $artificialVars = [];

    for ($row = 0; $row < count($b); $row++) {
        $oldColCount = count($A[$row]);
        $j = $oldColCount + $slacksCount;

        if ($b [$row] [0] === 's') {
            $A = setZeroForMatrixA($A, $row, $oldColCount, $j);
            $A[$row][$j] = 1;
            $xb[$row+1] = $j;
            $slacksCount++;
        }

        if ($b [$row] [0] === 'b') {
            $needToTwoPhaseMethod = true;

            $A = setZeroForMatrixA($A, $row, $oldColCount, $j);
            $A[$row][$j] = -1;
            $j++;
            $A[$row][$j] = 1;
            $xb[$row+1] = $j;
            $artificialVars[] = $j;
            $slacksCount += 2;
        }

        if ($b [$row] [0] === 'e') {
            $needToTwoPhaseMethod = true;

            $A = setZeroForMatrixA($A, $row, $oldColCount, $j);
            $A[$row][$j] = 1;
            $xb[$row+1] = $j;
            $artificialVars[] = $j;
            $slacksCount++;
        }

        $columnCount = max($columnCount, $j+1);
        $newB[] = $b[$row][1];
    }
    for ($row = 0; $row < count($A); $row++) {
        $A = setZeroForMatrixA($A, $row, count($A[$row]), $columnCount);
    }

    return [
        'A' => $A,
        'b' => $newB,
        'xb' => $xb,
        'twoPhaseMethod' => $needToTwoPhaseMethod,
        'slacksCount' => $slacksCount,
        'columnCount' => $columnCount,
        'artificialVars' => $artificialVars,
    ];
}

function setZeroForMatrixA($array, $row, $start, $end)
{
    for ($j = $start; $j < $end; $j++) {
        $array[$row][$j] = 0;
    }

    return $array;
}