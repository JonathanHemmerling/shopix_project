<?php

declare(strict_types=1);

require_once __DIR__ . '/bootstap.php';

use App\Controller\FrontendController\NotFoundControll;
use App\Core\View;
use App\Service\Container;
use App\Service\ControllerProvider;
use App\Service\DependencyProvider;



$className = NotFoundControll::class;
$providerCon = new ControllerProvider();
$container = new Container();
$dependencyProvider = new DependencyProvider();
$dependencyProvider->providerDependency($container);
$view = $container->get(View::class);
$providerList = $providerCon->getList();

if (isset($_SESSION['userName'])) {
    $pageTitle = 'FrontendController\\Home';

    if (isset($_GET['page'])) {
        $pageTitle = 'FrontendController\\' . $_GET['page'];
        if(isset($_GET['backend'])) {
            $pageTitle = 'BackendController\\' . $_GET['page'];
        }
    }
}
if (!isset($_SESSION['userName'])) {
    $pageTitle = 'BackendController\\' . 'Login';
    if (isset($_GET['backend'])) {
        $pageTitle = 'BackendController\\' . $_GET['page'];
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


