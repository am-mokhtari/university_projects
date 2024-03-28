<?php
function becomeOnce($zAndA, $b, $xb, $rowCount, $columnCount): array
{
    foreach ($xb as $row => $x) {
        for ($i = 0; $i < $rowCount; $i++) {

            $pivotNum = $zAndA[$i][$x];
            if ($pivotNum !== 0) {
                if ($i === $row) {
                    if (intval($pivotNum) === 1) {
                        continue;
                    }
                    die("code has bug!");
                } else {
                    $b[$i] = $b[$i] + $b[$row] * $pivotNum * -1;
                    for ($j = 0; $j < $columnCount; $j++) {
                        $zAndA[$i][$j] = $zAndA[$i][$j] + $zAndA[$row][$j] * $pivotNum * -1;
                    }
                }
            }
        }
    }
    $z = $zAndA[0];

    return [
        'z' => $z,
        'zAndA' => $zAndA,
        'b' => $b,
    ];
}