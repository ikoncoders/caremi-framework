<?php declare(strict_types=1);

namespace Caremi\Session\Flash;

use Caremi\Session\Exception\SessionUnexpectedValueException;
use Caremi\Session\SessionInterface;
use Caremi\Session\Flash\FlashInterface;
use Caremi\Session\Flash\Flash;
use Caremi\Session\SessionEnvironment;

class FlashFactory
{

    /** @return void */
    public function __construct()
    { }

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
    public function create(?SessionInterface $session = null, ?string $flashKey = null) : FlashInterface
    {
        if (!$session instanceof SessionInterface) {
            throw new SessionUnexpectedValueException('Object does not implement session interface.');
        }
        return new Flash($session, $flashKey);
    }

}