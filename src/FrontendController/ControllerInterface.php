<?php

declare(strict_types=1);

namespace App\FrontendController;

interface ControllerInterface
{
    public function renderView(): void;
}