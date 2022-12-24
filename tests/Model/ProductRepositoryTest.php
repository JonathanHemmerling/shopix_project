<?php

declare(strict_types=1);

namespace AppTest\Model;

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
        $this->productRepository = new ProductRepository($container->get(SqlConnection::class), $pdo, $container->get(ProductsMapper::class), $container->get(MainMenuMapper::class));
        parent::setUp();
    }

    protected function tearDown(): void
    {
        unset($this->productRepository);
        $_SESSION = [];
        $_POST = [];
        parent::tearDown();
    }

    public function testIfMainCategorysAreFound(): void
    {
        $givenArray = $this->productRepository->getAllMainCategorys();
        $expectedArray = [];

        self::assertCount(4, $givenArray);
        self::assertIsArray($givenArray);
        self::assertNotSame($expectedArray, $givenArray, 'Expected Array should be empty');
    }
    public function testIfProductsAreFound(): void
    {
        $givenArray = $this->productRepository->getAllProducts();
        $size = count($givenArray);
        $expectedArray = [];

        self::assertCount($size, $givenArray);
        self::assertIsArray($givenArray);
        self::assertNotSame($expectedArray, $givenArray, 'Expected Array should be empty');
    }
    public function testIfProductsAreFoundByProductId(): void
    {
        $givenObject = $this->productRepository->getProductByProductId(8);
        $expectedArray = new ProductsDataTransferObject(8, 3,'T-Shirt 2', 't-shirt2', 'Second T-Shirt', '29,99');
        self::assertNotEquals([], $givenObject);
        self::assertEquals($expectedArray, $givenObject);
    }
    public function testIfNewProductWillBeCreatedEditedAndDeleted():void
    {
        $this->productRepository->createNewProduct(4, 'Test','test','TEST','999');
        $productArray = $this->productRepository->getAllProducts();
        $productId = 0;
        foreach ($productArray as $product){
            if($product->productName === 'test'){
                $productId = $product->productId;
            }
        }

        $createdProduct = $this->productRepository->getProductByProductId($productId);
        $this->productRepository->editProductById($productId, 'description', 'editedTEST');
        $editedProduct = $this->productRepository->getProductByProductId($productId);
        $this->productRepository->deleteProductById($productId);
        $deletedProduct = $this->productRepository->getProductByProductId($productId);

        self::assertSame($createdProduct->mainId, 4);
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
