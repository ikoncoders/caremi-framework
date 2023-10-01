<?php declare(strict_types=1);
namespace Caremi\Container\Exception;

use Caremi\Base\Exception\BaseInvalidArgumentException;
use Caremi\Container\Exception\ContainerExceptionInterface;

/** PSR-11 Container */
class ContainerInvalidArgumentException extends BaseInvalidArgumentException implements ContainerExceptionInterface
{
}
