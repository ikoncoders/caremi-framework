<?php declare(strict_types=1);

namespace Caremi\Middleware;

use Closure;

interface MiddlewareInterface
{

    /**
     * Undocumented function
     *
     * @param Object $middleware
     * @param Closure $next
     * @return void
     */
    public function middleware(Object $middleware, Closure $next);

}