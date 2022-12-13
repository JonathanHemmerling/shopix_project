<?php

declare(strict_types=1);

namespace App\Controller\BackendController;


use App\Controller\ControllerInterface;
use App\Core\Redirect;
use App\Core\SessionInterface;
use App\Core\ViewInterface;
use App\Model\LoginRepositoryInterface;
use App\Validation\UserDataValidationInterface;

class AdminLoginControll implements ControllerInterface
{
    public function __construct(
        private ViewInterface $view,
        private LoginRepositoryInterface $login,
        private UserDataValidationInterface $userValidation,
        private SessionInterface $session,
        private Redirect $redirect
    ) {
    }

    public function renderView(): void
    {
        if (isset($_POST['submit'])) {
            $userName = $_POST['adminName'];
            $password = $_POST['password'];
            $isUserNameValid = $this->userValidation->checkIfUserNameIsValid($userName);
            if ($isUserNameValid) {
                $userDataArray = $this->login->findAdminByName($userName);
                $dbUserPassword = $userDataArray['hashedPassword'];
                $isPasswordVerified = $this->userValidation->verifyPassword($password, $dbUserPassword);
                if ($isPasswordVerified) {
                    $this->session->loginAdmin();
                    $this->redirect->to('/../../index.php?page=Admin&backend');
                }
            }
        }
        $this->view->addTemplateParameter('errors', $this->userValidation->getErrors());
        $this->view->setTemplate('adminLogin.tpl');
    }

}