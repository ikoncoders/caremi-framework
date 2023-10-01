<?php declare(strict_types=1);
namespace Caremi\Cache\Storage;

use Iterator;

interface IterableStorageInterface extends CacheStorageInterface, Iterator
{
}
