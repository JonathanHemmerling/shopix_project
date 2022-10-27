<?php

declare(strict_types=1);
require __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/showErrorsInBrowser.php';
use \App\Service\ControllerProvider;
use \App\Controller\NotFoundControll;
use \App\Model\ProductRepository;

$pageTitle = 'Home';

if(isset($_GET['page'])) {
    $pageTitle = $_GET['page'];
}

$className = NotFoundControll::class;

$providerCon = new ControllerProvider();
$providerList = $providerCon->getList();
foreach ($providerList as $providerElement){
    if($providerElement === 'App\Controller\\' . $pageTitle . 'Controll'){
        $className = $providerElement;
    }
}
new $className;
