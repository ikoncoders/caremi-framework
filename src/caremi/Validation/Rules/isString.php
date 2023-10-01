<?php
declare(strict_types=1);

namespace Caremi\ValidationRule\Rules;

use Caremi\Error\Error;
use Caremi\ValidationRule\ValidationRuleMethods;

class isString extends ValidationRuleMethods
{

    public function isString(object $controller, object $validationClass)
    {
        if (isset($validationClass->key)) {
            if (!is_string($validationClass->value)) {
                $this->getError(Error::display('err_invalid_string'), $controller, $validationClass);
            }
        }
    }
}
