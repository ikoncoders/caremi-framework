<?php declare(strict_types=1);

namespace Caremi\Http\Factory;

use Caremi\Http\Message\UriInterface;
use Caremi\Http\Message\RequestInterface;

interface RequestFactoryInterface
{
    /**
     * Create a new request.
     *
     * @param string $method The HTTP method associated with the request.
     * @param UriInterface|string $uri The URI associated with the request. 
     */
    public function createRequest(string $method, $uri): RequestInterface;
}