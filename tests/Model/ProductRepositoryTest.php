<?php

declare(strict_types=1);

namespace AppTest\Model;

use App\Model\Dto\MainMenuDataTransferObject;
use App\Model\Dto\ProductsDataTransferObject;
use App\Model\Mapper\MainMenuMapper;
use App\Model\Mapper\ProductsMapper;
use App\Model\ProductRepository;
use App\Service\Container;
use App\Service\DependencyProvider;
use App\SQL\SqlConnection;
use PHPUnit\Framework\TestCase;

class ProductRepositoryTest extends TestCase
{
    private ProductRepository $productRepository;

    protected function setUp(): void
    {
        $container = $this->getContainer();
        $pdo = new \PDO('mysql:host=0.0.0.0:13306;dbname=shopix', 'TestUser', 'password');
        $this->productRepository = new ProductRepository(
            $container->get(SqlConnection::class),
            $pdo,
            $container->get(ProductsMapper::class),
            $container->get(MainMenuMapper::class)
        );
        parent::setUp();
    }

    protected function tearDown(): void
    {
        $allProducts = $this->productRepository->getAllProducts();
        foreach ($allProducts as $product) {
            if ($product->displayName === 'Test' || $product->displayName === '' || $product->displayName === 'Testtest') {
                $this->productRepository->deleteProductById($product->productId);
            }
        }
        unset($this->productRepository);
        parent::tearDown();
    }

    public function testIfMainCategorysAreFound(): void
    {
        $paramsThatDbShouldDeliver = [
            0 => new MainMenuDataTransferObject(1, 'jeans', 'Jeans'),
            1 => new MainMenuDataTransferObject(2, 'sweatshirts', 'Sweatshirts'),
            2 => new MainMenuDataTransferObject(3, 't-shirts', 'T-Shirts'),
        ];

        $dataObjectDeliveredByRepository = $this->productRepository->getAllMainCategorys();

        self::assertCount(3, $dataObjectDeliveredByRepository);
        self::assertEquals($paramsThatDbShouldDeliver, $dataObjectDeliveredByRepository);
    }

    public function testIfProductIsFoundByMainId(): void
    {
        $paramsThatDbShouldDeliver = [
            0 => new ProductsDataTransferObject(
                12,
                1,
                'Jeans 4',
                'jeans4',
                'Fourth Jeans',
                '29,99'
            ),
        ];

        $dataObjectDeliveredByRepository = $this->productRepository->getProductByMainId(1);

        self::assertEquals($paramsThatDbShouldDeliver, $dataObjectDeliveredByRepository);
    }

    public function testIfProductsAreFound(): void
    {
        $paramsThatDbShouldDeliver = [
            0 => new ProductsDataTransferObject(8, 3, 'T-Shirt 2', 't-shirt2', 'Second T-Shirt', '29,99'),
            1 => new ProductsDataTransferObject(9, 3, 'T-Shirt 3', 't-shirt3', 'Third T-Shirt', '29,99'),
            2 => new ProductsDataTransferObject(12, 1, 'Jeans 4', 'jeans4', 'Fourth Jeans', '29,99'),
            3 => new ProductsDataTransferObject(13, 2, 'Sweatshirt 4', 'sweatshirt4', 'The fourth Sweatshirt', '99,99'),
            4 => new ProductsDataTransferObject(14, 2, 'Sweatshirt 3', 'sweatshirt3', 'The third Sweatshirt', '29.99'),
            5 => new ProductsDataTransferObject(18, 2, 'Sweatshirt 2', 'sweatshirt2', 'The second Sweatshirt', '28,99'),
            6 => new ProductsDataTransferObject(19, 2, 'Sweatshirt 1', 'sweatshirt1', 'The first Sweatshirt', '19,99'),
        ];

        $dataObjectDeliveredByRepository = $this->productRepository->getAllProducts();

        self::assertCount(7, $dataObjectDeliveredByRepository);
        self::assertEquals($paramsThatDbShouldDeliver, $dataObjectDeliveredByRepository);
    }

    public function testIfProductsAreFoundByProductId(): void
    {
        $paramsThatDbShouldDeliver = new ProductsDataTransferObject(
            8,
            3,
            'T-Shirt 2',
            't-shirt2',
            'Second T-Shirt',
            '29,99'
        );

        $dataObjectDeliveredByRepository = $this->productRepository->getProductByProductId(8);

        self::assertEquals($paramsThatDbShouldDeliver, $dataObjectDeliveredByRepository);
    }

    public function testIfNewProductWillBeCreatedEditedAndDeleted(): void
    {
        $this->productRepository->createNewProduct(3, 'Test', 'test', 'TEST', '999');
        $productArray = $this->productRepository->getAllProducts();
        $productId = 0;
        foreach ($productArray as $product) {
            if ($product->productName === 'test') {
                $productId = $product->productId;
            }
        }

        $createdProduct = $this->productRepository->getProductByProductId($productId);
        $this->productRepository->editProductById($productId, 'description', 'editedTEST');
        $editedProduct = $this->productRepository->getProductByProductId($productId);
        $this->productRepository->deleteProductById($productId);
        $deletedProduct = $this->productRepository->getProductByProductId($productId);

        self::assertSame($createdProduct->mainId, 3);
        self::assertSame($createdProduct->displayName, 'Test');
        self::assertSame($createdProduct->productName, 'test');
        self::assertSame($createdProduct->description, 'TEST');
        self::assertSame($createdProduct->price, '999');
        self::assertSame($editedProduct->description, 'editedTEST');
        self::assertNull($deletedProduct);
    }

    private function getContainer(): Container
    {
        $container = new Container();
        $dependencyProvider = new DependencyProvider();
        $dependencyProvider->providerDependency($container);
        return $container;
    }
}
