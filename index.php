<?php

declare(strict_types=1);
require __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/functions/initialize.php';
require_once __DIR__ . '/showErrorsInBrowser.php';

use App\Core\View;
use \App\Service\ControllerProvider;
use \App\FrontendController\NotFoundControll;
use \App\FrontendController\ControllerInterface;


$smarty = new Smarty();
$view = new View($smarty);
$className = NotFoundControll::class;
$errors = [];
$providerCon = new ControllerProvider();
$providerList = $providerCon->getList();


if (isLoggedIn()) {
    $pageTitle = 'Home';
    if (isset($_GET['page'])) {
        $pageTitle = $_GET['page'];
    }
    foreach ($providerList as $providerElement) {
        if ($providerElement === 'App\FrontendController\\' . $pageTitle . 'Controll') {
            $className = $providerElement;
            break;
        }
    }
}
if (!isLoggedIn()) {
    if (isset($_GET['newUser'])) {
        $pageTitle = 'NewUser';
        $className = 'App\BackendController\\' . $pageTitle . 'Controll';
    }
    if (!isset($_GET['newUser'])) {
        $pageTitle = 'Login';
        $className = 'App\BackendController\\' . $pageTitle . 'Controll';
    }
}

/** @var ControllerInterface $controller */
$controller = new $className($view);
$controller->renderView();
$view->renderTemplate();