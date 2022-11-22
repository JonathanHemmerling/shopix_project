<?php

declare(strict_types=1);

namespace App\Controller\BackendController;

use App\Controller\ControllerInterface;
use App\Core\View;

class LogoutControll implements ControllerInterface
{

    private View $view;
    private const homeLink = ['<a href="index.php?pageb=NewUser">Register as new user</a>'];
    private const message = ['Logout successful!'];

    public function __construct(View $view, Session $session = new Session())
    {
        $this->view = $view;
        $session->logoutUser();
    }

    private function addParameterToView(): void
    {
        $this->view->addTemplateParameter('newUserLink', self::homeLink);
        $this->view->addTemplateParameter('errors', self::message);
    }

    public function renderView(): void
    {
        $this->addParameterToView();
        $this->view->setTemplate('login.tpl');
    }
}