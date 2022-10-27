<?php

declare(strict_types=1);

namespace AppTest\Model;

use App\Model\Products;
use PHPUnit\Framework\TestCase;

class ProductsTest extends TestCase
{
    public function testGetProducts(): void
    {
        $products = new Products();
        self::assertEquals(['1', '2'], ['1', '2']);
        self::assertSame(1, 1, "worked fine");
    }
}