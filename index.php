<?php

declare(strict_types=1);
require __DIR__ . '/vendor/autoload.php';
require_once 'showErrorsInBrowser.php';

use App\Controller;

    new Controller\HomeControll();
    new Controller\ListControll();
    new Controller\DetailControll();




