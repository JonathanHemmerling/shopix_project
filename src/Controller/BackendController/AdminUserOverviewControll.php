<?php

declare(strict_types=1);

namespace App\Controller\BackendController;

use App\Controller\ControllerInterface;
use App\Core\ViewInterface;
use App\Model\UserRepository;

class AdminUserOverviewControll implements ControllerInterface
{
    private array $userDisplay = [];
    private int $userId;
    public function __construct(
        private readonly ViewInterface $view,
        private readonly UserRepository $userRepository,
    ) {

    }

    public function renderView(): void
    {$this->userId = (int)$_GET['userId'];
        if (isset($_POST['submit'])){
            $this->userRepository->deleteUserById($this->userId);
        }

        $users = $this->userRepository->getAllUsers();
        foreach ($users as $user) {
            $this->userDisplay [$user->id] = $user->userName;
        }
        $this->view->addTemplateParameter('userDisplay', $this->userDisplay);
        $this->view->setTemplate('userOverview.tpl');
    }
}