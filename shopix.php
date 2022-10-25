<?php

declare(strict_types=1);
require __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/showErrorsInBrowser.php';

use \App\Service\ControllerProvider;

$provCon = new ControllerProvider();
$pageTitle = $_GET['page'];
$name = $provCon->getClassByString($pageTitle);
new $name;

