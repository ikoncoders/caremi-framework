<?php declare(strict_types=1);
namespace Caremi\DataObjectLayer;

use Caremi\DataObjectLayer\EntityManager\Crud;
use Caremi\DataObjectLayer\DataLayerEnvironment;
use Caremi\DataObjectLayer\QueryBuilder\QueryBuilder;
use Caremi\DataObjectLayer\DataMapper\DataMapperFactory;
use Caremi\DataObjectLayer\Drivers\DatabaseDriverFactory;
use Caremi\DataObjectLayer\QueryBuilder\QueryBuilderFactory;
use Caremi\DataObjectLayer\EntityManager\EntityManagerFactory;

class DataLayerFactory
{
    /** @var string */
    protected string $tableSchema;

    /** @var string */
    protected string $tableSchemaID;

    /** @var DataLayerEnvironment */
    protected DataLayerEnvironment $environment;

    /**
     * Main class constructor
     *
     * @param DataLayerEnvironment $environment
     * @param string $tableSchema
     * @param string $tableSchemaID
     * @param array|null $options
     */
    public function __construct(DataLayerEnvironment $environment, string $tableSchema, string $tableSchemaID)
    {
        $this->environment = $environment;
        $this->tableSchema = $tableSchema;
        $this->tableSchemaID = $tableSchemaID;
    }

    /**
     * build method which glues all the components together and inject the necessary 
     * dependency within the respective object
     *
     * @return Object
     */
    public function dataEntityManagerObject() : Object
    {
        /* build the data mapper factory object */
        $dataMapperFactory = new DataMapperFactory();
        $dataMapper = $dataMapperFactory->create(\MagmaCore\DataObjectLayer\Drivers\DatabaseDriverFactory::class, $this->environment);
        if ($dataMapper) {
            /* build the query builder factory object */
            $queryBuilderFactory = new QueryBuilderFactory();
            $queryBuilder = $queryBuilderFactory->create(QueryBuilder::class);
            if ($queryBuilder) {
                /* build the entity manager factory object */
                $entityManagerFactory = new EntityManagerFactory($dataMapper, $queryBuilder);
                return $entityManagerFactory->create(Crud::class, $this->tableSchema, $this->tableSchemaID);
            }
        }
    }

}
