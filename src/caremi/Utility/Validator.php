<?php declare(strict_types=1);

namespace Caremi\Utility;

class Validator
{

    /**
     * Undocumented function
     *
     * @param string $email
     */
    public static function email(string $email)
    {
        if (!empty($email)) {
            return filter_var($email, FILTER_VALIDATE_EMAIL);
        }
    }


}