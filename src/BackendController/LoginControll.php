<?php

declare(strict_types=1);

namespace App\BackendController;


use App\Core\View;
use App\Model\LoginRepository;

class LoginControll
{
    private View $view;
    private UserDataValidation $validation;
    private LoginRepository $repository;
    private array $errors = [];
    private const HomeLink = ['<a href="index.php?newUser">Register as new user</a>'];
    private array $allUserDataSet = [];

    public function __construct(
        View $view,
        LoginRepository $login = new LoginRepository('Login'),
        $validation = new UserDataValidation()
    ) {
        $this->view = $view;
        $this->repository = $login;
        $this->validation = $validation;
    }

    public function loginUser(string $user): void
    {
        session_regenerate_id();
        $_SESSION['userId'] = 1;
        $_SESSION['lastLogin'] = time();
        $_SESSION['userName'] = $user;
    }

    private function getLoginData(): void
    {
        $userName = $_POST['userName'];
        $userData = $this->repository->findUserByName($userName);
        if ($userData) {
            $this->allUserDataSet = $userData;
        }
    }

    public function getUserDataSet(): array
    {
        $this->getLoginData();
        return $this->allUserDataSet;
    }

    public function validateLoginData(): void
    {
        if (isset($_POST['submit'])) {
            $userName = $_POST['userName'];
            $password = $_POST['password'];
            $isUserNameValid = $this->validation->checkIfUserNameIsValid($userName);
            $this->allUserDataSet = $this->getUserDataSet();
            $this->allUserDataSet['userName'] = '';
            if ($isUserNameValid) {
                $this->allUserDataSet['userName'] = $userName;
                $userDataArray = $this->repository->findUserByName($userName);
                $dbUserPassword = $userDataArray['password'];
                $isPasswordVeified = $this->validation->verifyPassword($password, $dbUserPassword);
                if ($isPasswordVeified) {
                    $this->loginUser($userName);
                    redirectTo('/../../index.php');
                }
            }
            $this->errors = $this->validation->getErrors();
        }
    }

    private
    function addUserParameterToView(): void
    {
        $this->view->addTemplateParameter('newUserLink', self::HomeLink);
    }

    public
    function renderView(): void
    {
        $this->validateLoginData();
        $this->addUserParameterToView();
        $this->view->addTemplateParameter('errors', $this->errors);
        $this->view->setTemplate('login.tpl');
    }
}