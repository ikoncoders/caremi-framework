<?php declare(strict_types=1);
namespace Caremi\DataObjectLayer\DataRepository;

use Caremi\Utility\Stringify;
use Caremi\Base\BaseApplication;

// use MagmaCore\Collection\Collection;
// use MagmaCore\DataObjectLayer\Exception\DataLayerException;
// use MagmaCore\DataObjectLayer\Exception\DataLayerUnexpectedValueException;
// use MagmaCore\DataObjectLayer\DataRepository\DataRepositoryValidationInterface;

trait DataRelationshipTrait
{

    public function findManyToMany(string $tablePivot)
    {
        if ($tablePivot) {
            $newPivotObject = BaseApplication::diGet($tablePivot);
            if (!$newPivotObject) {
                throw new \Exception();
            }

            /* explode the pivot table string and extract both assocative tables */
            $tableNames = explode('_', $newPivotObject->getSchema());
            if (is_array($tableNames) && count($tableNames) > 0) {
                $test = array_filter($tableNames, function($tableName) {
                    $suffix = 'Model';
                    $namespace = '\App\Model\\';
        
                    if (is_string($tableName)) {
                        $modelNameSuffix = $tableName . $suffix;
                        $modelName = Stringify::studlyCaps($modelNameSuffix);
                        if (class_exists($newModelClass = $namespace . $modelName)) {
                            $newModelObject = BaseApplication::diGet($newModelClass);
                            if (!$newModelObject) {
                                throw new \Exception();
                            }

                        }
                        return $newModelObject;

                    }
                });
                var_dump($test);
                die;
            }
        }
    }

}