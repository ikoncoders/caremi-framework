<?php declare(strict_types=1);
namespace Caremi\DataObjectLayer;

use Caremi\DataObjectLayer\ClientRepository\ClientRepository;
use Caremi\DataObjectLayer\ClientRepository\ClientRepositoryFactory;

class DataLayerClientFacade
{

    protected string $clientIdentifier;
    protected string $tableSchema;
    protected string $tableSchemaID;

    /**
     * Final class which ties the entire data layer togther. The data layer factory
     * is responsible for creating an object of all the component factories and injecting
     * the relevant parameters/arguments. ie the query builder factory, entity manager
     * factory and the data mapper factory.
     * 
     * @param string $clientIdentifier
     * @param string $tableSchema
     * @param string $tableSchemaID
     * @return ClientRepository
     */
    public function __construct(string $clientIdentifier, string $tableSchema, string $tableSchemaID)
    {
        $this->clientIdentifier = $clientIdentifier;
        $this->tableSchema = $tableSchema;
        $this->tableSchemaID = $tableSchemaID;
    }

    /**
     * Returns the client repository object which allows external and internal 
     * component to use the methods within.
     *
     * @return Object
     */
    public function getClientRepository(): Object
    {
        $factory = new ClientRepositoryFactory($this->clientIdentifier, $this->tableSchema, $this->tableSchemaID);
        if ($factory) {
            $client = $factory->create(\MagmaCore\DataObjectLayer\ClientRepository\ClientRepository::class);
            if ($client) {
                return $client;
            }
        }
    }
}
