<?php

declare(strict_types=1);

namespace App\Controller\BackendController;

use App\Controller\ControllerInterface;
use App\Core\ViewInterface;
use App\Model\UserRepository;

class AdminUserOverviewControll implements ControllerInterface
{
    private array $userDataToDisplay = [];

    public function __construct(
        private readonly ViewInterface $view,
        private readonly UserRepository $userRepository,
    ) {
    }

    public function renderView(): void
    {
        $userId = (int)$_GET['userId'];
        if (isset($_POST['submit'])){
            $this->userRepository->deleteUserById($userId);
        }

        $allUsers = $this->userRepository->getAllUsers();
        foreach ($allUsers as $user) {
            $this->userDataToDisplay[$user->id] = $user->userName;
        }
        $this->view->addTemplateParameter('userDisplay', $this->userDataToDisplay);
        $this->view->setTemplate('userOverview.tpl');
    }
}