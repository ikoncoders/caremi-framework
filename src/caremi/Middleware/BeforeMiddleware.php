<?php declare(strict_types=1);

namespace Caremi\Middleware;

use Caremi\Middleware\MiddlewareInterface;
use Closure;

class BeforeMiddleware implements MiddlewareInterface
{

    /**
     * @inheritdoc
     * @param Object $middleware
     * @param Closure $next
     * @return void
     */
    public function middleware(Object $middleware, Closure $next)
    {
        return $next($middleware);
    }
}