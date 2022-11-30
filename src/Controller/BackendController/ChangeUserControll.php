<?php

declare(strict_types=1);

namespace App\Controller\BackendController;

use App\Core\SessionInterface;
use App\Core\ViewInterface;
use App\Model\LoginRepositoryInterface;
use App\Model\UserRepositoryInterface;
use App\Validation\UserDataValidationInterface;

class ChangeUserControll implements ChangeUserControllInterface
{
    private array $userDataSet;
    private const home = ['<a href="index.php">Home</a>'];
    private array $errors = [];

    public function __construct(        private ViewInterface $view,
        private LoginRepositoryInterface $login,
        private UserRepositoryInterface $repository,
        private UserDataValidationInterface $userValidation,
        private SessionInterface $session)
    {
    }

    public function getUserDataSet(): array
    {
        return $this->userDataSet;
    }

    public function changeUserData()
    {
        $user = $_SESSION['userName'];
        $this->userDataSet = $this->repository->getCurrentUserData($user);
        $this->addParameterToView();
    }

    private function addParameterToView()
    {
        $this->view->addTemplateParameter('errors', $this->errors);
        $this->view->addTemplateParameter('home', self::home);
        $this->view->addTemplateParameter('items', $this->userDataSet);
    }

    public function renderView(): void
    {
        $this->changeUserData();
        $this->addParameterToView();
        $this->view->setTemplate('changeUser.tpl');
    }


}