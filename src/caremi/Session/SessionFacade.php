<?php declare(strict_types=1);
namespace Caremi\Session;

use Caremi\Session\SessionFactory;
use Caremi\Session\SessionEnvironment;
use Caremi\Session\GlobalManager\GlobalManager;

final class SessionFacade
{

    /** @var string - a string which identifies the current session */
    protected string $sessionIdentifier;

    /** @var string - the namespace reference to the session storage type */
    protected string $storage;

    /** @var Object - the session environment object */
    protected Object $sessionEnvironment;

    /**
     * Main session facade class which pipes the properties to the method arguments. 
     * 
     * @param array $sessionEnvironment - expecting a session.yaml configuration file
     * @param string $sessionIdentifier
     * @param null|string $storage - optional defaults to nativeSessionStorage
     * @return void
     */
    public function __construct(
        array $sessionEnvironment = null,
        string|null $sessionIdentifier = null,
        string|null $storage = null
    ) {
        /** Defaults are set from the BaseApplication class */
        $this->sessionEnvironment = new SessionEnvironment($sessionEnvironment);
        $this->sessionIdentifier = $sessionIdentifier;
        $this->storage = $storage;
    }

    /**
     * Initialize the session component and return the session object. Also stored the
     * session object within the global manager. So session can be fetch throughout
     * the application by using the GlobalManager::get('session_global') to get
     * the session object
     * 
     * @return object
     * @throws SessionUnexpectedValueException
     */
    public function setSession(): Object
    {
        $this->session = (new SessionFactory())->create($this->sessionIdentifier, $this->storage, $this->sessionEnvironment);
        GlobalManager::set('session_global', $this->session);
        return $this->session;
    }
}
