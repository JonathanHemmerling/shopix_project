<?php

declare(strict_types=1);

namespace App\Controller\BackendController;

use App\Controller\ControllerInterface;
use App\Core\ViewInterface;
use App\Model\UserRepositoryInterface;
use App\Validation\UserDataValidationInterface;

class CreateUserControll implements ControllerInterface
{
    private array $userArray = ['userName' => '', 'password' => ''];

    public function __construct(
        private readonly ViewInterface $view,
        private readonly UserRepositoryInterface $repository,
        private readonly UserDataValidationInterface $validation
    ) {
    }

    public function renderView(): void
    {
        if (isset($_POST['submit'])) {
            $userName = $_POST['userName'];
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $country = $_POST['country'];
            $postCode = $_POST['postCode'];
            $city = $_POST['city'];
            $street = $_POST['street'];
            $streetNumber = $_POST['streetNumber'];
            $email = $_POST['email'];
            $telefonNumber = $_POST['telefonNumber'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $confirmPassword = $_POST['confirmPassword'];
            $isUserNameValid = $this->validation->checkIfNewUserNameIsValid($userName);
            $isPasswordValid = $this->validation->checkIfPasswordIsValid($password, $confirmPassword);

            if ($isUserNameValid && $isPasswordValid) {
                $this->userArray['userName'] = $userName;
                $this->userArray['firstName'] = $firstName;
                $this->userArray['lastName'] = $lastName;
                $this->userArray['country'] = $country;
                $this->userArray['postCode'] = $postCode;
                $this->userArray['city'] = $city;
                $this->userArray['street'] = $street;
                $this->userArray['streetNumber'] = $streetNumber;
                $this->userArray['email'] = $email;
                $this->userArray['telefonNumber'] = $telefonNumber;
                $this->userArray['hashedPassword'] = $password;
                $this->repository->addNewUserDataArrayToDb($this->userArray);
            }
        }
        $this->view->addTemplateParameter('errors', $this->validation->getErrors());
        $this->view->setTemplate('createUser.tpl');
    }
}