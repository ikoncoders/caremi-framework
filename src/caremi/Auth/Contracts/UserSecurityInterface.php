<?php declare(strict_types=1);
namespace Caremi\Auth\Contracts;

interface UserSecurityInterface
{ 

    public function emailExists(string $email, int $ignoreID = null);
    public function validatePassword(object $cleanData, ?object $repository = null);

}