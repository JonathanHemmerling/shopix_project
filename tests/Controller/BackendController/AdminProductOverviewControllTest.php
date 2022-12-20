<?php

declare(strict_types=1);

namespace AppTest\Controller\BackendController;

use App\Controller\BackendController\AdminProductOverviewControll;
use App\Core\View;
use App\Model\ProductRepository;
use App\Service\Container;
use App\Service\DependencyProvider;
use PHPUnit\Framework\TestCase;

class AdminProductOverviewControllTest extends TestCase
{
    protected function tearDown(): void
    {
        $_SESSION = [];
        $_POST = [];
        parent::tearDown();
    }

    public function testIfArrayIsSetUp(): void
    {
        $_GET['mainId'] = '1';
        $_GET['productId'] = '1';
        $_POST['submit'] = true;
        $container = $this->getContainer();
        /** @var View $view */
        $view = $container->get(View::class);
        $productRepo = $container->get(ProductRepository::class);
        $productProductOverviewControll = new AdminProductOverviewControll($view, $productRepo);

        $productProductOverviewControll->renderView();
        $params = $view->getParams();
        $template = $view->getTemplate();
        $expectedArray = array('products' => [2 => 'Jeans 2', 3 => 'Jeans 3', 12 => 'Jeans 4']);

        self::assertSame($expectedArray, $params);
        self::assertIsArray($params);
        self::assertCount(1, $params);
        self::assertSame('productOverviewAdmin.tpl',$template);
    }
    public function testIfProductsCanBeDeleted(): void
    {
        $_GET['mainId'] = '1';
        $_GET['productId'] = '1';
        $_POST['submit'] = true;
        $container = $this->getContainer();
        /** @var View $view */
        $view = $container->get(View::class);
        $mockProductRepository = $this->createMock(ProductRepository::class);
        $mockProductRepository->expects($this->once())->method('deleteProductById');
        $mockProductRepository->expects($this->once())->method('getProductByMainId');
        $mockProductRepository->method('getProductByMainId')->with(1);
        $productProductOverviewControll = new AdminProductOverviewControll($view, $mockProductRepository);

        $productProductOverviewControll->renderView();
    }

    private function getContainer(): Container
    {
        $container = new Container();
        $dependencyProvider = new DependencyProvider();
        $dependencyProvider->providerDependency($container);
        return $container;
    }
}
