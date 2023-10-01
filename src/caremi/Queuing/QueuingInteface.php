<?php declare(strict_types=1);

namespace Caremi\Queuing;

interface QueuingInteface
{

    public function create(array $data) : void;
    public function quantity();
    public function delete(Object $item) : void;
    public function release(Object $item) : bool;

}