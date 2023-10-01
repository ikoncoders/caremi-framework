<?php declare(strict_types=1);

namespace Caremi\Utility;

class Microtiming
{

    public function execution(callable $callback = null)
    {
        $time = microtime(true);
        if (is_callable($callback) && $callback !== null) {
            call_user_func($callback);
        }
        $time = microtime(true) - $time;
        return [
            $time . ' s',
            ($time * 1000) . ' ms'
        ];
    }
}
