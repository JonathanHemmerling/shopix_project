<?php

declare(strict_types=1);

namespace AppTest\Controller\BackendController;

use App\Controller\BackendController\AdminProductSingleRecordControll;
use App\Core\View;
use App\Model\Dto\ProductsDataTransferObject;
use App\Model\ProductRepository;
use App\Service\Container;
use App\Service\DependencyProvider;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;


class AdminProductSingleRecordControllTest extends TestCase
{
    private View $view;
    private MockObject $mockRepository;
    private AdminProductSingleRecordControll $productSingleRecordControll;
    protected function setUp(): void
    {
        $container = $this->getContainer();
        $this->mockRepository = $this->createMock(ProductRepository::class);
        $this->productSingleRecordControll = new AdminProductSingleRecordControll($this->view = $container->get(View::class), $this->mockRepository);
        parent::setUp();
    }

    protected function tearDown(): void
    {
        unset($this->mockRepository, $this->productSingleRecordControll);
        $_SESSION = [];
        $_POST = [];
        parent::tearDown();
    }

    public function testIfProductIsEdited(): void
    {
        $_GET['productId'] = '1';
        $_POST['submit'] = true;
        $_POST['displayName'] = 'ok';
        $_POST['productDescription'] = 'ok';
        $_POST['price'] = '0';
        $productDTO = new ProductsDataTransferObject(1, 1, 'test', 'test', 'Test', '1');
        $this->mockRepository->expects($this->atLeastOnce())->method('getProductByProductId')->with(1)->willReturn($productDTO);
        $this->mockRepository->expects($this->exactly(3))->method('editProductById');
        $this->productSingleRecordControll->renderView();
    }
    public function testIfArrayIsSetUp(): void
    {
        $_GET['productId'] = '1';
        $productDTO = new ProductsDataTransferObject(1, 1, 'test', 'test', 'Test', '1');
        $this->mockRepository->expects($this->once())->method('getProductByProductId')->with(1)->willReturn($productDTO);
        $paramsThatShouldBeInArray = ['productName' => ['displayName' => 'test', 'productDescription' => 'Test', 'price' => '1']];
        $this->productSingleRecordControll->renderView();
        $params = $this->view->getParams();
        $template = $this->view->getTemplate();

        self::assertCount(1, $params);
        self::assertSame('productSingleRecordAdmin.tpl', $template);
        self::assertSame($paramsThatShouldBeInArray, $params);
    }

    private function getContainer(): Container
    {
        $container = new Container();
        $dependencyProvider = new DependencyProvider();
        $dependencyProvider->providerDependency($container);
        return $container;
    }
}
