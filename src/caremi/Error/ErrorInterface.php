<?php declare(strict_types=1);
namespace Caremi\Error;

interface ErrorInterface
{

    public function addError($error, Object $object, array $errorParams = []): Error;
    public function getErrors(): array;
    public function getErrorParams(): array;
    public function dispatchError(string $redirectPath);
    public function or(string $redirect, ?string $message = null): bool;
    public function hasError(): bool;
    public function getErrorCode(): string;
}
