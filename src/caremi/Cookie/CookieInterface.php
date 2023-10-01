<?php declare(strict_types=1);
namespace Caremi\Cookie;

interface CookieInterface
{

    /**
     * Set a cookie within the domain
     * 
     * @param mixed $value
     * @return self
     */
    public function set($value) : void;

    /**
     * Checks to see whether the cookie was set or not return true or false
     * 
     * @return bool
     */
    public function has() : bool;

    /**
     * delete a single cookie from the domain
     * 
     * @return void
     */
    public function delete() : void;

    /**
     * Invalid all cookie i.e delete all set cookie within this domain
     * 
     * @return void
     */
    public function invalidate() : void;

}