<?php declare(strict_types=1);
namespace Caremi\DataSchema;

use Caremi\DataSchema\DataSchemaBlueprint;

interface DataSchemaBuilderInterface
{ 
    /**
     * Method which should be implemented when using this database schema component
     * We can call the database schema methods to build a table schema
     * 
     * @param BuildSchema $schema
     * @return string
     */
    public function createSchema() : string;

}