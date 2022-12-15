<?php

declare(strict_types=1);

namespace App\Controller\BackendController;

use App\Controller\ControllerInterface;
use App\Core\ViewInterface;
use App\Model\UserRepository;

class AdminUserOverviewControll implements ControllerInterface
{
    private array $userDisplay = [];

    public function __construct(
        private readonly ViewInterface $view,
        private readonly UserRepository $userRepository,
    ) {
    }

    public function renderView(): void
    {
        if (isset($_POST['submit'])) {
            $userId = (int)$_GET['userId'];
            $this->userRepository->deleteUserById($userId);
        }

        $users = $this->userRepository->getAllUsers();
        foreach ($users as $user) {
            $this->userDisplay [$user->id] = $user->userName;
        }
        $this->view->addTemplateParameter('userDisplay', $this->userDisplay);
        $this->view->setTemplate('userOverview.tpl');
    }
}