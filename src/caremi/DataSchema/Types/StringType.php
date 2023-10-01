<?php declare(strict_types=1);
namespace Caremi\DataSchema\Types;

use Caremi\DataSchema\DataSchemaBaseType;
use Caremi\DataSchema\DataSchemaTypeInterface;

class StringType extends DataSchemaBaseType implements DataSchemaTypeInterface
{

    /** @var array - string schema types */
    protected array $types = [
        'year', 
        'char',
        'varchar',
        'text',
        'tinytext',
        'mediumtext',
        'longtext',
        'binary',
        'varbinary',
        'tinyblob',
        'mediumblob',
        'longblob',
        'blob',
        'enum',
        'set'
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