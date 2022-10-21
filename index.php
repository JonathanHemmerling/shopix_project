<?php

declare(strict_types=1);
require __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/showErrorsInBrowser.php';

use App\Service\ControllerProvider;

$controllerProvider = new ControllerProvider();
$controllerString = $controllerProvider->getStringOfClass();
new $controllerString;





