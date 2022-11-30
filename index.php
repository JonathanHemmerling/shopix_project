<?php

declare(strict_types=1);


require __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/showErrorsInBrowser.php';
require_once(__DIR__ . '/src/functions/authFunctions.php');

use App\Controller\ControllerInterface;
use App\Controller\FrontendController\NotFoundControll;
use App\Core\Session;
use App\Core\View;
use App\Model\LoginRepository;
use App\Model\Mapper\MainMenuMapper;
use App\Model\Mapper\ProductsMapper;
use App\Model\Mapper\SubMenuMapper;
use App\Model\ProductRepository;
use App\Model\UserRepository;
use App\Service\Container;
use App\Service\ControllerProvider;
use App\Service\DependencyProvider;
use App\SQL\SqlConnection;
use App\Validation\UserDataValidation;


ob_start();
session_start();

$smarty = new Smarty();
$view = new View($smarty);
$sql = new SqlConnection();
$pdo = new PDO('mysql:host=0.0.0.0:13306;dbname=shopix', 'TestUser', 'password');
$login = new LoginRepository($sql, $pdo);
$repository = new UserRepository($sql);
$validation = new UserDataValidation($login, $repository);
$session = new Session();
$product = new ProductRepository($sql, $pdo, new ProductsMapper(), new SubMenuMapper(), new MainMenuMapper());

$className = NotFoundControll::class;
$providerCon = new ControllerProvider();
$providerList = $providerCon->getList();


if (isLoggedIn()) {
    $pageTitle = 'FrontendController\\Home';;
    if (isset($_GET['page'])) {
        $pageTitle = 'FrontendController\\' . $_GET['page'];
    }
    if (isset($_GET['pageb'])) {
        $pageTitle = 'BackendController\\' . $_GET['pageb'];
    }
}
if (!isLoggedIn()) {
    if (isset($_GET['pageb'])) {
        $pageTitle = 'BackendController\\' . $_GET['pageb'];
    }
    if (!isset($_GET['pageb'])) {
        $pageTitle = 'BackendController\\' . 'Login';
    }
}

foreach ($providerList as $providerElement) {
    if ($providerElement === 'App\\Controller\\' . $pageTitle . 'Controll') {
        $className = $providerElement;
        break;
    }
}

/** @var ControllerInterface $controller */
if (str_contains($className, 'BackendController')) {
    $controller = new $className($view, $login, $repository, $validation, $session);
}
if (str_contains($className, 'FrontendController')) {
    $controller = new $className($view, $product);
}
$controller->renderView();
$view->renderTemplate();

$dependencyProvider = new DependencyProvider();
$container = new Container();
$dependencyProvider->providerDependency($container);
var_dump($container);