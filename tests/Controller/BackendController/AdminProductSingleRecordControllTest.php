<?php

declare(strict_types=1);

namespace AppTest\Controller\BackendController;

use App\Controller\BackendController\AdminProductSingleRecordControll;
use App\Core\View;
use App\Model\Dto\ProductsDataTransferObject;
use App\Model\ProductRepository;
use App\Service\Container;
use App\Service\DependencyProvider;
use PHPUnit\Framework\TestCase;


class AdminProductSingleRecordControllTest extends TestCase
{
    protected function tearDown(): void
    {
        $_SESSION = [];
        $_POST = [];
        parent::tearDown();
    }

    public function testIfArrayIsSetUp(): void
    {
        $_GET['productId'] = '1';
        $container = $this->getContainer();
        /** @var View $view */
        $view = $container->get(View::class);

        $productDTO = new ProductsDataTransferObject(1, 1, 'test', 'test', 'Test', '1');
        $mockRepository = $this->createMock(ProductRepository::class);
        $mockRepository->method('getProductByProductId')->with(1)->willReturn($productDTO);
        $mockRepository->expects($this->once())->method('getProductByProductId');
        $productSingleRecordControll = new AdminProductSingleRecordControll($view, $mockRepository);

        $productSingleRecordControll->renderView();
        $params = $view->getParams();
        $template = $view->getTemplate();


        self::assertIsArray($params);
        self::assertCount(1, $params);
        self::assertSame('productSingleRecordAdmin.tpl', $template);
        self::assertSame(
            ['productName' => ['displayName' => 'test', 'productDescription' => 'Test', 'price' => '1']],
            $params
        );
    }

    private function getContainer(): Container
    {
        $container = new Container();
        $dependencyProvider = new DependencyProvider();
        $dependencyProvider->providerDependency($container);
        return $container;
    }
}
