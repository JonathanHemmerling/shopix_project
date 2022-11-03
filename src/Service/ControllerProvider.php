<?php

declare(strict_types=1);

namespace App\Service;

use App\Controller\DetailControll;
use App\Controller\HomeControll;
use App\Controller\ListControll;
use App\Controller\NotFoundControll;

class ControllerProvider
{

    public function getList(): array
    {
        return [
            DetailControll::class,
            HomeControll::class,
            ListControll::class,
            NotFoundControll::class,
        ];
    }

}