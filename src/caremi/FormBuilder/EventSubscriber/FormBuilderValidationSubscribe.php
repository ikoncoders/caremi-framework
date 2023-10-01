<?php declare(strict_types=1);
namespace Caremi\FormBuilder\EventSubscriber;


// use MagmaCore\EventDispatcher\EventDispatcherTrait;
// use MagmaCore\EventDispatcher\EventDispatcherDefaulter;
// use MagmaCore\EventDispatcher\EventSubscriberInterface;
// use MagmaCore\ValidationRule\Event\ValidateRuleEvent;

/**
 * Note: If we want to flash other routes then they must be declared within the ACTION_ROUTES
 * protected constant
 */
class FormBuilderValidationSubscribe extends EventDispatcherDefaulter implements EventSubscriberInterface
{

    use EventDispatcherTrait;

    /**
     * Subscibe multiple listeners to listen for the NewActionEvent. This will fire
     * each time a new user is added to the database. Listeners can then perform
     * addtitional tasks on that return object.
     *
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            ValidateRuleEvent::NAME => [
                ['test'],
            ]
        ];
    }


}
