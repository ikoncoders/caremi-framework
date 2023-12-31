<?php declare(strict_types=1);

namespace Caremi\Middleware;

use Caremi\Middleware\MiddlewareInterface;
use Closure;

class AfterMiddleware implements MiddlewareInterface
{

    /**
     * @inheritdoc
     * @param Object $middleware
     * @param Closure $next
     * @return void
     */
    public function middleware(Object $middleware, Closure $next)
    {
        $response = $next($middleware);
        return $response;
    }
}