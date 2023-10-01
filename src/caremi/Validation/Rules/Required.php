<?php
declare(strict_types=1);

namespace Caremi\ValidationRule\Rules;

use Caremi\Error\Error;
use Caremi\ValidationRule\ValidationRuleMethods;

class Required extends ValidationRuleMethods
{

    public function required(object $controller, object $validationClass)
    {
        if (isset($validationClass->key)) {
            //if (strlen($validatedClass->value) === 0) {}
            if (empty($validationClass->key) || $validationClass->value === '') {
                $this->getError(Error::display('err_field_require'), $controller, $validationClass);
            }
        }
    }
}
