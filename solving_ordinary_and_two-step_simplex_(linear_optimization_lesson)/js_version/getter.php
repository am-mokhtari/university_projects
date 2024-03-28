<?php
require_once('./operator/main.php');

$typeOfQuestion = $_POST['type'];

$z = explode(',', $_POST['z']);
for ($j = 0; $j < count($z); $j++) {
    $z[$j] = intval($z[$j]);
}

$arr = explode(';', $_POST['a']);
for ($i = 0; $i < count($arr); $i++) {
    $arr2 = explode(',', $arr[$i]);
    for ($j = 0; $j < count($arr2); $j++) {
        $A[$i][$j] = intval($arr2[$j]);
    }
}

$bType = explode(',', $_POST['limitType']);
$bNums = explode(',', $_POST['b']);
for ($i = 0; $i < count($bNums); $i++) {
    $b[$i] = [$bType[$i], intval($bNums[$i])];
}
//var_dump($z);
//echo "<br>";
//echo "<br>";
//var_dump($A);
//echo "<br>";
//echo "<br>";
//var_dump($b);
//echo "<br>";
//echo "<br>";
//var_dump($typeOfQuestion);
//echo "<br>";
//echo "<br>";
//die();
$simplex = simplex($z, $A, $b, $typeOfQuestion);
$z = $simplex['z'];
$zAndA = $simplex['zAndA'];
$A = $simplex['A'];
$b = $simplex['b'];
$xb = $simplex['xb'];
$needToTwoPhaseMethod = $simplex['needToTwoPhaseMethod'];
$slacksCount = $simplex['slacksCount'];
$artificialVars = $simplex['artificialVars'];
$columnCount = $simplex['columnCount'];
$rowCount = $simplex['rowCount'];
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Answer</title>
    <style>
        #table {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
        }

        #table td, #table th {
            border: 1px solid #ddd;
            padding: 5px 25px;
            text-align: center;
        }

        #table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #table tr:hover {
            background-color: #ddd;
        }

        #table th {
            padding-top: 10px;
            padding-bottom: 10px;
            background-color: #04AA6D;
            color: white;
        }
    </style>
</head>
<body>
<table id="table">
    <tr>
        <th>#</th>
        <?php
        for ($col = 0; $col < $columnCount + 1; $col++) {
            ?>
            <th><?= $col ?></th>
            <?php
        }
        ?>
    </tr>
    <?php
    for ($i = 0;
         $i < $rowCount;
         $i++) {
        ?>
        <tr>
            <?php
            if ($i === 0) {
                ?>
                <th>Z</th>
            <?php } else { ?>
                <th><?= $xb[$i] ?></th>
                <?php
            }
            foreach ($zAndA[$i] as $key => $value) { ?>
                <td>
                    <?= $value ?>
                </td>
            <?php } ?>
            <td>
                <?= $b[$i] ?>
            </td>
        </tr>
        <br><br>
    <?php } ?>
</table>
<?php
echo '<br>b: ';
var_dump($b);
echo '<br><br>';
echo '$xb: ';
var_dump($xb);
echo '<br><br>';
echo '$needToTwoPhaseMethod: ';
var_dump($needToTwoPhaseMethod);
echo '<br><br>';
echo '$slacksCount: ';
var_dump($slacksCount);
echo '<br><br>';
echo '$artificialVars: ';
var_dump($artificialVars);
echo '<br><br>';
echo '$columnCount: ';
var_dump($columnCount);
echo '<br><br>';
echo '$rowCount: ';
var_dump($rowCount);
echo '<br><br>';
echo '$newZ: ';
var_dump($z);
echo '<br><br>';
?>
</body>
</html>
