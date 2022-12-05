<?php

declare(strict_types=1);

namespace App\Controller\BackendController;

use App\Core\ViewInterface;
use App\Model\UserRepositoryInterface;
use App\Validation\UserDataValidation;

class ChangeUserDataControll implements ChangeUserDataControllInterface
{
    private array $userDataSet;
    private const home = ['<a href="index.php">Home</a>'];
    private array $errors = [];
    private array $array = [];

    public function __construct(
        private ViewInterface $view,
        private UserRepositoryInterface $repository, private UserDataValidation $userDataValidation
    ) {
    }

    public function getUserDataSet(): array
    {
        return $this->userDataSet;
    }

    private function changeUserData(): void
    {
        $userName = $_SESSION['userName'];
        $userExists = $this->userDataValidation->userNameExist($userName);
        if($userExists === true){
            $userArray = $this->repository->getCurrentUserData($userName);
        }




        if (!isset($user)) {
            $user = '';
        }
        $this->userDataSet = $this->repository->getCurrentUserData($user);
    }

    private function addParameterToView(): void
    {
        $this->view->addTemplateParameter('errors', $this->errors);
        $this->view->addTemplateParameter('home', self::home);
        $this->view->addTemplateParameter('items', $this->userDataSet);
    }

    public function renderView(): void
    {
        $this->changeUserData();
        $this->addParameterToView();
        $this->view->setTemplate('changeUserData.tpl');
    }


}