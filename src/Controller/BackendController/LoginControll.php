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
        private readonly LoginRepositoryInterface $loginRepository,
        private readonly UserDataValidationInterface $userDataValidation,
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
            $userNameIsValid = $this->userDataValidation->checkIfUserNameIsValid($userName);
            if ($userNameIsValid) {
                $userDataFromRepository = $this->loginRepository->findUserByName($userName);
                $hashedPassword = $userDataFromRepository['hashedPassword'];
                $passwordIsVerified = $this->userDataValidation->verifyPassword($password, $hashedPassword);
                if ($passwordIsVerified) {
                    $this->session->loginUser($userDataFromRepository['id']);
                    $this->redirect->to('/../../index.php');
                }
            }
        }
        $this->view->addTemplateParameter('message', $this->userDataValidation->getErrors());
        $this->view->setTemplate('login.tpl');
    }
}