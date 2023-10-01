<?php declare(strict_types=1);
namespace Caremi\Commander;

use Caremi\Commander\Commander;
use Caremi\Base\BaseApplication;
use Caremi\Commander\CommanderInterface;
 

class CommanderFactory
{
    
    /**
     * Create the commande bar object and pass the required object arguments
     *
     * @param object $controller
     * @return CommanderInterface
     */
    public function create(?object $controller = null)
    {
        return new Commander($controller);
    }

}