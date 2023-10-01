<?php
declare(strict_types=1);

namespace Caremi\ValidationRule\Rules;

use Caremi\Error\Error;
use Caremi\ValidationRule\ValidationRuleMethods;

class isInt extends ValidationRuleMethods
{

    public function isInt(object $controller, object $validationClass)
    {
        if (isset($validationClass->key)) {
            if (!is_int($validationClass->value)) {
                $this->getError(Error::display('err_invalid_string'), $controller, $validationClass);
            }
        }
    }
}
