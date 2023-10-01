<?php declare(strict_types=1);
namespace Caremi\DataSchema;

interface DataSchemaTypeInterface
{

    /**
     * Return an array of the available schema type for the given schema object
     *
     * @return array
     */
    public function getSchemaTypes(): array;

    /**
     * Return an array of the available schema columns for the given schema object
     *
     * @return array
     */
    public function getSchemaColumns(): array;

    /**
     * Return an array of the available schema rows for the given schema object
     *
     * @return array
     */
    public function getRow(): array;

    /**
     * Render the schema rows as a large concat string
     *
     * @return string
     */
    public function render(): string;

}