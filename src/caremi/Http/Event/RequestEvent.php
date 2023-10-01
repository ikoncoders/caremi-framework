<?php declare(strict_types=1);

namespace Caremi\Http\Event;

use Caremi\Http\ResponseHandler;
use Caremi\Http\Event\BaseEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class RequestEvent extends BaseEvent
{

    private $response;

    /**
     * Returns the response object.
     *
     * @return Response|null
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Sets a response and stops event propagation.
     */
    public function setResponse(Response $response)
    {
        $this->response = $response->handler();
        $this->stopPropagation();
    }

    /**
     * Returns whether a response was set.
     *
     * @return bool Whether a response was set
     */
    public function hasResponse()
    {
        return null !== $this->response->handler();
    }


}
