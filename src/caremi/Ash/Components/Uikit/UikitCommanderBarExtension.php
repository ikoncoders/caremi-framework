<?php declare(strict_types=1);
namespace Caremi\Ash\Components\Uikit;

use Exception;
use Caremi\Commander\CommanderFactory;

// use MagmaCore\Utility\Yaml;
// use App\Commander\UserCommander;
// use MagmaCore\CommanderBar\CommanderBar;

class UikitCommanderBarExtension
{

    /** @var string */
    public const NAME = 'uikit_commander_bar';

    /**
     * Get the session flash messages on the fly.
     *
     * @param object $controller - the current controller object
     * @return string
     * @throws GlobalManager
     * @throws Exception
     * @throws GlobalManagerException
     */
    public function register(object $controller = null, ?string $header = null, ?string $headerIcon = null): mixed
    {
        if (!isset($controller->commander)) {
            return false;
        } else {
            return (new CommanderFactory())->create($controller);
        }
    }
}
