<?php

declare(strict_types=1);

namespace App\Controller\FrontendController;


use App\Core\View;

class NotFoundControll implements NotFoundControllInterface
{
    const error = ['Page not found'];

    public function __construct(private View $view)
    {
    }

    public function renderView(): void
    {
        $this->view->addTemplateParameter('error', self::error);
        $this->view->renderTemplate();
    }
}