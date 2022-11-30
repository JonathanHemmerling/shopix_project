<?php

declare(strict_types=1);

namespace App\Controller\BackendController;

use App\Core\ViewInterface;
use App\Model\AdminRepositoryInterface;

class AdminController implements AdminControllerInterface
{
    public function __construct(private ViewInterface $view, private AdminRepositoryInterface $repository)
    {
    }

    public function renderView(): void
    {
        // TODO: Implement renderView() method.
    }
}