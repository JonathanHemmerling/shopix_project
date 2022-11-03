<?php

declare(strict_types=1);

namespace AppTest\Model;

use App\Model\ProductRepository;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class ProductRepositoryTest extends TestCase
{
    public function testDataIsExtractedFromJson(): void
    {
        $productRepo = new ProductRepository();

        $categories = $productRepo->getAllDataFromJson('products');
        self::assertIsArray($categories);
        self::assertCount(9, $categories);
    }

    public function testExceptionIsThrownOnNonExistingFile(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $productRepo = new ProductRepository();

        $productRepo->getAllDataFromJson('products');
    }

    public function testExceptionIsThrownOnBrokenJson(): void
    {
        $pathToJsonFile = __DIR__ . '/data/syntactically-incorrect.json';
        $this->expectException(RuntimeException::class);
        $this->expectErrorMessage('Invalid JSON stored in file "' . $pathToJsonFile . '".');

        $productRepo = new ProductRepository();

        $productRepo->getAllDataFromJson('products');
    }
}
