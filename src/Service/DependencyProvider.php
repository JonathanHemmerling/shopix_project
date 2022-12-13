<?php

declare(strict_types=1);

namespace App\Service;

use App\Controller\BackendController\AdminControll;
use App\Controller\BackendController\AdminLoginControll;
use App\Controller\BackendController\AdminLogoutControll;
use App\Controller\BackendController\CategoryDataControll;
use App\Controller\BackendController\ChangeUserDataControll;
use App\Controller\BackendController\CreateProductControll;
use App\Controller\BackendController\DetailDataControll;
use App\Controller\BackendController\LoginControll;
use App\Controller\BackendController\LogoutControll;
use App\Controller\BackendController\UserControll;
use App\Controller\BackendController\UserDetailControll;
use App\Controller\BackendController\UserOverviewControll;
use App\Controller\FrontendController\DetailControll;
use App\Controller\FrontendController\HomeControll;
use App\Controller\FrontendController\ListControll;
use App\Controller\FrontendController\NotFoundControll;
use App\Core\Redirect;
use App\Core\Session;
use App\Core\View;
use App\Model\LoginRepository;
use App\Model\Mapper\MainMenuMapper;
use App\Model\Mapper\ProductsMapper;
use App\Model\Mapper\SubMenuMapper;
use App\Model\Mapper\UserDataMapper;
use App\Model\ProductRepository;
use App\Model\UserRepository;
use App\SQL\SqlConnection;
use App\Validation\UserDataValidation;
use PDO;
use Smarty;

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
        $container->set(SubMenuMapper::class, new SubMenuMapper());
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
            CategoryDataControll::class,
            new CategoryDataControll(
                $container->get(View::class),
                $container->get(ProductRepository::class),
                $container->get(Redirect::class)
            )
        );
        $container->set(
            ChangeUserDataControll::class,
            new ChangeUserDataControll(
                $container->get(View::class),
                $container->get(UserRepository::class),
                $container->get(UserDataValidation::class),
                $container->get(Redirect::class)
            )
        );
        $container->set(
            CreateProductControll::class,
            new CreateProductControll(
                $container->get(View::class),
                $container->get(ProductRepository::class),
                $container->get(Redirect::class)
            )
        );
        $container->set(
            DetailControll::class,
            new DetailControll(
                $container->get(View::class),
                $container->get(ProductRepository::class)
            )
        );
        $container->set(DetailDataControll::class, new DetailDataControll($container->get(View::class), $container->get(ProductRepository::class)));
        $container->set(
            HomeControll::class,
            new HomeControll(
                $container->get(View::class),
                $container->get(ProductRepository::class)
            )
        );
        $container->set(
            ListControll::class,
            new ListControll(
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
            UserControll::class,
            new UserControll(
                $container->get(View::class),
                $container->get(UserRepository::class),
                $container->get(UserDataValidation::class)
            )
        );
        $container->set(
            UserDetailControll::class,
            new UserDetailControll($container->get(View::class), $container->get(UserRepository::class))
        );
        $container->set(
            UserOverviewControll::class,
            new UserOverviewControll(
                $container->get(View::class),
                $container->get(UserRepository::class),
                $container->get(Redirect::class)
            )
        );
    }
}