<?php declare(strict_types=1);
namespace Caremi\DataObjectLayer\Drivers;

use PDO;
use PDOException;
use Caremi\DataObjectLayer\Exception\DataLayerException;
use Caremi\DataObjectLayer\Drivers\AbstractDatabaseDriver;
use Caremi\DataObjectLayer\Exception\DataLayerInvalidArgumentException;

class MysqlDatabaseConnection extends AbstractDatabaseDriver
{

    /** @var string $pdoDriver */
    protected string $pdoDriver;

    /** @var string $driver */
    protected const PDO_DRIVER = 'mysql';

    /**
     * Class constructor. piping the class properties to the constructor
     * method. The constructor will throw an exception if the database driver
     * doesn't match the class database driver.
     *
     * @param object $environment
     * @param string $pdoDriver
     * @return void
     */
    public function __construct(object $environment, string $pdoDriver)
    {
        $this->environment = $environment;
        $this->pdoDriver = $pdoDriver;
        if (self::PDO_DRIVER !== $this->pdoDriver) {
            throw new DataLayerInvalidArgumentException($pdoDriver . ' Invalid database driver pass requires ' . self::PDO_DRIVER . ' driver option to make your connection.');
        }
    }

    /**
     * Opens a new Mysql database connection
     *
     * @return PDO_MYSQL
     * @throws DataLayerException
     */
    public function open()
    {
        try {
            return new PDO(
                $this->environment->getDsn(),
                $this->environment->getDbUsername(),
                $this->environment->getDbPassword(),
                $this->params
            );
        } catch (PDOException $expection) {
            throw new DataLayerException($expection->getMessage(), (int)$expection->getCode());
        }
    }
}
