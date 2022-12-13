<?php

declare(strict_types=1);

namespace App\Controller\BackendController;

use App\Core\Session;
use App\Core\View;


class AdminLogoutControll
{
    private const message = ['Logout successful!'];

    public function __construct(
        private View $view,
        private Session $session
    ) {
    }

    public function renderView(): void
    {
        $this->session->logoutUser();
        $this->view->addTemplateParameter('errors', self::message);
        $this->view->setTemplate('adminLogin.tpl');
    }
}