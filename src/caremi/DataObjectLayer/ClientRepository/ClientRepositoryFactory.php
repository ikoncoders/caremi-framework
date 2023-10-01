<?php declare(strict_types=1);
namespace Caremi\DataObjectLayer\ClientRepository;

use Caremi\DataObjectLayer\DataRepository\DataRepositoryFactory;
use Caremi\DataObjectLayer\ClientRepository\ClientRepositoryInterface;
use Caremi\DataObjectLayer\Exception\DataLayerUnexpectedValueException;

class ClientRepositoryFactory
{

    /** @var string */
    protected string $tableSchema;

    /** @var string */
    protected string $tableSchemaID;

    /** @var string */
    protected string $crudIdentifier;

    /**
     * Main class constructor
     *
     * @param string $crudIdentifier
     * @param string $tableSchema
     * @param string $tableSchemaID
     */
    public function __construct(string $crudIdentifier, string $tableSchema, string $tableSchemaID)
    {
        $this->crudIdentifier = $crudIdentifier;
        $this->tableSchema = $tableSchema;
        $this->tableSchemaID = $tableSchemaID;
        
    }

    /**
     * The client repository is a internal data layer which expose methods for internal
     * and external library data consumption. It also provides method for puting and droping
     * data from the client specified data entities.
     *
     * @param string $ClientRepositoryString
     * @param array|null $dataLayerConfiguration
     * @return ClientRepositoryInterface
     * @throws DataLayerUnexpectedValueException
     */
    public function create(string $ClientRepositoryString, ?array $dataLayerConfiguration = null) : ClientRepositoryInterface
    {
        
        $clientRepositoryObject = new $ClientRepositoryString($this->buildEntityManager($dataLayerConfiguration));
        if (!$clientRepositoryObject instanceof ClientRepositoryInterface) {
            throw new DataLayerUnexpectedValueException($ClientRepositoryString . ' is not a valid repository object');
        }
        return $clientRepositoryObject;
    }

    /**
     * As this class is a carbon copy of the DataRepositoryFactory. We are simple borrowing
     * this method and passing in the relevant arguments in for this class. This client class
     * was design to be used interanll. Whilst the DataRepositoryFactory Object is acting as
     * the middle man for the frontend application
     * 
     * @param array|null $dataLayerConfiguration
     * @return Object
     */
    public function buildEntityManager(?array $dataLayerConfiguration = null) : Object
    {
        return (new DataRepositoryFactory(
            $this->crudIdentifier, 
            $this->tableSchema, 
            $this->tableSchemaID))->buildEntityManager($dataLayerConfiguration);

    }


}
