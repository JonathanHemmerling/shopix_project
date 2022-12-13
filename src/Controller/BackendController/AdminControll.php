<?php

declare(strict_types=1);
namespace App\Controller\BackendController;

use App\Controller\ControllerInterface;
use App\Core\ViewInterface;

class AdminControll implements ControllerInterface
{
    public function __construct(private ViewInterface $view)
    {
    }

    public function renderView(): void
    {
        $this->view->setTemplate('admin.tpl');
    }
}