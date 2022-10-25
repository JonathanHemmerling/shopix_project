<?php

declare(strict_types=1);
require __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/showErrorsInBrowser.php';
use \App\Service\ControllerProvider;

$pageTitle = 'Home';

if(isset($_GET['page'])) {
    $pageTitle = $_GET['page'];
}

$className = \App\Controller\NotFoundControll::class;

$provCon = new ControllerProvider();
$provList = $provCon->getList();
foreach ($provList as $provElement){
    if($provElement === 'App\Controller\\' . $pageTitle . 'Controll'){
        $className = $provElement;
    }
}
new $className;
