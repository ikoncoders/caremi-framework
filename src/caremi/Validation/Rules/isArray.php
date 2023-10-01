<?php declare(strict_types=1);

namespace Caremi\ValidationRule\Rules;

use Caremi\Error\Error;
use Caremi\ValidationRule\ValidationRuleMethods;

class isArray extends ValidationRuleMethods
{

    public function isArray(object $controller, object $validationClass)
    {
        if (isset($validationClass->key)) {
            if (!is_array($validationClass->value)) {
                $this->getError(Error::display('err_invalid_array'), $controller, $validationClass);
            }
        }
    }
}
