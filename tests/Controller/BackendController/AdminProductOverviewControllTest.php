<?php

declare(strict_types=1);

namespace AppTest\Controller\BackendController;

use App\Controller\BackendController\AdminProductOverviewControll;
use App\Core\View;
use App\Model\Dto\ProductsDataTransferObject;
use App\Model\ProductRepository;
use App\Service\Container;
use App\Service\DependencyProvider;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class AdminProductOverviewControllTest extends TestCase
{
    private MockObject $mockProductRepository;
    private AdminProductOverviewControll $productOverviewControll;
    private View $view;
    protected function setUp(): void
    {
        $_GET['mainId'] = '1';
        $_GET['productId'] = '12';
        $container = $this->getContainer();
        /** @var View $view */
        $this->view = $container->get(View::class);
        $this->mockProductRepository = $this->createMock(ProductRepository::class);
        $this->productOverviewControll = new AdminProductOverviewControll($this->view, $this->mockProductRepository);
        parent::setUp();
    }

    protected function tearDown(): void
    {
        $_GET = [];
        $_POST = [];
        parent::tearDown();
    }

    public function testIfArrayIsSetUp(): void
    {
        $this->mockProductRepository->expects($this->once())->method('getProductByMainId')->with(1)->willReturn([new ProductsDataTransferObject(12, 1, 'Jeans 4', 'jeans4', 'Fourth Jeans', '29,99')]);
        $expectedArray = array('productDataSet' => [12 => 'Jeans 4']);

        $this->productOverviewControll->renderView();
        $params = $this->view->getParams();
        $template = $this->view->getTemplate();

        self::assertSame($expectedArray, $params);
        self::assertCount(1, $params);
        self::assertSame('productOverviewAdmin.tpl',$template);
    }
    public function testIfProductsCanBeDeleted(): void
    {
        $_POST['submit'] = true;
        $this->mockProductRepository->expects($this->once())->method('deleteProductById');
        $this->productOverviewControll->renderView();
    }

    private function getContainer(): Container
    {
        $container = new Container();
        $dependencyProvider = new DependencyProvider();
        $dependencyProvider->providerDependency($container);
        return $container;
    }
}
