<?php
function modifyNormalZ(array $z, int $columnCount): array
{
    $newZ = [];
    foreach ($z as $Zj) {
        $newZ[] = -1 * $Zj;
    }
    for ($i = count($z); $i < $columnCount; $i++) {
        $newZ[] = 0;
    }

    return $newZ;
}

function modifyZOnPh1(array $artificialVars, int $columnCount): array
{
    $z0 = [];
    for ($i = 0; $i < $columnCount; $i++) {
        if (in_array($i, $artificialVars)) {
            $z0[$i] = -1;
        } else {
            $z0[$i] = 0;
        }
    }

    return $z0;
}