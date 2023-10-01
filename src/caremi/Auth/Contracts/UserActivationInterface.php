<?php declare(strict_types=1);
namespace Caremi\Auth\Contracts;

interface UserActivationInterface
{ 

    public function findByActivationToken(string $token) : ?Object;
    public function sendUserActivationEmail(string $hash) : self;
    public function validateActivation(Object $respoitory) : self;
    public function activate() : bool;

}