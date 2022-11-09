<?php

declare(strict_types=1);
require __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/showErrorsInBrowser.php';

use App\Core\View;
use App\Model\ProductRepository;
use \App\Service\ControllerProvider;
use \App\Controller\NotFoundControll;
use \App\Controller\ControllerInterface;

$smarty = new Smarty();
$view = new View($smarty);
$className = NotFoundControll::class;


$pageTitle = 'Home';

if (isset($_GET['page'])) {
    $pageTitle = $_GET['page'];
}

$providerCon = new ControllerProvider();
$providerList = $providerCon->getList();
foreach ($providerList as $providerElement) {
    if ($providerElement === 'App\Controller\\' . $pageTitle . 'Controll') {
        $className = $providerElement;
        break;
    }
}

/** @var ControllerInterface $controller */
$model = new ProductRepository($pageTitle);
$controller = new $className($view, $model);
$controller->renderView();
$view->renderTemplate();