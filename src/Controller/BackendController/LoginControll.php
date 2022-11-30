<?php

declare(strict_types=1);

namespace App\Controller\BackendController;


use App\Controller\BackendControllerInterface;
use App\Controller\ControllerInterface;
use App\Core\SessionInterface;
use App\Core\ViewInterface;
use App\Model\LoginRepositoryInterface;
use App\Model\UserRepositoryInterface;
use App\Validation\UserDataValidationInterface;

class LoginControll implements LoginControllInterface
{
    private const HomeLink = ['<a href="index.php?pageb=User">Register as new user</a>'];
    private array $allUserDataSet = [];
    private array $errors = [];

    public function __construct(
        private ViewInterface $view,
        private LoginRepositoryInterface $login,
        private UserRepositoryInterface $repository,
        private UserDataValidationInterface $userValidation,
        private SessionInterface $session
    ) {
    }

    public function getLoginData(string $userName): void
    {
        $userData = $this->login->findUserByName($userName);
        if ($userData) {
            $this->allUserDataSet = $userData;
        }
    }

    public function getUserDataSet(string $userName): array
    {
        $this->getLoginData($userName);
        return $this->allUserDataSet;
    }

    public function validateLoginData(): array
    {
        if (isset($_POST['submit'])) {
            $userName = $_POST['userName'];
            $password = $_POST['password'];
            $isUserNameValid = $this->userValidation->checkIfUserNameIsValid($userName);
            $this->allUserDataSet = $this->login->findUserByName($userName);
            if ($isUserNameValid) {
                $userDataArray = $this->login->findUserByName($userName);
                $dbUserPassword = $userDataArray['hashedPassword'];
                $isPasswordVerified = $this->userValidation->verifyPassword($password, $dbUserPassword);
                if ($isPasswordVerified) {
                    $this->session->loginUser();
                    redirectTo('/../../index.php');
                }
            }
            if (!$isUserNameValid || !$isPasswordVerified) {
                return $this->userValidation->getErrors();
            }
        }
        return $this->errors;
    }

    private function addUserParameterToView(): void
    {
        $this->view->addTemplateParameter('errors', $this->errors);
        $this->view->addTemplateParameter('UserLink', self::HomeLink);
    }

    public function renderView(): void
    {
        $this->errors = $this->validateLoginData();
        $this->addUserParameterToView();
        $this->view->setTemplate('login.tpl');
    }
}