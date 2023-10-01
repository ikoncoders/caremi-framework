<?php declare(strict_types=1);

namespace Caremi\Session\Storage;

class PdoSessionStorage extends AbstractSessionStorage
{

    /**
     * Main class constructor
     *
     * @param Object $sessionEnvironment
     */
    public function __construct(Object $sessionEnvironment)
    {
        parent::__construct($sessionEnvironment);
    }

}