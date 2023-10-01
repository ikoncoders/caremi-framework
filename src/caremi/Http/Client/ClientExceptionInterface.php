<?php declare(strict_types=1);

namespace Caremi\Http\Client;

use Throwable;

/**
 * Every HTTP client related exception MUST implement this interface.
 */
interface ClientExceptionInterface extends Throwable
{
}
