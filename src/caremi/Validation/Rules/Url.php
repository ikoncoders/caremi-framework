<?php
declare(strict_types=1);

namespace Caremi\ValidationRule\Rules;

use Caremi\Error\Error;
use Caremi\ValidationRule\ValidationRuleMethods;

class Url extends ValidationRuleMethods
{

    public function url(object $controller, object $validationClass)
    {
        if (isset($validationClass->key)) {
            if (filter_var($validationClass->value, FILTER_VALIDATE_URL) === false) {
                $this->getError(Error::display('err_invalid_url'), $controller, $validationClass);
            }
        }
    }
}
