<?php declare(strict_types=1);
namespace Caremi\Session\Exception;

use Caremi\Base\Exception\BaseUnexpectedValueException;

class SessionUnexpectedValueException extends BaseUnexpectedValueException
{

    public function __construct(
        string $message = null,
        int $code = 0,
        BaseUnexpectedValueException $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
