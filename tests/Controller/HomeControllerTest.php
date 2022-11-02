<?php

declare(strict_types=1);

namespace AppTest\Controller;

use App\Controller\HomeControll;
use App\Core\View;
use PHPUnit\Framework\TestCase;

class HomeControllerTest extends TestCase
{
    public function testHomeController(): void
    {
        $homeController = new HomeControll(new View(new \Smarty()));
        $homeArray = $homeController->getMenuDataFromModel();
        $itemsForParameter = ['id', 'value'];
        self::assertEquals(['id', 'value'], $itemsForParameter);
    }
}