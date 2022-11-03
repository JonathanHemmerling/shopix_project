<?php

declare(strict_types=1);

namespace AppTest\Model;

use App\Model\Products;
use PHPUnit\Framework\TestCase;
use RuntimeException;
use InvalidArgumentException;

class ProductsTest extends TestCase
{
    public function testGetProducts(): void
    {
        $products = new Products();
        $productCat = $products->getDataAsArray();
        self::assertIsArray($productCat);
        self::assertCount(9, $productCat);
        self::assertEquals(['1', '2'], ['1', '2']);
        self::assertSame(1, 1, "worked fine");
    }
    public function testExceptionIsThrownOnNonExistingFile(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $products = new Products(__DIR__ . '/data/non-existing.json');
        $products->getDataAsArray();
    }
    public function testExceptionIsThrownOnBrokenJson(): void
    {
        $pathToJsonFile = __DIR__ . '/data/syntactically-incorrect.json';
        $this->expectException(RuntimeException::class);
        $this->expectErrorMessage('Invalid JSON stored in file "' . $pathToJsonFile . '".');

        $products = new Products($pathToJsonFile);
        $products->getDataAsArray();
    }
}