<?php declare(strict_types=1);

namespace Caremi\Http\Factory;

use Caremi\Http\Message\UriInterface;
use Caremi\Base\Exception\BaseInvalidArgumentException;

interface UriFactoryInterface
{
    /**
     * Create a new URI.
     *
     * @param string $uri The URI to parse.
     *
     * @throws BaseInvalidArgumentException If the given URI cannot be parsed.
     */
    public function createUri(string $uri = '') : UriInterface;
}