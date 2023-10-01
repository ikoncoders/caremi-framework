<?php declare(strict_types=1);

namespace MagmaCore\Base;

use Caremi\Base\BaseModel;

Abstract class AbstractBaseModel extends BaseModel
{ 
    
    /**
     * return an array of ID for which the system will prevent from being
     * deleted
     *
     * @return array
     */
    abstract public function guardedID() : array;

}
