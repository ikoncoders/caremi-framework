<?php declare(strict_types=1);
namespace Caremi\DataObjectLayer\QueryBuilder;

use Caremi\DataObjectLayer\QueryBuilder\QueryBuilderInterface;
use Caremi\DataObjectLayer\Exception\DataLayerUnexpectedValueException;

class QueryBuilderFactory
{

    /**
     * Main constructor method
     * 
     * @return void
     */
    public function __construct()
    { }

    public function __create(string $queryBuilderString) : QueryBuilderInterface
    {
        $queryBuilderObject = new $queryBuilderString();
        if (!$queryBuilderString instanceof QueryBuilderInterface) {
            throw new DataLayerUnexpectedValueException($queryBuilderString . ' is not a valid Query builder object.');
        }
        return $queryBuilderObject;
    }

    /**
     * Create the QueryBuilder object
     *
     * @param string $queryBuilderString
     * @return QueryBuilderInterface
     */
    public function create(string $queryBuilderString) : QueryBuilderInterface
    {
        $queryBuilderObject = new $queryBuilderString();
        if (!$queryBuilderObject instanceof QueryBuilderInterface) {
            throw new DataLayerUnexpectedValueException($queryBuilderString . ' is not a valid Query builder object.');
        }
        return $queryBuilderObject;
    }


}
