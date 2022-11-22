<?php

declare(strict_types=1);


require __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/showErrorsInBrowser.php';
require_once(__DIR__ . '/src/functions/authFunctions.php');

use App\Controller\ControllerInterface;
use App\Controller\FrontendController\NotFoundControll;
use App\Controller\Session;
use App\Core\View;
use App\Service\ControllerProvider;


ob_start();
session_start();
$smarty = new Smarty();
$view = new View($smarty);
$className = NotFoundControll::class;
$providerCon = new ControllerProvider();
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
    if (isset($_GET['pageb'])) {
        $pageTitle = 'BackendController\\' . $_GET['pageb'];;
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
$controller = new $className($view);
$controller->renderView();
$view->renderTemplate();