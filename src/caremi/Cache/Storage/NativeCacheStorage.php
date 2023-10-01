<?php declare(strict_types=1);
namespace Caremi\Cache\Storage;

use Caremi\Utility\Files;
use Caremi\Cache\Exception\CacheException;
use Caremi\Cache\Storage\CacheStorageTrait;
use Caremi\Cache\Storage\AbstractCacheStorage;

class NativeCacheStorage extends AbstractCacheStorage
{

    use CacheStorageTrait;

    /**
     * Undocumented function
     *
     * @param Object $envConfigurations
     * @param array $options
     */
    public function __construct(Object $envConfigurations, array $options = [])
    {
        parent::__construct($envConfigurations, $options);
    }

    /**
     * Saves data in a cache file.
     *
     * @param string $entryIdentifier An identifier for this specific cache entry
     * @param string $value The data to be stored
     * @param int $ttl
     * @return void
     * @throws CacheException if the directory does not exist or is not writable 
     *                        or exceeds the maximum allowed path length, or if no 
     *                        cache frontend has been set.
     * @api
     */
    public function setCache(string $entryIdentifier, string $value, int $ttl = null): void
    {
        $this->isCacheValidated($entryIdentifier);
        $cacheEntryPathAndFilename = $this->cacheEntryPathAndFilename($entryIdentifier);
        $result = $this->writeCacheFile($cacheEntryPathAndFilename, $value);
        if ($result !== false) {
            return;
        }
        throw new CacheException('The cache file "' . $cacheEntryPathAndFilename . '" could not be written.', 0);
    }

    /**
     * @inheritDoc
     */
    public function getCache(string $entryIdentifier)
    {
        $this->isCacheValidated($entryIdentifier, false);
        $cacheEntryPathAndFilename = $this->cacheEntryPathAndFilename($entryIdentifier);
        if (!file_exists($cacheEntryPathAndFilename)) {
            return false;
        }

        return $this->readCacheFile($cacheEntryPathAndFilename);
    }

    /**
     * @inheritDoc
     */
    public function hasCache(string $entryIdentifier): bool
    {
        $this->isCacheValidated($entryIdentifier, false);
        return file_exists($this->cacheEntryPathAndFilename($entryIdentifier));
    }

    /**
     * @inheritDoc
     */
    public function removeCache(string $entryIdentifier): bool
    {
        $this->isCacheValidated($entryIdentifier);
        $cacheEntryPathAndFilename = $this->cacheEntryPathAndFilename($entryIdentifier);
        for ($i = 0; $i < 3; $i++) {
            try {
                $result = $this->tryRemoveWithLock($cacheEntryPathAndFilename);
                if ($result === true) {
                    clearstatcache(true, $cacheEntryPathAndFilename);
                    return $result;
                }
            } catch (CacheException $e) {
                throw $e;
            }
            usleep(rand(10, 500));
        }

        return false;
    }

    /**
     * @inheritDoc
     */
    public function flush(): void
    {
        Files::emptyDirectoryRecursively($this->cacheDirectory);
    }

    /**
     * @inheritDoc
     */
    public function collectGarbage(): void
    {
    }
}
