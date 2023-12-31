<?php declare(strict_types=1);
namespace Caremi\Datatable;

use Caremi\Datatable\DatatableInterface;
use Caremi\Datatable\Exception\DatatableUnexpectedValueException;

abstract class AbstractDatatable implements DatatableInterface
{

    protected const TABLE_PROPERTIES = [
        'status' => '',
        'orderby' => '',
        'table_class' => [],
        'table_id' => 'datatable',
        'show_table_thead' => true,
        'show_table_tfoot' => false,
        'before' => '<div>',
        'after' => '</div>'
    ];

    protected const COLUMNS_PARTS = [
        'db_row' => '',
        'dt_row' => '',
        'class' => '',
        'show_column' => true,
        'sortable' => false,
        'formatter' => ''
    ];

    protected array $attr = [];

    public function __construct()
    {
        $this->attr = self::TABLE_PROPERTIES;
        foreach ($this->attr as $key => $value) {
            if (!$this->validAttributes($key, $value)) {
                $this->validAttributes($key, $value);
            }
        }
    }

    public function setAttr($attributes = []) : self
    {
        if (is_array($attributes) && count($attributes) > 0) {
            $propKeys = array_keys(self::TABLE_PROPERTIES);
            foreach ($attributes as $key => $value) {
                if (!in_array($key, $propKeys)) {
                    throw new DatatableUnexpectedValueException('Invalid property key set.');
                }
                $this->validAttributes($key, $value);
                $this->attr[$key] = $value;
            }
        }
        return $this;
    }

    protected function validAttributes(string $key, $value) : void
    {
        if (empty($key)) {
            throw new DatatableUnexpectedValueException('Inavlid or empty attribute key. Ensure the key is present and of the correct data type ' . $value);
        }
        switch ($key) {
            case 'status' :
            case 'orderby' :
            case 'table_id' :
            case 'before' :
            case 'after' :
                if (!is_string($value)) {
                    throw new DatatableUnexpectedValueException('Invalid argument type ' . $value . ' should be a string');
                }
                break;
            case 'show_table_thead' :
            case 'show_table_tfoot' :
                if (!is_bool($value)) {
                    throw new DatatableUnexpectedValueException('Invalid argument type ' . $value . ' should be a boolean');
                }
                break;
            case 'table_class' :
                if (!is_array($value)) {
                    throw new DatatableUnexpectedValueException('Invalid argument type ' . $value . ' should be a array');
                }
                break;
        }
        $this->attr[$key] = $value;
    }
}