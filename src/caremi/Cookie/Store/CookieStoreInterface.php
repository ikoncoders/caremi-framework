<?php declare(strict_types=1);
namespace Caremi\Cookie\Store;

interface CookieStoreInterface
{

    /**
     * @inheritdoc
     * 
     * @return bool
     */
    public function hasCookie(): bool;

    /**
     * @inheritdoc
     * 
     * @param mixed $value
     * @return void
     */
    public function setCookie(mixed $value): void;

    /**
     * @inheritdoc
     * 
     * @param null|string $cookieName
     * @return void
     */
    public function deleteCookie(string|null $cookieName = null): void;
}
