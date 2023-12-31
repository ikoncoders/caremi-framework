<?php declare(strict_types=1);

namespace Caremi\Inertia;

use Caremi\Http\Event\RequestEvent;
use Caremi\Http\Event\ResponseEvent;
use Symfony\Component\HttpFoundation\Response;

class InertaiListener
{

    protected $inertia;
    protected $debug;

    public function __construct(InertiaInterface $inertia, bool $debug)
    {
        $this->inertia = $inertia;
        $this->debug = $debug;
    }

    public function onRequest(RequestEvent $event)
    {
        $request = $event->getRequest();
        if (!$request->headers->get('X-Inertia')) {
            return;
        }

        if ('GET' === $request->getMethod() && $request->headers->get('X-Inertia-Version') !== $this->inertia->getVersion()) {
            $response = new Response('', 409, ['X-Inertia-Location' => $request->getUri()]);
            $event->setResponse($response);
        }
    }

    public function onResponse(ResponseEvent $event)
    {
        if (!$event->getRequest()->headers->get('X-Inertia')) {
            return;
        }

        if ($this->debug && $event->getRequest()->isXmlHttpRequest()) {
            $event->getResponse()->headers->set('Caremi-Debug-Toolbar-Replace', 1);
        }

        if ($event->getResponse()->isRedirect() && 302 === $event->getResponse()->getStatusCode() && in_array($event->getRequest()->getMethod(), ['PUT', 'PATCH', 'DELETE'])) {
            $event->getResponse()->setStatusCode(303);
        }
    }

}