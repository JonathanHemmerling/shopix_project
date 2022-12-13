<?php

declare(strict_types=1);

namespace App\Service;

use App\Controller\BackendController\AdminControll;
use App\Controller\BackendController\AdminLoginControll;
use App\Controller\BackendController\ChangeUserDataControll;
use App\Controller\BackendController\CreateProductControll;
use App\Controller\BackendController\DetailDataControll;
use App\Controller\BackendController\UserDetailControll;
use App\Controller\BackendController\LoginControll;
use App\Controller\BackendController\AdminLogoutControll;
use App\Controller\BackendController\LogoutControll;
use App\Controller\BackendController\CategoryDataControll;
use App\Controller\BackendController\UserControll;
use App\Controller\BackendController\UserOverviewControll;
use App\Controller\FrontendController\DetailControll;
use App\Controller\FrontendController\HomeControll;
use App\Controller\FrontendController\ListControll;
use App\Controller\FrontendController\NotFoundControll;

class ControllerProvider
{

    public function getList(): array
    {
        return [
            AdminControll::class,
            AdminLoginControll::class,
            AdminLogoutControll::class,
            CategoryDataControll::class,
            ChangeUserDataControll::class,
            CreateProductControll::class,
            DetailControll::class,
            DetailDataControll::class,
            HomeControll::class,
            ListControll::class,
            LoginControll::class,
            LogoutControll::class,
            NotFoundControll::class,
            UserControll::class,
            UserDetailControll::class,
            UserOverviewControll::class,
            ];
    }

}