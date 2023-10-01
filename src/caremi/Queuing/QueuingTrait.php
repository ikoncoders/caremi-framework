<?php declare(strict_types=1);

namespace Caremi\Queuing;

use Caremi\Queuing\Queuing;

trait QueuingTrait
{

    public function queue()
    {
        $queue = new Queuing();
        $jobs = true;
        $start = microtime(true);
        try {
            while ($jobs) {
                $item = $queue->claim();
                if ($item) {
                    echo "Processing the item {$item->itemID}....." . PHP_EOL;
                    if ($this->executeJobs($item)) {
                        $queue->delete($item);
                        echo "Item {$item->itemID}. processed" . PHP_EOL;
                    } else {
                        $queue->release($item);
                        echo "Item {$item->itemID} Not processed" . PHP_EOL;
                        $jobs = false;
                        echo "Queue not completed. Job task not executed." . PHP_EOL;
                    }
                } else {
                    $jobs = false;
                    $timeElasped = microtime(true) - $start;
                    $quantity = $queue->quantity();
                    if ($quantity == 0) {
                        echo "Queue completed in {$timeElasped} seconds." . PHP_EOL;
                    } else {
                        echo "Queue not completed, there are {$quantity} item left." . PHP_EOL;
                    }
                }
            }

        } catch(\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function executeJobs(Object $item)
    {
        /** Do something with the item */
        return true;
    }

}