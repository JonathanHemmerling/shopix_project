<?php

declare(strict_types=1);
require __DIR__ . '/vendor/autoload.php';
require_once 'showErrorsInBrowser.php';

use App\Controller;


if (!isset($_GET['page'])) {
    new Controller\HomeControll();
} elseif (isset($_GET['productId'])) {
    new Controller\ListControll();
} elseif (isset($_GET['id'])) {
    new Controller\DetailControll();
}



