<?php

declare(strict_types=1);

namespace AppTest\Controller;

use App\Controller\DetailControll;
use App\Controller\HomeControll;
use App\Controller\ListControll;
use PHPUnit\Framework\TestCase;

class ControllerTest extends TestCase
{
    public function testDetailController(): void
    {
        $detailController = new DetailControll();
        $itemsForProduct = ['id', 'value'];
        $detailController->itemsForProductToDisplay = ['id', 'value'];
        self::assertEquals(['id', 'value'], $itemsForProduct);
    }

    public function testHomeController(): void
    {
        $detailController = new HomeControll();
        $itemsForParameter = ['id', 'value'];
        $detailController->addParameterToView = ['id', 'value'];
        self::assertEquals(['id', 'value'], $itemsForParameter);
    }

    public function testListController(): void
    {
        $detailController = new ListControll();
        $itemsForCategory = ['id', 'value'];
        $detailController->addCategoryParameterToView = ['id', 'value'];
        self::assertEquals(['id', 'value'], $itemsForCategory);
    }
}