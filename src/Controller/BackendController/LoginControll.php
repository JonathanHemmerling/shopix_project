<?php

declare(strict_types=1);

namespace App\Controller\BackendController;


use App\Controller\ControllerInterface;
use App\Core\RedirectInterface;
use App\Core\SessionInterface;
use App\Core\ViewInterface;
use App\Model\LoginRepositoryInterface;
use App\Validation\UserDataValidationInterface;

class LoginControll  implements ControllerInterface
{

    public function __construct(
        private ViewInterface $view,
        private LoginRepositoryInterface $login,
        private UserDataValidationInterface $userValidation,
        private SessionInterface $session,
        private RedirectInterface $redirect,
    ) {
    }


    public function renderView(): void
    {
        if (isset($_POST['submit'])) {
            $userName = $_POST['userName'];
            $password = $_POST['password'];
            $isUserNameValid = $this->userValidation->checkIfUserNameIsValid($userName);

            if ($isUserNameValid) {
                $userDataArray = $this->login->findUserByName($userName);
                $dbUserPassword = $userDataArray['hashedPassword'];
                $isPasswordVerified = $this->userValidation->verifyPassword($password, $dbUserPassword);
                if ($isPasswordVerified) {
                    $this->session->loginUser();
                    $this->redirect->to('/../../index.php');
                }
            }
        }

        $this->view->addTemplateParameter('errors', $this->userValidation->getErrors());

        $this->view->setTemplate('login.tpl');
    }
}