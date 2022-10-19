<?php

declare(strict_types=1);

namespace App\Service;

use App\Controller\DetailControll;
use App\Controller\ErrorControll;
use App\Controller\HomeControll;
use App\Controller\ListControll;

class ControllerProvider
{
    public function getList(): array
    {
        return
            [
                DetailControll::class,
                ErrorControll::class,
                HomeControll::class,
                ListControll::class,
            ];
    }
}