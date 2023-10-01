<?php declare(strict_types=1);
namespace Caremi\Service\Contracts;

interface ServiceSubscriberInterface
{

    public static function getSubscribedServices() : array;

}