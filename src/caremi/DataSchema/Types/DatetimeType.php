<?php declare(strict_types=1);
namespace Caremi\DataSchema\Types;

use Caremi\DataSchema\DataSchemaBaseType;
use Caremi\DataSchema\DataSchemaTypeInterface;

class DatetimeType extends DataSchemaBaseType implements DataSchemaTypeInterface
{

    /** @var array - datetime schema types */
    protected array $types = [
        'date',
        'datetime',
        'timestamp',
        'time', 
        'json'
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