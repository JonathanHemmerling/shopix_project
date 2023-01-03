<?php

declare(strict_types=1);

namespace AppTest\Controller\BackendController;

use App\Controller\BackendController\CreateProductControll;
use App\Core\View;
use App\Model\Dto\ProductsDataTransferObject;
use App\Model\ProductRepository;
use App\Service\Container;
use App\Service\DependencyProvider;
use PHPUnit\Framework\TestCase;

class CreateProductControllTest extends TestCase
{

    protected function setUp(): void
    {
        $_GET['mainId'] = '1';
        $_POST['submit'] = true;
        $_POST['displayName'] = 'test';
        $_POST['productName'] = 'test';
        $_POST['description'] = 'test';
        $_POST['price'] = '1';
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
        $container = $this->getContainer();
        $mockRepository = $this->createMock(ProductRepository::class);
        $mockRepository->expects($this->once())->method('createNewProduct')->with(1,'test', 'test', 'test','1');
        $productSingleRecordControll = new CreateProductControll($view = $container->get(View::class), $mockRepository);
        $paramsThatShouldBeInArray = ['mainId'=> [0 => 1]];

        $productSingleRecordControll->renderView();
        $params = $view->getParams();
        $template = $view->getTemplate();

        self::assertSame($paramsThatShouldBeInArray, $params);
        self::assertCount(1, $params);
        self::assertSame('createProduct.tpl', $template);
    }

    private function getContainer(): Container
    {
        $container = new Container();
        $dependencyProvider = new DependencyProvider();
        $dependencyProvider->providerDependency($container);
        return $container;
    }
}
