<?php declare(strict_types=1);
namespace Caremi\DataSchema\Types;

use Caremi\DataSchema\DataSchemaBaseType;
use Caremi\DataSchema\DataSchemaTypeInterface;

class NumericType extends DataSchemaBaseType implements DataSchemaTypeInterface
{

    /** @var array - intgre schema types */
    protected array $types = [
        'tinyint',
        'smallint',
        'mediumint',
        'bigint',
        'decimal',
        'float',
        'real',
        'double',
        'bit',
        'boolean',
        'serial',
        'int'
    ];

    /**
     * Undocumented function
     *
     * @param array $row
     */
    public function __construct(array $row = [])
    {
        parent::__construct($row, $this->types);
    }

    /**
     * Undocumented function
     *
     * @return string
     */
    public function render(): string
    {
        return parent::render();
    }


}