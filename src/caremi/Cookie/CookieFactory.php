<?php declare(strict_types=1);
namespace Caremi\Cookie;

use Caremi\Cookie\Cookie;
use Caremi\Cookie\CookieEnvironment;
use Caremi\Cookie\Store\CookieStoreInterface;
use Caremi\Cookie\Exception\CookieUnexpectedValueException;

class CookieFactory
{

    /** @return void */
    public function __construct()
    {
    }

    /**
     * Cookie factory which create the cookie object and instantiate the choosen
     * cookie store object which defaults to nativeCookieStore. This store object accepts
     * the cookie environment object as the only argument.
     * 
     * @param string $cookieStore
     * @param CookieEnvironment $cookieEnvironment
     * @return CookieInterface
     * @throws CookieUnexpectedValueException
     */
    public function create(?string $cookieStore = null, CookieEnvironment $cookieEnvironment): CookieInterface
    {
        $cookieStoreObject = new $cookieStore($cookieEnvironment);
        if (!$cookieStoreObject instanceof CookieStoreInterface) {
            throw new CookieUnexpectedValueException($cookieStore . 'is not a valid cookie store object.');
        }

        return new Cookie($cookieStoreObject);
    }
}
