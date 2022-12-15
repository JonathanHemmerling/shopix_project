<?php

declare(strict_types=1);

namespace AppTest\Model\Repo;

use App\Controller\FrontendController\HomeControll;
use App\Core\View;
use App\Model\Mapper\MainMenuMapper;
use App\Model\Mapper\ProductsMapper;
use App\Model\ProductRepository;
use App\Service\Container;
use App\Service\DependencyProvider;
use App\SQL\SqlConnection;
use PDO;
use PHPUnit\Framework\TestCase;

class ProductRepositoryTest extends TestCase
{
    private Container $container;
    private SqlConnection $sql;
    private PDO $pdo;
    private ProductRepository $repo;
    private MainMenuMapper $mainMapper;

    public function setUp():void
    {
        $this->container = $this->getContainer();
        $this->sql = new SqlConnection();
        $this->pdo = new PDO("mysql:host=0.0.0.0;dbname=shopix;port=13306", 'TestUser', 'password');
        /** @var View $view */
        $dto = ['mainId' => 1, 'mainName' => 'jeans', 'displayName' => 'Jeans'];
        $mainMapper = $this->createMock(MainMenuMapper::class)->method('mapToMainDto')->with($dto);

        parent::setUp();
    }

    public function tearDown():void
    {
        unset($this->container, $this->sql, $this->pdo, $this->repo);
        parent::tearDown();
    }

    public function testDatabaseConnection()
    {
        self::assertIsObject($this->pdo);
    }
    public function testGetAllCategorysFromDB()
    {
        $dto = $this->repo->getAllMainCategorys();
        $expected = [];

        self::assertNotSame($expected, $dto);
    }

    public function testGetMainCaegorysByIdFromDatabase()
    {
        $dto = $this->repo->getMainCategorysByIdFromDatabase(2);
        $expected = [];

        self::assertNotSame($expected, $dto);
    }

    public function testGetAllProductsFromDatabase()
    {
        $dto = $this->repo->getAllProducts();
        $expected = [];

        self::assertNotSame($expected, $dto);
    }

    public function testGetProductByMainIdFromDatabase()
    {
        $dto = $this->repo->getAllMainCategorys();
        $expected = [];

        self::assertNotSame($expected, $dto);
    }

    public function testGetProductByProductIdFromDatabase()
    {
        $dto = $this->repo->getAllMainCategorys();
        $expected = [];

        self::assertNotSame($expected, $dto);
    }

    public function testGetProductByProductNameFromDatabase()
    {
        $dto = $this->repo->getAllMainCategorys();
        $expected = [];

        self::assertNotSame($expected, $dto);
    }

    public function testEditProductByName()
    {
        $dto = $this->repo->getAllMainCategorys();
        $expected = [];

        self::assertNotSame($expected, $dto);
    }

    public function testDeleteProductById()
    {
        $dto = $this->repo->getAllMainCategorys();
        $expected = [];

        self::assertNotSame($expected, $dto);
    }

    public function testCreateNewProduct()
    {
        $dto = $this->repo->getAllMainCategorys();
        $expected = [];

        self::assertNotSame($expected, $dto);
    }

    private function getContainer(): Container
    {
        $container = new Container();
        $dependencyProvider = new DependencyProvider();
        $dependencyProvider->providerDependency($container);
        return $container;
    }
}
