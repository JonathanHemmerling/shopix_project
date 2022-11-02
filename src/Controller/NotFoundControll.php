<?php

declare(strict_types=1);

namespace App\Controller;


use App\Core\View;

class NotFoundControll
{
    private string $error = 'Page not found';

    private View $view;

    public function __construct(View $view)
    {
        $this->view = $view;
        $this->getView();
    }
    public function getView(): void
    {
        $this->view->addTemplateParameter('error',[$this->error]);
        $this->view->display('notFound.tpl');
    }
}