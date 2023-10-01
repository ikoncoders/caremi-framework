<?php

declare(strict_types=1);

namespace Caremi\ValidationRule;

class ValidationRuleMethods
{
    /**
     * Main constructor class
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Dispatch the validation error
     *
     * @param array $msg
     * @param object $controller
     * @param object $validationClass
     * @return void
     */
    public function getError(array $msg, object $controller, object $validationClass): void
    {
        if ($controller->error) {
            $controller
                ->error
                ->addError($msg, $controller)
                ->dispatchError(
                    ($validationClass->validationRedirect() !== '') ? $validationClass->validationRedirect() :
                        $controller->onSelf()
                );
        }
    }
}
