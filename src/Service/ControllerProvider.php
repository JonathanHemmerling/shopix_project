<?php

declare(strict_types=1);

namespace App\Service;

use App\BackendController\LoginControll;
use App\BackendController\LogoutControll;
use App\BackendController\NewUserControll;
use App\FrontendController\DetailControll;
use App\FrontendController\HomeControll;
use App\FrontendController\ListControll;
use App\FrontendController\NotFoundControll;

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