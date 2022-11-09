<?php

declare(strict_types=1);

namespace App\Controller;


use App\Core\View;

class NotFoundControll implements ControllerInterface
{
    const error = ['Page not found'];

    private View $view;

    public function __construct(View $view)
    {
        $this->view = $view;
    }

    public function renderView(): void
    {
        $this->view->addTemplateParameter('error', self::error);
        $this->view->renderTemplate();
    }
}