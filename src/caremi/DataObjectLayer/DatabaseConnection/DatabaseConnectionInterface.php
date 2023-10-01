<?php declare(strict_types=1);
namespace Caremi\DataObjectLayer\DatabaseConnection;

interface DatabaseConnectionInterface
{

    /**
     * create anew database connection
     * @return PDO
     */
    public function open();

    /** 
     * close database connection
    */
    public function close();

}