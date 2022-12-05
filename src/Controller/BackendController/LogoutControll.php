<?php

declare(strict_types=1);

namespace App\Controller\BackendController;

use App\Core\Session;
use App\Core\View;


class LogoutControll implements LogoutControllInterface
{
    private const homeLink = ['<a href="index.php?pageb=User">Register as new user</a>'];
    private const message = ['Logout successful!'];

    public function __construct(
        private View $view,
        private Session $session
    ) {
    }

    private function addParameterToView(): void
    {
        $this->view->addTemplateParameter('UserLink', self::homeLink);
        $this->view->addTemplateParameter('errors', self::message);
    }

    public function renderView(): void
    {
        $this->session->logoutUser();
        $this->addParameterToView();
        $this->view->setTemplate('login.tpl');

    }
}