<?php

declare(strict_types=1);

namespace App\BackendController;


use App\Core\View;
use App\Model\LoginRepository;
use App\Validation\UserDataValidation;

class LoginControll
{
    private View $view;
    private UserDataValidation $validation;
    private LoginRepository $repository;
    private array $errors = [];
    private const HomeLink = ['<a href="index.php?pageb=NewUser">Register as new user</a>'];
    private array $allUserDataSet = [];
    private string $userName;

    public function __construct(
        View $view,
        LoginRepository $login = new LoginRepository('Login'),
        $validation = new UserDataValidation()
    ) {
        $this->view = $view;
        $this->repository = $login;
        $this->validation = $validation;
        $this->userName = '';
    }

    public function loginUser(): void
    {
        session_regenerate_id();
        $_SESSION['lastLogin'] = time();
        $_SESSION['userName'] = $_POST['userName'];
    }

    private function getLoginData(): void
    {
        $userData = $this->repository->findUserByName($this->userName);
        if ($userData) {
            $this->allUserDataSet = $userData;
        }
    }

    public function getUserDataSet(): array
    {
        $this->getLoginData();
        return $this->allUserDataSet;
    }

    private function validateLoginData(): array
    {
        if (isset($_POST['submit'])) {
            $this->userName = $_POST['userName'];
            $password = $_POST['password'];
            $isUserNameValid = $this->validation->checkIfUserNameIsValid($this->userName);
            $this->allUserDataSet = $this->getUserDataSet();
            $this->allUserDataSet['userName'] = '';
            if ($isUserNameValid) {
                $this->allUserDataSet['userName'] = $this->userName;
                $userDataArray = $this->repository->findUserByName($this->userName);
                $dbUserPassword = $userDataArray['password'];
                $isPasswordVerified = $this->validation->verifyPassword($password, $dbUserPassword);
                if ($isPasswordVerified) {
                    $this->loginUser();
                    redirectTo('/../../index.php');
                }
            }
            if (!$isUserNameValid || !$isPasswordVerified) {
                return $this->validation->getErrors();
            }
        }
        return [];
    }

    private function addUserParameterToView(): void
    {
        $this->view->addTemplateParameter('newUserLink', self::HomeLink);
    }

    public function renderView(): void
    {
        $this->errors = $this->validateLoginData();
        $this->addUserParameterToView();
        $this->view->addTemplateParameter('errors', $this->errors);
        $this->view->setTemplate('login.tpl');
    }
}