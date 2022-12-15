<?php

declare(strict_types=1);

namespace App\Controller\BackendController;

use App\Controller\ControllerInterface;
use App\Core\SessionInterface;
use App\Core\ViewInterface;


class LogoutControll implements ControllerInterface
{
    private const message = ['Logout successful!'];

    public function __construct(
        private readonly ViewInterface $view,
        private readonly SessionInterface $session
    ) {
    }

    public function renderView(): void
    {
        $this->session->logoutUser();
        $this->view->addTemplateParameter('errors', self::message);
        $this->view->setTemplate('login.tpl');
    }
}