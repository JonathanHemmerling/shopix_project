<?php

declare(strict_types=1);
require __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/showErrorsInBrowser.php';

use App\Core\View;
use \App\Service\ControllerProvider;
use \App\Controller\NotFoundControll;

$pageTitle = 'Home';

if (isset($_GET['page'])) {
    $pageTitle = $_GET['page'];
}

$className = NotFoundControll::class;

$providerCon = new ControllerProvider();
$providerList = $providerCon->getList();
foreach ($providerList as $providerElement) {
    if ($providerElement === 'App\Controller\\' . $pageTitle . 'Controll') {
        $className = $providerElement;
        break;
    }
}
/** @var \App\Interfaces\ControllerInterface $controller */
$controller = new $className(new View(), $_GET);
$controller->renderView();
