<?php declare(strict_types=1);
namespace Caremi\Base\Domain;

use Caremi\Error\Error;

// use App\Entity\UserEntity;


class DomainLogicRules
{

    /**
     * Ensure the password is verified before the action is carried out
     *
     * @return void
     */
    public function passwordRequired(string $value, string $key, Object $controller): void
    {
        if (!$controller->repository->verifyPassword($controller, $controller->findOr404()->id)) {
            if ($controller->error) {
                $controller->error->addError(Error::display('err_invalid_credentials'), $controller)->dispatchError();
            }
        }
    }

    /**
     * Douvble checks the user password before persisting to database
     *
     * @param string $value
     * @param string $key
     * @param Object $controller
     * @return void
     */
    public function passwordEqual(string $value, string $key, Object $controller)
    {
        $this->passwordRequired($value, $key, $controller);

        if (!$controller->repository->isPasswordMatching($controller, new UserEntity($controller->formBuilder->getData()))) {
            if ($controller->error) {
                $controller->error->addError(Error::display('err_mismatched_password'), $controller)->dispatchError();
            }
        }
    }
}
