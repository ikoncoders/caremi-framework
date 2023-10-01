<?php declare(strict_types=1);

namespace Caremi\Http\Event;

use Caremi\Http\RequestHandler;
use Caremi\Http\ResponseHandler;
use Caremi\Http\Event\BaseEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * Allows to filter a Response object.
 *
 * You can call getResponse() to retrieve the current response. With
 * setResponse() you can set a new response that will be returned to the
 * browser.
 * @credit Symfony
 */
class ResponseEvent extends BaseEvent
{
    private $response;

    public function __construct(Request $request, int $requestType, Response $response)
    {
        parent::__construct($request, $requestType);
        $this->setResponse($response);
    }

    public function getResponse()
    {
        return $this->response;
    }

    public function setResponse(Response $response): void
    {
        $this->response = $response;
    }
}
