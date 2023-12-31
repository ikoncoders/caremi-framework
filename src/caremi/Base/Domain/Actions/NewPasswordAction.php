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
class NewPasswordAction implements DomainActionLogicInterface
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

        if (isset($controller->formBuilder)) :
            if ($controller->formBuilder->canHandleRequest() && $controller->formBuilder->isSubmittable($this->getFileName() . '-' . strtolower($controller->thisRouteController()))) {
                if ($controller->formBuilder->csrfValidate()) {
                    $formData = $controller->formBuilder->getData();
                    $entityCollection = $controller->entity->wash($formData)->rinse()->dry();

                    if ($controller->repository->emailExists($entityCollection['email'])) {
                        $controller->repository->findByUser($entityCollection['email'])->sendUserResetPassword();
                        if ($controller->eventDispatcher) {
                            $controller->eventDispatcher->dispatch(
                                new $eventDispatcher(
                                    $method,
                                    array_merge(
                                        [], /* can return the user object as an array */
                                        $additionalContext ? $additionalContext : []
                                    ),
                                    $controller
                                ),
                                $eventDispatcher::NAME
                            );
                        }
                    } else {
                        if ($controller->error) {
                            $controller->error->addError(['invalid' => 'Your email address could not be found!'], $controller)->dispatchError($controller->onSelf());
                        }
                    }
                }
            }
        endif;

        return $this;
    }
}
