<?php

declare(strict_types=1);

namespace App\Service;

use App\Controller\BackendController\LoginControll;
use App\Controller\BackendController\LogoutControll;
use App\Controller\BackendController\NewUserControll;
use App\Controller\FrontendController\DetailControll;
use App\Controller\FrontendController\HomeControll;
use App\Controller\FrontendController\ListControll;
use App\Controller\FrontendController\NotFoundControll;

class ControllerProvider
{

    public function getList(): array
    {
        return [
            LoginControll::class,
            LogoutControll::class,
            NewUserControll::class,
            DetailControll::class,
            HomeControll::class,
            ListControll::class,
            NotFoundControll::class,
        ];
    }

}