<?php declare(strict_types=1);
namespace Caremi\Container\Exception;

use Caremi\Container\Exception\ContainerException;
use Caremi\Container\Exception\NotFoundExceptionInterface;

/** PSR-11 Container */
class DependencyNotRegisteredException extends ContainerException implements NotFoundExceptionInterface
{
}
