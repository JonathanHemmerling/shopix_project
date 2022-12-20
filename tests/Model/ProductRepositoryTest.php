<?php

declare(strict_types=1);

namespace AppTest\Model;

use App\Model\Mapper\MainMenuMapper;
use App\Model\Mapper\ProductsMapper;
use App\Model\ProductRepository;
use App\Service\Container;
use App\Service\DependencyProvider;
use App\SQL\SqlConnection;
use PHPUnit\Framework\TestCase;

class ProductRepositoryTest extends TestCase
{
    protected function tearDown(): void
    {
        $_SESSION = [];
        $_POST = [];
        parent::tearDown();
    }

    public function testIfMainCategorysAreFound(): void
    {
        $container = $this->getContainer();
        $pdo = new \PDO('mysql:host=0.0.0.0:13306;dbname=shopix', 'TestUser', 'password');
        $repository = new ProductRepository($container->get(SqlConnection::class), $pdo, $container->get(ProductsMapper::class), $container->get(MainMenuMapper::class));

        $givenArray = $repository->getAllMainCategorys();
        $expectedArray = [];

        self::assertCount(3, $givenArray);
        self::assertIsArray($givenArray);
        self::assertNotSame($expectedArray, $givenArray, 'Expected Array should be empty');
    }

    public function testIfProductsAreFound(): void
    {
        $container = $this->getContainer();
        $pdo = new \PDO('mysql:host=0.0.0.0:13306;dbname=shopix', 'TestUser', 'password');
        $repository = new ProductRepository($container->get(SqlConnection::class), $pdo, $container->get(ProductsMapper::class), $container->get(MainMenuMapper::class));

        $givenArray = $repository->getAllProducts();
        $expectedArray = [];

        self::assertCount(10, $givenArray);
        self::assertIsArray($givenArray);
        self::assertNotSame($expectedArray, $givenArray, 'Expected Array should be empty');
    }
    public function testIfProductsAreFoundByProductId(): void
    {
        $container = $this->getContainer();
        $pdo = new \PDO('mysql:host=0.0.0.0:13306;dbname=shopix', 'TestUser', 'password');
        $repository = new ProductRepository($container->get(SqlConnection::class), $pdo, $container->get(ProductsMapper::class), $container->get(MainMenuMapper::class));

        $givenObject = $repository->getProductByProductId(2);
        $expectedArray = [];

        self::assertIsNotArray($givenObject);
        self::assertIsObject($givenObject);
        self::assertNotSame($expectedArray, $givenObject, 'Expected Array should be empty');
    }

    /*public function testIfDeleteQueryWillWork()
    {
        
    }*/

    private function getContainer(): Container
    {
        $container = new Container();
        $dependencyProvider = new DependencyProvider();
        $dependencyProvider->providerDependency($container);
        return $container;
    }
}
