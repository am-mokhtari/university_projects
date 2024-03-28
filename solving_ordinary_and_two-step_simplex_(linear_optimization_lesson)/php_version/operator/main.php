<?php
require_once('modifyLimitations.php');
require_once('modifyZFunc.php');
require_once('BecomeOnce.php');
require_once('simplexOperations.php');
function simplex($z, $A, $b, $typeOfQuestion): array
{
//  Part one: modifying limitations & Z function
    $limitations = modifyLimitations($A, $b);

    $A = $limitations['A'];
    $b = $limitations['b'];
    $xb = $limitations['xb'];
    $needToTwoPhaseMethod = $limitations['twoPhaseMethod'];
    $slacksCount = $limitations['slacksCount'];
    $artificialVars = $limitations['artificialVars'];
    $columnCount = $limitations['columnCount'];
    $rowCount = count($b);

    if ($needToTwoPhaseMethod) {
        $newZ = modifyZOnPh1($artificialVars, $columnCount);
    } else {
        $newZ = modifyNormalZ($z, $columnCount);
    }

    $zAndA[] = $newZ;
    for ($i = 0; $i < $rowCount - 1; $i++) {
        $zAndA[] = $A[$i];
    }

//  Part two: check row and col xb & grow once
    $onceTable = becomeOnce($zAndA, $b, $xb, $rowCount, $columnCount);
    $newZ = $onceTable['z'];
    $zAndA = $onceTable['zAndA'];
    $b = $onceTable['b'];

//  Part three: check two phase need and solve simplex
//  Find min in z:

    $simplex = simplexOpt($typeOfQuestion, $newZ, $zAndA, $xb, $b, $rowCount, $columnCount);
    $newZ = $simplex['z'];
    $zAndA = $simplex['zAndA'];
    $b = $simplex['b'];
    $xb = $simplex['xb'];

    if ($needToTwoPhaseMethod) {
//        without answer
        if ($b[0] != 0) {
            die('The question does not have answer!');
        }

        $needToTwoPhaseMethod = false;

        $newZ = modifyNormalZ($z, $columnCount);
        $zAndA[0] = $newZ;

        $onceTable = becomeOnce($zAndA, $b, $xb, $rowCount, $columnCount);
        $newZ = $onceTable['z'];
        $zAndA = $onceTable['zAndA'];
        $b = $onceTable['b'];

        $simplex = simplexOpt($typeOfQuestion, $newZ, $zAndA, $xb, $b, $rowCount, $columnCount);
        $newZ = $simplex['z'];
        $zAndA = $simplex['zAndA'];
        $b = $simplex['b'];
        $xb = $simplex['xb'];
    }

//    multiple answer
    foreach ($newZ as $key => $Zj) {
        if ($Zj === 0 && !in_array($key, $xb)) {
            die('The question has multiple answer.');
        }
    }

//  answer
    return [
        'z' => $newZ,
        'zAndA' => $zAndA,
        'A' => $A,
        'b' => $b,
        'xb' => $xb,
        'needToTwoPhaseMethod' => $needToTwoPhaseMethod,
        'slacksCount' => $slacksCount,
        'artificialVars' => $artificialVars,
        'columnCount' => $columnCount,
        'rowCount' => $rowCount,
    ];
}