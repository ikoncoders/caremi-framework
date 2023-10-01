<?php
declare(strict_types=1);

namespace Caremi\ValidationRule\Rules;

use Caremi\Error\Error;
use Caremi\ValidationRule\ValidationRuleMethods;

class isNumeric extends ValidationRuleMethods
{

    public function isNumeric(object $controller, object $validationClass)
    {
        if (isset($validationClass->key)) {
            if (!is_numeric($validationClass->value)) {
                $this->getError(Error::display('err_invalid_numeric'), $controller, $validationClass);
            }
        }
    }
}
