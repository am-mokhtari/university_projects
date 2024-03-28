<?php
require_once('./Process.php');
include_once('./functions.php');

global $mainMemory;
global $externalMemory;
$mainMemory = [];
$externalMemory = [];

//------ Adding
$A = new Process('A', 100);

//------ Calling
$A->callPageProcess(0);
$A->callPageProcess(1);
show();
showQueue($A);

echo "<br>replace--///////////--takeout<br>";

//------ Takeout
$A->takeOutPage(1);
$A->callPageProcess(2);
show();
showQueue($A);

