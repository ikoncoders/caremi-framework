<?php
declare(strict_types=1);

namespace Caremi\ValidationRule\Rules;

use Caremi\Error\Error;
use Caremi\ValidationRule\ValidationRuleMethods;

class Unique extends ValidationRuleMethods
{

    public function unique(object $controller, object $validationClass)
    {
        if (isset($validationClass->key)) {
            $result = $controller->repository
                ->getRepo()
                ->findObjectBy([$validationClass->key => $validationClass->value], ['*']);
            if ($result) {
                $ignoreID = (!empty($controller->thisRouteID()) ? $controller->thisRouteID() : null);
                if ($result->id == $ignoreID) {
                    $this->getError(Error::display('err_data_exists'), $controller, $validationClass);
                }
            }
        }
    }
}
