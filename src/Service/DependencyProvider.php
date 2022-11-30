<?php

declare(strict_types=1);
namespace App\Service;

use App\Controller\BackendController\AdminController;
use App\Core\Session;
use App\Core\View;
use App\Model\AdminRepository;
use App\Model\LoginRepository;
use App\Model\Mapper\MainMenuMapper;
use App\Model\Mapper\ProductsMapper;
use App\Model\Mapper\SubMenuMapper;
use App\Model\ProductRepository;
use App\Model\UserRepository;
use App\SQL\SqlConnection;
use PDO;
use Smarty;

class DependencyProvider{
    public function providerDependency(Container $container):void
    {
        $container->set(SqlConnection::class, new SqlConnection());
        $container->set(Smarty::class, new Smarty());
        $container->set(View::class, new View($container->get(Smarty::class)));
        $container->set(PDO::class, new PDO('mysql:host=0.0.0.0:13306;dbname=shopix', 'TestUser', 'password'));
        $container->set(Session::class, new Session());
        $container->set(ProductsMapper::class, new ProductsMapper());
        $container->set(SubMenuMapper::class, new SubMenuMapper());
        $container->set(MainMenuMapper::class, new MainMenuMapper());
        $container->set(AdminRepository::class, new AdminRepository());
        $container->set(LoginRepository::class, new LoginRepository($container->get(SqlConnection::class), $container->get(PDO::class)));
        $container->set(ProductRepository::class, new ProductRepository($container->get(SqlConnection::class), $container->get(PDO::class), $container->get(ProductsMapper::class),$container->get(SubMenuMapper::class),$container->get(MainMenuMapper::class)));
        $container->set(UserRepository::class, new UserRepository($container->get(SqlConnection::class)));
        $container->set(AdminController::class, new AdminController($container->get(View::class),$container->get(AdminRepository::class)));


    }
}