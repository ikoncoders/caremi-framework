<?php declare(strict_types=1);
namespace Caremi\Cookie;

use Caremi\Cookie\Store\CookieStoreInterface;


class Cookie implements CookieInterface
{

    /** @var Object */
    protected CookieStoreInterface $cookieStore;

    /**
     * Protected class constructor as this class will be a singleton
     * 
     * @param array $attributes
     * @return void
     */
    public function __construct(CookieStoreInterface $cookieStore)
    {
        $this->cookieStore = $cookieStore;
    }

    /**
     * @inheritdoc
     * 
     * @return bool
     */
    public function has(): bool
    {
        return $this->cookieStore->hasCookie();
    }

    /**
     * @inheritdoc
     * 
     * @param mixed $value
     * @return self
     */
    public function set($value): void
    {
        $this->cookieStore->setCookie($value);
    }

    /**
     * @inheritdoc
     * 
     * @return void
     */
    public function delete(): void
    {
        if ($this->has()) {
            $this->cookieStore->deleteCookie();
        }
    }

    /**
     * @inheritdoc
     * 
     * @return void
     */
    public function invalidate(): void
    {
        foreach ($_COOKIE as $name => $value) {
            if ($this->has()) {
                $this->cookieStore->deleteCookie($name);
            }
        }
    }
}
