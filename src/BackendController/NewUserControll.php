<?php

declare(strict_types=1);

namespace App\BackendController;

use App\Core\View;
use App\Model\NewUserRepository;

class NewUserControll
{
    private View $view;
    private NewUserRepository $repository;
    private NewUserDataValidation $validation;
    private array $message = array();
    private const LoginLink = ['<a href="index.php">Back to Login</a>'];

    public function __construct(
        View $view,
        NewUserRepository $newUser = new NewUserRepository('Login'),
        NewUserDataValidation $validation = new NewUserDataValidation()
    ) {
        $this->view = $view;
        $this->repository = $newUser;
        $this->validation = $validation;
    }

    private function validateLoginData(): void
    {
        if (isset($_POST['submit'])) {
            $userName = $_POST['userName'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $confirmPassword = $_POST['confirmPassword'];
            $isUserNameValid = $this->validation->checkIfUserNameIsValid($userName);
            $isPasswordValid = $this->validation->checkIfPasswordIsValid($password, $confirmPassword);

            if ($isUserNameValid && $isPasswordValid) {
                $userArray = array(
                    "userName" => $userName,
                    "password" => $password,
                );
                $this->repository->addNewUserDataArrayToJson($userArray);
            }
            $this->message = $this->validation->getErrors();
        }
    }

    private function addUserParameterToView(): void
    {
        $this->view->addTemplateParameter('backToLogin', self::LoginLink);
        $this->view->addTemplateParameter('errors', $this->message);
    }

    public function renderView(): void
    {
        $this->validateLoginData();
        $this->addUserParameterToView();
        $this->view->setTemplate('newUser.tpl');
    }
}