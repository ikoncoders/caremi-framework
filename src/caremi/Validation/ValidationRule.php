<?php
declare(strict_types=1);

namespace Caremi\ValidationRule;

use Caremi\Utility\Stringify;
use Caremi\Base\BaseController;
use Caremi\ValidationRule\ValidationRuleMethods;
use Caremi\ValidationRule\ValidationRuleInterface;
use Caremi\ValidationRule\ValidationBadMethodCallException;
use Caremi\ValidationRule\ValidationInvalidArgumentException;

class ValidationRule implements ValidationRuleInterface
{

    private object $controller;
    private object $validationClass;
    private ValidationRuleMethods $validationRules;
    private const ALLOWABLE_RULES = [
        'strings',
        'integer',
        'array',
        'object',
        'required',
        'unique',
        'equal'
    ];

    /**
     * Undocumented function
     *
     * @param ValidationRuleMethods $validationRuleFuncs
     * @return void
     */
    public function __construct(ValidationRuleMethods $validationRuleFuncs) {
        $this->validationRuleFuncs = $validationRuleFuncs;
    }

    /**
     * Undocumented function
     *
     * @param mixed $rule
     * @return void
     */
    public function addRule(mixed $rule): void
    {
        if ($rule)
            $this->rule = $this->resolvedRule($rule);
    }

    /**
     * Add additional object from the validation class which our validation rule methods
     * can use.
     *
     * @param string $controller
     * @param object $validationClass
     * @return void
     */
    public function addObject(string $controller, object $validationClass): void
    {
        if ($controller)
            $this->controller = new $controller([]);
        if ($validationClass)
            $this->validationClass = $validationClass;
    }

    /**
     * Return the calling controller object
     *
     * @return void
     */
    public function getController(): BaseController
    {
        return $this->controller;
    }

    /**
     * Resolve the array of possible rules pass from the validation class
     *
     * @param mixed $rule
     * @return mixed
     */
    private function resolvedRule(mixed $rule): mixed
    {
        if (is_string($rule)) {
            $rule = (string)$rule;
            /**
             * Explode the string and look for the pipe character that way we can separate 
             * our rules into callables
             */
            $rulePieces = $this->exploder($rule, '|');
            foreach ($rulePieces as $rulePiece) {
                $extractRuleWithArgs = $this->exploder($rulePiece);
                if (isset($extractRuleWithArgs) && count($extractRuleWithArgs) > 1) {
                    $this->throwInvalidRuleException($extractRuleWithArgs[0]);
                } else {
                    $this->throwInvalidRuleException($rulePiece);
                }
                return array_walk($rulePieces, function ($callback) {
                    if ($callback) {
                        list($method, $argument) = $this->resolveCallback($callback);
                        $classRule = '\Caremi\ValidationRule\Rules\\' . Stringify::studlyCaps($method);
                        if (!method_exists(
                            $classRule, 
                            $newMethod = Stringify::camelCase($method))) {
                            throw new ValidationBadMethodCallException(
                                $method . '() does not exists within ' . __CLASS__
                            );
                        }
                        call_user_func_array(
                            array(new $classRule, $newMethod),
                            [
                                $this->controller, 
                                $this->validationClass, 
                                $argument
                            ]
                        );
                    }
                });
            }
        }
    }

    /**
     * exploder helper which splits a string via the specified delimiter
     *
     * @param string $values
     * @param string $delimiter
     * @return array
     */
    public function exploder(string $values, string $delimiter = ':'): array
    {
        return explode($delimiter, $values);
    }

    /**
     * Resolve the callback. ie checks whether the rule has an argument. arguments
     * are defined after a colon. which we will explode by the callback argument. If 
     * a colon is defined then we can extract both method name and argument. else if a colon
     * wasn't define we will execute as normal. Return an array of the callback method name
     * any optional argument supplied with the rule.
     *
     * @param mixed $callback
     * @return mixed
     */
    private function resolveCallback(mixed $callback): mixed
    {
        if ($callback) {
            $stringify = new Stringify(); /* Call to the stringify utility class */
            $extract = $this->exploder($callback);
            if (isset($extract) && count($extract) > 1) { /* meaning if we have 2 elements */
                $validCallback = $stringify->camelCase($extract[0]);
                $args = (isset($extract[1]) ? $extract[1] : null);
            } else {
                $validCallback = $stringify->camelCase($callback);
                $args = null;
            }
            return [
                $validCallback,
                $args
            ];
        }
        return false;
    }

    /**
     * throw an exception if the passing invalid or unsupported rule
     *
     * @param mixed $rule
     * @return void
     */
    private function throwInvalidRuleException(mixed $rule): void
    {
        if (!in_array($rule, self::ALLOWABLE_RULES, true)) {
            throw new ValidationInvalidArgumentException($rule . ' is not a supported validation rule ' . $rule);
        }
    }
}
