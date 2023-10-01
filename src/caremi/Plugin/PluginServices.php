<?php declare(strict_types=1);

namespace Caremi\Plugin;

class PluginServices
{

    /**
     * Services available for plugin developement
     * @return array
     */
    public const PLUGIN_SERVICES = [
        'error' => \Caremi\Error\Error::class,
        'request' => \Caremi\Http\RequestHandler::class,
        'response'  => \Caremi\Http\ResponseHandler::class,
        'clientRepository' => '' /* left empty */
    ];
}
