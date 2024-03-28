<?php
function simplexOpt($typeOfQuestion, $z, $zAndA, $xb, $b, $rowCount, $columnCount): array
{
    $continue = hasIncomeColumn($typeOfQuestion, $z);
    $counter = 0;

//    $test = 1;
    while ($continue) {
        $counter = loop($counter);


//        if ($test === 1){
//            for ($i = 0; $i < $rowCount; $i++) {
//                foreach ($zAndA[$i] as $key => $value) {
//                    echo $key . ' => ' . "[";
//                    var_dump($value);
//                    echo "]" . " ___ ";
//                }
//                echo $b[$i];
//                echo '<br>';
//                echo '<br>';
//            }
//            die();
//        }
//        $test++;

        $pivotColumn = ["col" => 0, "value" => $z[0]];
        if ($typeOfQuestion === "min") {
            foreach ($z as $j => $Zj) {
                if ($Zj > $pivotColumn['value'])
                    $pivotColumn = ['col' => $j, 'value' => $Zj];
            }
        } elseif ($typeOfQuestion === "max") {
            foreach ($z as $j => $Zj) {
                if ($Zj < $pivotColumn['value'])
                    $pivotColumn = ['col' => $j, 'value' => $Zj];
            }
        } else {
            die("type of question is wrong!");
        }

        $pivotRow = ["row" => 0, "value" => $b[1]];
        $hasOuterRow = false;
        for ($i = 1; $i < $rowCount; $i++) {
            if ($zAndA[$i][$pivotColumn["col"]] > 0 && $b[$i] / $zAndA[$i][$pivotColumn['col']] <= $pivotRow["value"]) {
                $hasOuterRow = true;
                $pivotRow = [
                    "row" => $i,
                    "value" => $b[$i] / $zAndA[$i][$pivotColumn['col']],
                ];
            }
        }
//        outer error
        if (!$hasOuterRow) {
            die('The question has infinite answers.');
        }

        $pivotNum = $zAndA[$pivotRow['row']][$pivotColumn['col']];

        $b[$pivotRow['row']] = $b[$pivotRow['row']] / $pivotNum;

        $xb[$pivotRow["row"]] = $pivotColumn["col"];
        for ($j = 0; $j < $columnCount; $j++) {
            $zAndA[$pivotRow['row']][$j] = $zAndA[$pivotRow['row']][$j] / $pivotNum;
        }
        $onceTable = becomeOnce($zAndA, $b, $xb, $rowCount, $columnCount);
        $z = $onceTable['z'];
        $zAndA = $onceTable['zAndA'];
        $b = $onceTable['b'];

        $continue = hasIncomeColumn($typeOfQuestion, $z);
    }

    return [
        'z' => $z,
        'zAndA' => $zAndA,
        'b' => $b,
        'xb' => $xb,
    ];
}

function hasIncomeColumn($typeOfQuestion, $z): bool
{
    if ($typeOfQuestion === "min") {
        foreach ($z as $Zj) {
            if ($Zj > 0) {
                return true;
            }
        }
        return false;
    } elseif ($typeOfQuestion === "max") {
        foreach ($z as $Zj) {
            if ($Zj < 0) {
                return true;
            }
        }
        return false;
    } else {
        die("type of question is wrong!");
    }
}

function loop($counter)
{
    $counter++;

    if ($counter > 10) {
        die("program is in loop!");
    }
    return $counter;
}