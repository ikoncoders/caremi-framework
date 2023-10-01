<?php declare(strict_types=1);
namespace Caremi\DataObjectLayer\DatabaseConnection;

interface DatabaseTransactionInterface
{

    /**
     * Begin a transaction, turning off autocommit
     *
     * @return bool true on success or false on failure
     * @throws PDOException - if a transaction as already started or the driver does not support transaction
     */
    public function start() : bool;

    /**
     * Commits a transaction
     *
     * @return bool true on success or false on failure
     * @throws PDOException - If theres no active transaction
     */
    public function commit () : bool;

    /**
     * Rolls back a transaction
     *
     * @return bool true on success or false on failure
     * @throws PDOException - If theres no active transaction
     */
    public function revert() : bool;

}