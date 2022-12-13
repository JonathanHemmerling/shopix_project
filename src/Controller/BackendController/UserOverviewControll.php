<?php

declare(strict_types=1);

namespace App\Controller\BackendController;

use App\Controller\ControllerInterface;
use App\Core\Redirect;
use App\Core\ViewInterface;
use App\Model\UserRepository;

class UserOverviewControll implements ControllerInterface
{

    public function __construct(
        private ViewInterface $view,
        private UserRepository $userRepository,
        private Redirect $redirect
    ) {
    }

    public function renderView(): void
    {
        if (isset($_POST['submit'])) {

        }

        $users = $this->userRepository->getAllUsersFromDatabase();
        foreach ($users as $user) {
            $userDisplay [] = $user->userName;
        }
        $this->view->addTemplateParameter('userDisplay', $userDisplay);
        $this->view->setTemplate('userOverview.tpl');
    }
}