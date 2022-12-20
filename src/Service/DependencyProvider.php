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
use App\Core\Redirect;
use App\Core\Session;
use App\Core\View;
use App\Model\LoginRepository;
use App\Model\Mapper\MainMenuMapper;
use App\Model\Mapper\ProductsMapper;
use App\Model\Mapper\UserDataMapper;
use App\Model\ProductRepository;
use App\Model\UserRepository;
use App\SQL\SqlConnection;
use App\Validation\UserDataValidation;
use PDO;
use Smarty;

/**
 * @infection-ignore-all
 */

class DependencyProvider
{
    public function __construct()
    {
    }

    public function providerDependency(Container $container): void
    {
        $container->set(Redirect::class, new Redirect());
        $container->set(SqlConnection::class, new SqlConnection());
        $container->set(Smarty::class, new Smarty());
        $container->set(View::class, new View($container->get(Smarty::class)));
        $container->set(PDO::class, new PDO('mysql:host=0.0.0.0:13306;dbname=shopix', 'TestUser', 'password'));
        $container->set(Session::class, new Session());
        $container->set(UserDataMapper::class, new UserDataMapper());
        $container->set(ProductsMapper::class, new ProductsMapper());
        $container->set(MainMenuMapper::class, new MainMenuMapper());
        $container->set(
            LoginRepository::class,
            new LoginRepository($container->get(SqlConnection::class), $container->get(PDO::class))
        );
        $container->set(
            ProductRepository::class,
            new ProductRepository(
                $container->get(SqlConnection::class),
                $container->get(PDO::class),
                $container->get(ProductsMapper::class),
                $container->get(MainMenuMapper::class)
            )
        );
        $container->set(
            UserRepository::class,
            new UserRepository($container->get(SqlConnection::class), $container->get(UserDataMapper::class))
        );
        $container->set(
            UserDataValidation::class,
            new UserDataValidation($container->get(LoginRepository::class), $container->get(UserRepository::class))
        );
        $container->set(
            AdminControll::class,
            new AdminControll($container->get(View::class))
        );
        $container->set(
            AdminLoginControll::class,
            new AdminLoginControll(
                $container->get(View::class),
                $container->get(LoginRepository::class),
                $container->get(UserDataValidation::class),
                $container->get(Session::class),
                $container->get(Redirect::class)
            )
        );
        $container->set(
            AdminLogoutControll::class,
            new AdminLogoutControll($container->get(View::class), $container->get(Session::class))
        );
        $container->set(
            AdminMainProductCategoryOverviewControll::class,
            new AdminMainProductCategoryOverviewControll(
                $container->get(View::class),
                $container->get(ProductRepository::class)
            )
        );
        $container->set(
            AdminProductOverviewControll::class,
            new AdminProductOverviewControll(
                $container->get(View::class),
                $container->get(ProductRepository::class)
            )
        );
        $container->set(
            UserSingleRecordControll::class,
            new UserSingleRecordControll(
                $container->get(View::class),
                $container->get(UserRepository::class),
            )
        );
        $container->set(
            CreateProductControll::class,
            new CreateProductControll(
                $container->get(View::class),
                $container->get(ProductRepository::class)
            )
        );
        $container->set(
            UserProductSingleRecordControll::class,
            new UserProductSingleRecordControll(
                $container->get(View::class),
                $container->get(ProductRepository::class)
            )
        );
        $container->set(
            AdminProductSingleRecordControll::class,
            new AdminProductSingleRecordControll(
                $container->get(View::class),
                $container->get(ProductRepository::class)
            )
        );
        $container->set(
            HomeControll::class,
            new HomeControll(
                $container->get(View::class),
                $container->get(ProductRepository::class)
            )
        );
        $container->set(
            UserProductCategoryOverviewControll::class,
            new UserProductCategoryOverviewControll(
                $container->get(View::class),
                $container->get(ProductRepository::class)
            )
        );
        $container->set(
            LoginControll::class,
            new LoginControll(
                $container->get(View::class),
                $container->get(LoginRepository::class),
                $container->get(UserDataValidation::class),
                $container->get(Session::class),
                $container->get(Redirect::class)
            )
        );
        $container->set(
            LogoutControll::class,
            new LogoutControll($container->get(View::class), $container->get(Session::class))
        );
        $container->set(
            NotFoundControll::class,
            new NotFoundControll(
                $container->get(View::class)
            )
        );
        $container->set(
            CreateUserControll::class,
            new CreateUserControll(
                $container->get(View::class),
                $container->get(UserRepository::class),
                $container->get(UserDataValidation::class)
            )
        );
        $container->set(
            AdminUserOverviewControll::class,
            new AdminUserOverviewControll(
                $container->get(View::class),
                $container->get(UserRepository::class)
            )
        );
    }
}