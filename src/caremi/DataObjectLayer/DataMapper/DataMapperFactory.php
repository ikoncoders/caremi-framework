<?php declare(strict_types=1);
namespace Caremi\DataObjectLayer\DataMapper;

use Caremi\Utility\Yaml;
use Caremi\DataObjectLayer\DataLayerEnvironment;
use Caremi\DataObjectLayer\Exception\DataLayerUnexpectedValueException;

class DataMapperFactory
{

    /**
     * Main constructor class
     * 
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Creates the data mapper object and inject the dependency for this object. We are also
     * creating the DatabaseConnection Object and injecting the environment object. Which will
     * expose the environment methods with the database connection class.
     *
     * @param string $databaseDriverFactory
     * @param Object $dataMapperEnvironmentConfiguration
     * @return DataMapperInterface
     * @throws DataLayerUnexpectedValueException
     */
    public function create(string $databaseDriverFactory, DataLayerEnvironment $environment): DataMapperInterface
    {
        $params = $this->resolvedDatabaseParameters();
        $dbObject = (new $databaseDriverFactory())->create($environment, $params['class'], $params['driver']);
        return new DataMapper($dbObject);
    }

    /**
     * Return the application parameters as they were defined within the config
     * yaml file
     *
     * @return array
     */
    private function resolvedDatabaseParameters(): array
    {
        $database = Yaml::file('app')['database'];
        if (is_array($database) && count($database) > 0) {
            foreach ($database['drivers'] as $driver => $class) {
                if (isset($driver) && $driver === $database['default_driver']) {
                    return array_merge($class, ['driver' => $driver]);
                }
            }
        }
    }
}
