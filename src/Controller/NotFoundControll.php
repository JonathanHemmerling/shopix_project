<?php

declare(strict_types=1);

namespace App\Controller;


use App\Core\View;
use App\Interfaces\ControllerInterface;

class NotFoundControll implements ControllerInterface
{
    private string $error = 'Page not found';

    private View $view;

    public function __construct(View $view)
    {
        $this->view = $view;
    }

    public function renderView(): void
    {
        $this->view->addTemplateParameter('error', [$this->error]);
        $this->view->renderTemplate('notFound.tpl');
    }
}