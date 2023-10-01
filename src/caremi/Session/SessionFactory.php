<?php declare(strict_types=1);
namespace Caremi\Session;

use Caremi\Session\SessionInterface;
use Caremi\Session\SessionEnvironment;
use Caremi\Session\Storage\SessionStorageInterface;
use Caremi\Base\Exception\BaseUnexpectedValueException;
use Caremi\Session\Exception\SessionUnexpectedValueException;

class SessionFactory
{

    /** @return void */
    public function __construct()
    {
    }

    /**
     * Session factory which create the session object and instantiate the choosen
     * session storage which defaults to nativeSessionStorage. This storage object accepts
     * the session environment object as the only argument.
     * 
     * @param string $sessionIdentifier
     * @param string $storage
     * @param SessionEnvironment $SessionEnvironment
     * @return SessionInterface
     * @throws BaseUnexpectedValueException
     */
    public function create(
        string $sessionIdentifier,
        string $storage,
        SessionEnvironment $sessionEnvironment
    ): SessionInterface {
        $storageObject = new $storage($sessionEnvironment);
        if (!$storageObject instanceof SessionStorageInterface) {
            throw new SessionUnexpectedValueException(
                $storage . ' is not a valid session storage object.'
            );
        }

        return new Session($sessionIdentifier, $storageObject);
    }
}
