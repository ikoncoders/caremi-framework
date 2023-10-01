<?php declare(strict_types=1);

namespace Caremi\Utility;

class PasswordEncoder
{

    /**
     *
     * @param string $password
     * @return string
     */
    public static function encode(string $password = null) : ?string
    {
        static $encodedPassword = null;
        if ($encodedPassword === null) {
            if (!empty($password)) {
                $encodedPassword = password_hash($password, PASSWORD_DEFAULT);
            } else {
                $encodedPassword = '';
            }    
        }

        return $encodedPassword;

    }

}
