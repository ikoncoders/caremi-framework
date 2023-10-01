<?php declare(strict_types=1);
namespace Caremi\Router\Exception;

use BadFunctionCallException;

class RouterNoControllerFoundException extends BadFunctionCallException
{}