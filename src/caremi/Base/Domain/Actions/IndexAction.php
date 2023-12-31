<?php declare(strict_types=1);
namespace Caremi\Base\Domain\Actions;

use Caremi\Base\Domain\DomainTraits;
use Caremi\Base\Domain\DomainActionLogicInterface;

/**
 * Class which handles the domain logic when adding a new item to the database
 * items are sanitize and validated before persisting to database. The class will 
 * also diaptched any validation error before persistence. The logic also implements
 * event dispatching which provide usable data for event listeners to perform other
 * necessary tasks and message flashing
 */
class IndexAction implements DomainActionLogicInterface
{

    use DomainTraits;

    /** @return void - not currently being used */
    public function __construct()
    {
    }

    /**
     * execute logic for adding new items to the database()
     * 
     * @param Object $controller - The controller object implementing this object
     * @param string $eventDispatcher - the eventDispatcher for the current object
     * @param string $objectSchema
     * @param string $method - the name of the method within the current controller object
     * @param array $additionalContext - additional data which can be passed to the event dispatcher
     * @return void
     */
    public function execute(
        Object $controller,
        string|null $entityObject = null,
        string|null $eventDispatcher = null,
        string|null $objectSchema = null,
        string $method,
        array $rules = [],
        array $additionalContext = []
    ): self {

        $this->controller = $controller;
        $this->method = $method;
        $this->schema = $objectSchema;

        $controller->getSession()->set('redirect_parameters', $_SERVER['QUERY_STRING']);
        $cs = $controller->controllerRepository->getRepo()->findOneBy(['controller_name' => $controller->thisRouteController()]);
        $a = [];
        foreach ($cs as $arg) {
            $a = $arg;
        }
        $this->args = [
            'records_per_page' => $this->isSet('records_per_page', $a), 
            'query' => $this->isSet('query', $a), 
            'filter_by' => unserialize($this->isSet('filter', $a)),
            'filter_alias' => $this->isSet('alias', $a), 
            'sort_columns' => unserialize($this->isSet('sortable', $a)), 
            'additional_conditions' => [], 
            'selectors' => []
        ];

        $this->tableRepository = $controller->repository->getRepo()->findWithSearchAndPaging($controller->request->handler(), $this->args);
        $this->tableData = $controller->tableGrid;

        if ($this->tableData)
            return $this;
    }
}
