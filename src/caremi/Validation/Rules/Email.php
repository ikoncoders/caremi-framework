<?php declare(strict_types=1);

namespace Caremi\ValidationRule\Rules;

use Caremi\Error\Error;
use Caremi\ValidationRule\ValidationRuleMethods;

class Email extends ValidationRuleMethods
{

    public function email(object $controller, object $validationClass)
    {
        if (isset($validationClass->key)) {
            if (filter_var($validationClass->value, FILTER_VALIDATE_EMAIL) === false) {
                $this->getError(Error::display('err_invalid_email'), $controller, $validationClass);
            }
        }
    }
}
