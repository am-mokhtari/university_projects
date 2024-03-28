<?php
function show()
{
    global $mainMemory;
    global $externalMemory;

    echo "<br>main memory : <br>";
    print_r($mainMemory);
    echo "<br><br>external memory : <br>";
    print_r($externalMemory);
    echo "<br>-----------------------------------------<br>";
}

function showQueue($process)
{
    echo "<br>count: " . $process->queueCount . "<br>queue of process " . $process->name . " :<br>";

    $process->queue->rewind();
    while ($process->queue->valid()) {
        print_r($process->queue->current());
        echo " , ";
        $process->queue->next();
    }
    echo "<br>-----------------------------------------<br>";
}