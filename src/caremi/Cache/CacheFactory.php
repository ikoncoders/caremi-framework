<?php declare(strict_types=1);
namespace Caremi\Cache;

use Caremi\Cache\Cache;
use Caremi\Cache\CacheInterface;
use Caremi\Cache\Storage\NativeCacheStorage;
use Caremi\Cache\Storage\CacheStorageInterface;
use Caremi\Cache\Exception\CacheInvalidArgumentException;

class CacheFactory
{

    /** @var object */
    protected Object $envConfigurations;

    /**
     * Main factory constructor method
     *
     * @param object $envConfigurations
     */
    public function __construct()
    {
    }

    /**
     * Factory create method which create the cache object and instantiate the storage option
     * We also set a default storage options which is the NativeCacheStorage. So if the second
     * argument within the create method is left to null. Then the default cache storage object
     * will be created and all necessary argument injected within the constructor.
     *
     * @param string|null $cacheIdentifier
     * @param string|null $storage
     * @param array $options
     * @return CacheInterface
     */
    public function create(
        ?string $cacheIdentifier = null,
        ?string $storage = null,
        array $options = []
    ): CacheInterface {
        $this->envConfigurations = new CacheEnvironmentConfigurations($cacheIdentifier, __DIR__);
        $storageObject = new $storage($this->envConfigurations, $options);
        if (!$storageObject instanceof CacheStorageInterface) {
            throw new CacheInvalidArgumentException(
                '"' . $storage . '" is not a valid cache storage object.',
                0
            );
        }
        $defaultStorage = ($storageObject != null) ? $storageObject : new NativeCacheStorage($this->envConfigurations, $options);

        return new Cache($cacheIdentifier, $defaultStorage, $options);
    }
}
