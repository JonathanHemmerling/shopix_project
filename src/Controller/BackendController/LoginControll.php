<?php

declare(strict_types=1);

namespace App\Controller\BackendController;


use App\Controller\ControllerInterface;
use App\Core\RedirectInterface;
use App\Core\SessionInterface;
use App\Core\ViewInterface;
use App\Model\LoginRepositoryInterface;
use App\Validation\UserDataValidationInterface;

class LoginControll implements ControllerInterface
{

    public function __construct(
        private readonly ViewInterface $view,
        private readonly LoginRepositoryInterface $login,
        private readonly UserDataValidationInterface $userValidation,
        private readonly SessionInterface $session,
        private readonly RedirectInterface $redirect,
    ) {
    }


    public function renderView(): void
    {
        if (isset($_SESSION['userName']) || isset($_SESSION['adminName'])) {
            $this->session->logoutUser();
        }
        if (isset($_POST['submit'])) {
            $userName = $_POST['userName'];
            $password = $_POST['password'];
            $isUserNameValid = $this->userValidation->checkIfUserNameIsValid($userName);

            if ($isUserNameValid) {
                $userDataArray = $this->login->findUserByName($userName);
                $dbUserPassword = $userDataArray['hashedPassword'];
                $isPasswordVerified = $this->userValidation->verifyPassword($password, $dbUserPassword);
                if ($isPasswordVerified) {
                    $this->session->loginUser($userDataArray['id']);
                    $this->redirect->to('/../../index.php');
                }
            }
        }

        $this->view->addTemplateParameter('errors', $this->userValidation->getErrors());
        $this->view->setTemplate('login.tpl');
    }
}