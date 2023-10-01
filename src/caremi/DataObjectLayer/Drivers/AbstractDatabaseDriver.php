<?php declare(strict_types=1);
namespace Caremi\DataObjectLayer\Drivers;

use PDO;
use Caremi\DataObjectLayer\Drivers\DatabaseDriverInterface;

abstract class AbstractDatabaseDriver implements DatabaseDriverInterface
{

    /** @var array $params - PDO Parameters */
    protected array $params = [
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];

    public function PdoParams()
    {
        return $this->params;
    }

    /**
     * Close the database connection
     *
     * @return void
     */
    public function close()
    {
        $this->dbh = null;
    }
}
