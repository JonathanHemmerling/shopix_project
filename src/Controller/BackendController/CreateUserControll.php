<?php

declare(strict_types=1);

namespace App\Controller\BackendController;

use App\Controller\ControllerInterface;
use App\Core\ViewInterface;
use App\Model\UserRepositoryInterface;
use App\Validation\UserDataValidationInterface;

class CreateUserControll implements ControllerInterface
{
    public function __construct(
        private readonly ViewInterface $view,
        private readonly UserRepositoryInterface $userRepository,
        private readonly UserDataValidationInterface $userDataValidation
    ) {
    }

    public function renderView(): void
    {
        if (isset($_POST['submit'])) {
            $userDataSet = [];
            $userName = $_POST['userName'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $confirmPassword = $_POST['confirmPassword'];
            $userNameIsValid = $this->userDataValidation->checkIfNewUserNameIsValid($userName);
            $passwordIsValid = $this->userDataValidation->checkIfPasswordIsValid($password, $confirmPassword);
            if ($userNameIsValid && $passwordIsValid) {
                $userDataSet['userName'] = $userName;
                $userDataSet['firstName'] = $_POST['firstName'];
                $userDataSet['lastName'] = $_POST['lastName'];
                $userDataSet['country'] = $_POST['country'];
                $userDataSet['postCode'] = $_POST['postCode'];
                $userDataSet['city'] = $_POST['city'];
                $userDataSet['street'] = $_POST['street'];
                $userDataSet['streetNumber'] = $_POST['streetNumber'];
                $userDataSet['email'] = $_POST['email'];
                $userDataSet['telefonNumber'] = $_POST['telefonNumber'];
                $userDataSet['hashedPassword'] = $password;
                $this->userRepository->addNewUserDataArrayToDb($userDataSet);
            }
        }
        $this->view->addTemplateParameter('errors', $this->userDataValidation->getErrors());
        $this->view->setTemplate('createUser.tpl');
    }
}