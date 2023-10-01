<?php declare(strict_types=1);
namespace Caremi\DataObjectLayer\DatabaseConnection;

use PDOException;
use LogicException;
use Caremi\DataObjectLayer\Exception\DataLayerException;
use Caremi\DataObjectLayer\Drivers\DatabaseDriverInterface;
use Caremi\DataObjectLayer\DatabaseConnection\DatabaseTransactionInterface;

class DatabaseTransaction implements DatabaseTransactionInterface
{

    private DatabaseDriverInterface $db;
    private int $transactionCounter = 0;

    /**
     * Main class constructor method which accepts the database connection object
     * which is then pipe to the class property (db)
     *
     * @param DatabaseDriverInterface $db
     * @return void
     * @throws LogicException - if there's no database connection object
     */
    public function __construct(DatabaseDriverInterface $db)
    {
        $this->db = $db;
        if (!$this->db) {
            throw new LogicException('No Database connection was detected.');
        }
    }

    /**
     * @inheritdoc
     * @return bool true on success or false on failure
     * @throws PDOException - if a transaction as already started or the driver does not support transaction
     */
    public function start(): bool
    {
        try {
            if ($this->db) {
                if (!$this->transactionCounter++) {
                    return $this->db->open()->beginTransaction();
                }
                return $this->db->open()->beginTransaction();
            }
        } catch (DataLayerException $e) {
            throw new DataLayerException($e->getMessage());
        }
    }

    /**
     * @inheritdoc
     * @return bool true on success or false on failure
     * @throws PDOException - If theres no active transaction
     */
    public function commit(): bool
    {
        try {
            if ($this->db) {
                if (!$this->transactionCounter) {
                    return $this->db->open()->commit();
                }
                return $this->transactionCounter >= 0;
            }
        } catch (DataLayerException $e) {
            throw new DataLayerException($e->getMessage());
        }
    }

    /**
     * @inheritdoc
     * @return bool true on success or false on failure
     * @throws PDOException - If theres no active transaction
     */
    public function revert(): bool
    {
        try {
            if ($this->db) {
                if ($this->transactionCounter >= 0) {
                    $this->transactionCounter = 0;
                    return $this->db->open()->rollBack();
                }
                $this->transactionCounter = 0;
                return false;
            }
        } catch (DataLayerException $e) {
            throw new DataLayerException($e->getMessage());
        }
    }
}
