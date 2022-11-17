<?php

declare(strict_types=1);

namespace App\BackendController;

use App\Core\View;
use App\Model\NewUserRepository;

class NewUserControll
{
    private View $view;
    private NewUserRepository $repository;
    private array $errors =[];
    private const LoginLink = ['<a href="index.php">Login</a>'];

    public function __construct(View $view, NewUserRepository $newUser = new NewUserRepository('Login'))
    {
        $this->view = $view;
        $this->repository = $newUser;
        $this->renderView();
    }

    private function isGetRequest(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }
    private function validateLoginData(): void
    {
        if ($this->isGetRequest()) {
            $userName = $_GET['userName'];
            $password = $_GET['password'];
            $confirmPassword = $_GET['confirmPassword'];


            //ABGLEICH

            $userArray = array(
                "userName" => $userName,
                "password" => $password,
            );
            $this->repository-> addNewUserDataArrayToJson($userArray);
        }
    }
    private function addUserParameterToView(): void{
        $this->view->addTemplateParameter('backToLogin', self::LoginLink);
        $this->view->addTemplateParameter('errors', $this->errors);
    }
    public function renderView(): void
    {
        $this->addUserParameterToView();
        $this->view->setTemplate('newUser.tpl');
    }
}