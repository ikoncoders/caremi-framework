<?php declare(strict_types=1);
namespace Caremi\Cookie\Store;

use Caremi\Cookie\Store\CookieStoreInterface;

abstract class AbstractCookieStore implements CookieStoreInterface
{

    /** @var object */
    protected Object $cookieEnvironment;

    /**
     * Main class constructor
     *
     * @param object $cookieEnvironment
     */
    public function __construct(Object $cookieEnvironment)
    {
        $this->cookieEnvironment = $cookieEnvironment;
    }
}
