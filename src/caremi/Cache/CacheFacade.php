<?php declare(strict_types=1);
namespace Caremi\Cache;

use Caremi\Cache\CacheFactory;

class CacheFacade
{

    /** @return void */
    public function __construct()
    {
    }

    /**
     * Undocumented function
     *
     * @param string|null $cacheIdentifier
     * @param string|null $storage
     * @param array $options
     * @return void
     */
    public function create(
        ?string $cacheIdentifier = null,
        ?string $storage = null,
        array $options = []
    ) {
        return (new CacheFactory())->create($cacheIdentifier, $storage, $options);
    }
}
