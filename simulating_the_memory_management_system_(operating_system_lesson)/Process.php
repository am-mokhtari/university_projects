<?php

class Process
{
    public string $name;
    public string $size;
    public array $pageTable;
    public SplQueue $queue;
    public int $queueCount;

    public function __construct(string $name, int $size)
    {
        global $externalMemory;

        $this->name = $name;
        $this->size = $size;
        $this->queue = new SplQueue();
        $this->queueCount = 0;

        if ($size % 32 == 0) {
            $pageCount = $size / 32;
        } else {
            $pageCount = $size / 32 + 1;
        }

        for ($number = 0; $number < $pageCount; $number++) {
            $externalMemory[$this->name][] = $name . $number;
            $this->pageTable[$name . $number] = $number;
        }
    }

    public function callPageProcess($pageNumber)
    {
        global $mainMemory;
        global $externalMemory;

        $pageName = $this->name . $pageNumber;
        if (key_exists($pageName, $this->pageTable)) {

            if ($this->in_queue($pageName)) {
                echo $pageName . " is exists in main memory.";

            } elseif ($this->queueCount >= 3) {
                $outer = $this->queue->dequeue();
                unset($externalMemory[$this->name][array_search($pageName, $externalMemory[$this->name])]);
                $externalMemory[$this->name][] = $outer;

                $key = array_search($outer, $mainMemory);

                $mainMemory[$key] = $pageName;
                $this->queue->enqueue($pageName);

            } else {
                unset($externalMemory[$this->name][array_search($pageName, $externalMemory[$this->name])]);

                $nullKey = null;
                foreach ($mainMemory as $key => $item) {
                    if (is_null($item)) {
                        $nullKey = $key;
                        break;
                    }
                }

                if (is_null($nullKey)) {
                    $mainMemory[] = $pageName;
                } else {
                    $mainMemory[$nullKey] = $pageName;
                }

                $this->queue->enqueue($pageName);

                $this->queueCount++;
            }

        } else {
            echo "pageNumber is invalid";
        }
    }

    public
    function takeOutPage($pageNumber)
    {
        global $mainMemory;
        global $externalMemory;

        $pageName = $this->name . $pageNumber;
        if (!in_array($pageName, $mainMemory)) {
            echo "page is not exists in main memory.";
        } else {
            $key = array_search($pageName, $mainMemory);
            $mainMemory[$key] = null;
            $externalMemory[$this->name][$pageNumber] = $pageName;
            $this->removeFromQueue($pageName);
            $this->queueCount--;
        }
    }

    private
    function in_queue($need)
    {
        $this->queue->rewind();
        while ($this->queue->valid()) {
            if ($this->queue->current() == $need) {
                return true;
            }
            $this->queue->next();
        }
        return false;
    }

    private
    function removeFromQueue($element)
    {
        $newQueue = new SplQueue();
        $this->queue->rewind();

        while ($this->queue->valid()) {
            if ($this->queue->current() !== $element) {
                $newQueue->enqueue($this->queue->current());
            }
            $this->queue->next();
        }
        $newQueue->rewind();
        $this->queue = $newQueue;
    }
}