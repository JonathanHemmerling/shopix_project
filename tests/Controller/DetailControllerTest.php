<?php

declare(strict_types=1);

namespace AppTest\Controller;

use App\Controller\DetailControll;

use PHPUnit\Framework\TestCase;

class DetailControllerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->detailController = new DetailControll();
    }

    public function testItGetsDataFromModel(): void
    {
        $itemsForProduct = ['id', 'value'];
        self::assertEquals(['id', 'value'], $this->detailController->getProductDataFromModel());
    }
}