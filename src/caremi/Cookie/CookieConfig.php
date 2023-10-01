<?php declare(strict_types=1);
namespace Caremi\Cookie;

class CookieConfig
{

    /** @return void */
    public function __construct()
    {
    }

    /**
     * Main cookie configuration default array settings
     * 
     * @return array
     */
    public function baseConfig()
    {
        return [

            'name' => '__caremi_cookie__',
            'expires' => 3600,
            'path' => '/',
            'domain' => 'localhost',
            'secure' => false,
            'httponly' => true
        ];
    }
}
