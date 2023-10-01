<?php declare(strict_types=1);
namespace Caremi\DataObjectLayer\EntityManager;

use Caremi\DataObjectLayer\EntityManager\CrudInterface;

class EntityManager implements EntityManagerInterface
{

    /**
     * @var CrudInterface
     */
    protected CrudInterface $crud;

    /**
     * Main constructor clas
     * 
     * @return void
     */
    public function __construct(CrudInterface $crud)
    {
        $this->crud = $crud;
    }

    /**
     * @inheritDoc
     */
    public function getCrud() : Object
    {
        return $this->crud;
    }

}
