<?php

declare(strict_types=1);

namespace App\Controller\BackendController;

use App\Controller\ControllerInterface;
use App\Core\View;
use App\Model\UserRepository;
use App\Validation\NewUserDataValidation;

class UserControll implements ControllerInterface
{
    private View $view;
    private UserRepository $repository;
    private NewUserDataValidation $userValidation;
    private array $errorMessage = [];
    private const LoginLink = ['<a href="index.php">Back to Login</a>'];
    private array $userArray = ['userName' => '', 'password' => ''];

    public function __construct(
        View $view,
        UserRepository $newUser = new UserRepository('Login'),
        NewUserDataValidation $userValidation = new NewUserDataValidation()
    ) {
        $this->view = $view;
        $this->repository = $newUser;
        $this->userValidation = $userValidation;
    }

    public function validateLoginData(): array
    {
        if (isset($_POST['submit'])) {
            $userName = $_POST['userName'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $confirmPassword = $_POST['confirmPassword'];
            $isUserNameValid = $this->userValidation->checkIfUserNameIsValid($userName);
            $isPasswordValid = $this->userValidation->checkIfPasswordIsValid($password, $confirmPassword);

            if ($isUserNameValid && $isPasswordValid) {
                $this->userArray['userName'] = $userName;
                $this->userArray['password'] = $password;
                $this->repository->addNewUserDataArrayToJson($this->userArray);
            }
            if (!$isUserNameValid || !$isPasswordValid) {
                return $this->userValidation->getErrors();
            }
        }
        return $this->errorMessage;
    }

    private function addUserParameterToView(): void
    {
        $this->view->addTemplateParameter('backToLogin', self::LoginLink);
        $this->view->addTemplateParameter('errors', $this->errorMessage);
    }

    public function renderView(): void
    {
        $this->errorMessage = $this->validateLoginData();
        $this->addUserParameterToView();
        $this->view->setTemplate('newUser.tpl');
    }
}