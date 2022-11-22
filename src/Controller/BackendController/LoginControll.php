<?php

declare(strict_types=1);

namespace App\Controller\BackendController;


use App\Controller\ControllerInterface;
use App\Controller\Session;
use App\Core\View;
use App\Model\LoginRepository;
use App\Validation\UserDataValidation;

class LoginControll implements ControllerInterface
{
    private View $view;
    private UserDataValidation $userValidation;
    private LoginRepository $repository;
    private Session $session;
    private const HomeLink = ['<a href="index.php?pageb=User">Register as new user</a>'];
    private array $allUserDataSet = [];
    private array $errors = [];

    public function __construct(
        View $view,
        LoginRepository $login = new LoginRepository('Login'),
        UserDataValidation $userValidation = new UserDataValidation(),
        Session $session = new Session()
    ) {
        $this->session = $session;
        $this->view = $view;
        $this->repository = $login;
        $this->userValidation = $userValidation;
    }

    private function getLoginData(string $userName): void
    {
        $userData = $this->repository->findUserByName( $userName);
        if ($userData) {
            $this->allUserDataSet = $userData;
        }
    }

    public function getUserDataSet(string $userName): array
    {
        $this->getLoginData($userName);
        return $this->allUserDataSet;
    }

    private function validateLoginData(): array
    {
        if (isset($_POST['submit'])) {
            $userName = $_POST['userName'];
            $password = $_POST['password'];
            $isUserNameValid = $this->userValidation->checkIfUserNameIsValid($userName);
            $this->allUserDataSet = $this->getUserDataSet($userName);
            $this->allUserDataSet['userName'] = '';
            if ($isUserNameValid) {
                $this->allUserDataSet['userName'] = $userName;
                $userDataArray = $this->repository->findUserByName($userName);
                $dbUserPassword = $userDataArray['password'];
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