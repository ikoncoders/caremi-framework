<?php declare(strict_types=1);

namespace Caremi\Service\Contracts;

use Caremi\Container\ContainerInterface;

interface ServiceProviderInterface extends ContainerInterface
{

    /**
     * Returns an associative array of service types
     * 
     * * ['logger' => 'PSR\Log\LoggerInterface'] - means the object provides a service named logger
     *                                              that implements the LoggerInterface
     * * ['foo' => '?'] - means teh container provides service name "foo" of unspecified type 
     * * ['bar' => '?Bar\Baz'] - means teh container provides service name "foo" of ?Bar\Baz|null 
     *
     * @return array
     */
    public static function getProvidedServices() : array;

}