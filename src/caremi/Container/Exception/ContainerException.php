<?php declare(strict_types=1);
namespace Caremi\Container\Exception;

use Caremi\Base\Exception\BaseException;
use Caremi\Container\Exception\ContainerExceptionInterface;

/** PSR-11 Container */
class ContainerException extends BaseException implements ContainerExceptionInterface
{
}
