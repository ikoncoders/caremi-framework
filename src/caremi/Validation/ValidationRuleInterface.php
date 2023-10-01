<?php
declare(strict_types=1);

namespace Caremi\ValidationRule;

interface ValidationRuleInterface
{

    /**
     * Undocumented function
     *
     * @param mixed $rule
     * @return void
     */
    public function addRule(mixed $rule): void;

    /**
     * Add additional object from the validation class which our validation rule methods
     * can use.
     *
     * @param string $controller
     * @param object $validationClass
     * @return void
     */
    public function addObject(string $controller, object $validationClass): void;



}