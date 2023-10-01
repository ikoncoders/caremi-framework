<?php declare(strict_types=1);
namespace Caremi\DataObjectLayer\FileStorageRepository;

use Flatbase\Flatbase;
use Flatbase\Storage\Filesystem;

class FileStorage
{

    /**
     * @return Flatbase
     */
    public function flatDatabase()
    {
        $storage = new Filesystem(STORAGE_PATH . '/files');
        $flatbase = new Flatbase($storage);
        if ($flatbase) {
            return $flatbase;
        }
    }


}