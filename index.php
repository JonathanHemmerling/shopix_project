<?php

declare(strict_types=1);


require __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/showErrorsInBrowser.php';
require_once(__DIR__ . '/src/functions/authFunctions.php');

use App\Controller\FrontendController\NotFoundControll;
use App\Core\View;
use App\Service\Container;
use App\Service\ControllerProvider;
use App\Service\DependencyProvider;

ob_start();
session_start();

$className = NotFoundControll::class;
$providerCon = new ControllerProvider();
$container = new Container();
$dependencyProvider = new DependencyProvider();
$dependencyProvider->providerDependency($container);
$view = $container->get(View::class);
$providerList = $providerCon->getList();

if (isLoggedIn()) {
    $pageTitle = 'FrontendController\\Home';
    if (isset($_GET['page'])) {
        $pageTitle = 'FrontendController\\' . $_GET['page'];
    }
    if (isset($_GET['pageb'])) {
        $pageTitle = 'BackendController\\' . $_GET['pageb'];
    }
}
if (!isLoggedIn()) {
    $pageTitle = 'BackendController\\' . 'Login';

    if (isset($_GET['pageb'])) {
        $pageTitle = 'BackendController\\' . $_GET['pageb'];
    }
}

foreach ($providerList as $providerElement) {
    if ($providerElement === 'App\\Controller\\' . $pageTitle . 'Controll') {
        $className = $providerElement;
        break;
    }
}


$container = $container->get($className);
$container->renderView();
$view->renderTemplate();


