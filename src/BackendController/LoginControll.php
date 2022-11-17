<?php

declare(strict_types=1);

namespace App\BackendController;


use App\Core\View;
use App\Model\Dto\UserDataTransferObject;
use App\Model\LoginRepository;

class LoginControll
{
    private View $view;
    private LoginRepository $repository;
    private array $errors = [];
    private const HomeLink = ['<a href="index.php?newUser">Register as new user</a>'];
    private array $userDataSet = [];

    public function __construct(View $view, LoginRepository $login = new LoginRepository('Login'))
    {
        $this->view = $view;
        $this->repository = $login;
    }

    public function loginUser(string $user): void
    {
        session_regenerate_id();
        $_SESSION['userId'] = 1;
        $_SESSION['lastLogin'] = time();
        $_SESSION['userName'] = $user;
    }

    public function getLoginData(): void
    {
        $userName = $_POST['userName'];
        $userData = $this->repository->findUserByName($userName);
        if ($userData) {
            $this->userDataSet = $userData;
        }
    }

    public function getUserDataSet()
    {
        $this->getLoginData();
        return $this->userDataSet;
    }


    public function validateLoginData(): void
    {
        if (isset($_POST['submit'])) {
            $userData = $this->getUserDataSet();
            if (empty($userData)) {
                $userData['password'] = '';
                $userData['userName'] = '';
            }
            $userName = $_POST['userName'];
            $userPassword = $_POST['password'];
            $dbUserPassword = $userData['password'];
            $dbUserName = $userData['userName'];
            if ($dbUserName === $userName && password_verify($userPassword, $dbUserPassword)) {
                $this->loginUser($userName);
                redirectTo('/../../index.php');
            } else {
                $this->errors = [];
                $this->errors [] = 'Invalid Userdata, please try again!';
            }
        }
    }

    private function addUserParameterToView(): void
    {
        $this->view->addTemplateParameter('newUserLink', self::HomeLink);
    }

    public function renderView(): void
    {
        $this->validateLoginData();
        $this->addUserParameterToView();
        $this->view->addTemplateParameter('errors', $this->errors);
        $this->view->setTemplate('login.tpl');
    }
}