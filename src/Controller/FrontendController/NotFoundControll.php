<?php

declare(strict_types=1);

namespace App\Controller\FrontendController;


use App\Controller\ControllerInterface;
use App\Core\View;

class NotFoundControll  implements ControllerInterface
{
    private const error = ['Page not found'];

    public function __construct(private readonly View $view)
    {
    }

    public function renderView(): void
    {
        $this->view->addTemplateParameter('error', self::error);
        $this->view->setTemplate('notFound.tpl');
    }
}