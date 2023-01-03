<?php

declare(strict_types=1);

namespace App\Service;

use App\Controller\BackendController\AdminControll;
use App\Controller\BackendController\AdminLoginControll;
use App\Controller\BackendController\AdminLogoutControll;
use App\Controller\BackendController\AdminMainProductCategoryOverviewControll;
use App\Controller\BackendController\AdminProductOverviewControll;
use App\Controller\BackendController\AdminProductSingleRecordControll;
use App\Controller\BackendController\AdminUserOverviewControll;
use App\Controller\BackendController\CreateProductControll;
use App\Controller\BackendController\CreateUserControll;
use App\Controller\BackendController\LoginControll;
use App\Controller\BackendController\LogoutControll;
use App\Controller\BackendController\UserSingleRecordControll;
use App\Controller\FrontendController\HomeControll;
use App\Controller\FrontendController\NotFoundControll;
use App\Controller\FrontendController\UserProductCategoryOverviewControll;
use App\Controller\FrontendController\UserProductSingleRecordControll;
/**
 * @infection-ignore-all
 */
class ControllerProvider
{

    public function getList(): array
    {
        return [
            AdminControll::class,
            AdminLoginControll::class,
            AdminLogoutControll::class,
            AdminMainProductCategoryOverviewControll::class,
            UserSingleRecordControll::class,
            CreateProductControll::class,
            UserProductSingleRecordControll::class,
            AdminProductSingleRecordControll::class,
            HomeControll::class,
            UserProductCategoryOverviewControll::class,
            LoginControll::class,
            LogoutControll::class,
            NotFoundControll::class,
            CreateUserControll::class,
            AdminProductOverviewControll::class,
            AdminUserOverviewControll::class,
        ];
    }

}