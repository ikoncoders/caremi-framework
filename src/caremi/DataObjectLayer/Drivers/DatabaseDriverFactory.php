<?php declare(strict_types=1);
namespace Caremi\DataObjectLayer\Drivers;

use Caremi\DataObjectLayer\Drivers\DatabaseDriverInterface;
use Caremi\DataObjectLayer\Drivers\MysqlDatabaseConnection;
use Caremi\DataObjectLayer\Exception\DataLayerUnexpectedValueException;

class DatabaseDriverFactory
{

    /**
     * Create and return the database driver object. Passing the object environment and 
     * default database driver to the database driver constructor method.
     *
     * @param object $environment
     * @param string|null $dbDriverConnection
     * @param string $pdoDriver
     * @return DatabaseDriverInterface
     * @throws DataLayerUnexpectedValueException
     */
    public function create(object $environment, string|null $dbDriverConnection = null, string $pdoDriver): DatabaseDriverInterface
    {
        if (is_object($environment) && !is_null($environment)) {
            $dbConnection = ($dbDriverConnection !==null) ? new $dbDriverConnection($environment, $pdoDriver) : new MysqlDatabaseConnection($environment, $pdoDriver);
            if (!$dbConnection instanceof DatabaseDriverInterface) {
                throw new DataLayerUnexpectedValueException();   
            }

            return $dbConnection;
        }
    }


}