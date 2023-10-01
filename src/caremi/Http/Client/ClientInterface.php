<?php declare(strict_types=1);

namespace Caremi\Http\Client;

use Caremi\Http\Message\RequestInterface;
use Caremi\Http\Message\ResponseInterface;
use Caremi\Http\Client\ClientExceptionInterface;

interface ClientInterface
{

    /**
     * Sends a PSR-7 request and returns a PSR-7 response.
     *
     * @param RequestInterface $request
     *
     * @return ResponseInterface
     *
     * @throws ClientExceptionInterface If an error happens while processing the request.
     */
    public function sendRequest(RequestInterface $request): ResponseInterface;

}
