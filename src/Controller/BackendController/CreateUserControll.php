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
        private readonly UserRepositoryInterface $repository,
        private readonly UserDataValidationInterface $validation
    ) {
    }

    public function renderView(): void
    {
        if (isset($_POST['submit'])) {
            $userArray = [];
            $userName = $_POST['userName'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $confirmPassword = $_POST['confirmPassword'];
            $isUserNameValid = $this->validation->checkIfNewUserNameIsValid($userName);
            $isPasswordValid = $this->validation->checkIfPasswordIsValid($password, $confirmPassword);
            if ($isUserNameValid && $isPasswordValid) {
                $userArray['userName'] = $userName;
                $userArray['firstName'] = $_POST['firstName'];
                $userArray['lastName'] = $_POST['lastName'];
                $userArray['country'] = $_POST['country'];
                $userArray['postCode'] = $_POST['postCode'];
                $userArray['city'] = $_POST['city'];
                $userArray['street'] = $_POST['street'];
                $userArray['streetNumber'] = $_POST['streetNumber'];
                $userArray['email'] = $_POST['email'];
                $userArray['telefonNumber'] = $_POST['telefonNumber'];
                $userArray['hashedPassword'] = $password;
                $this->repository->addNewUserDataArrayToDb($userArray);
            }
        }
        $this->view->addTemplateParameter('errors', $this->validation->getErrors());
        $this->view->setTemplate('createUser.tpl');
    }
}