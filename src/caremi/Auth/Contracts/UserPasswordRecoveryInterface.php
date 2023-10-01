<?php declare(strict_types=1);
namespace Caremi\Auth\Contracts;

interface UserPasswordRecoveryInterface
{ 

    public function findByUser(string $email) : self;
    public function sendUserResetPassword() : self;
    public function resetPassword(int $userID) : ?array;
    public function findByPasswordResetToken(string $tokenHash = null) : ?Object;
    public function reset() : bool;

}