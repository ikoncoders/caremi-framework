<?php declare(strict_types=1);
namespace Caremi\Datatable;

use Caremi\Datatable\DatatableColumnInterface;

abstract class AbstractDatatableColumn implements DatatableColumnInterface
{
    /**
     * @inheritdoc
     * @param array $dbColumns
     * @param object|null $callingController
     * @return array
     */
    abstract public function columns(array $dbColumns = [], object|null $callingController = null) : array;

    /**
     * Checks wheather model has defined any status columns and returns true
     * if there is one or false otherwise
     *
     * @param object $controller
     * @return boolean
     */
    public function hasStatusCols(object $controller): bool
    {
        $this->controller = $controller;
        $columns = $controller->repository->getColumnStatus();
        return (is_array($columns) && count($columns) > 0) ? true : false;
    }

    /**
     * Return an array of the defined status columns within the specified
     * model
     *
     * @return array
     */
    public function getStatusCols(): array
    {
        return $this->controller->repository->getColumnStatus();
    }

    public function getStatusValues(object $controller, callable $callback = null)
    {
        if ($this->hasStatusCols($controller)) {
            foreach ($this->getStatusCols() as $key => $value) {
                if (is_callable($callback)) {
                    return $callback($key, $value);
                }
            }
        }
    }
}