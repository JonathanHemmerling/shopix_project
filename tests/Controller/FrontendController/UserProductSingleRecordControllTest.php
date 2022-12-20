<?php

declare(strict_types=1);

namespace AppTest\Controller\FrontendController;

use App\Controller\FrontendController\UserProductSingleRecordControll;
use App\Core\View;
use App\Model\Dto\ProductsDataTransferObject;
use App\Model\ProductRepository;
use App\Service\Container;
use App\Service\DependencyProvider;
use PHPUnit\Framework\TestCase;


class UserProductSingleRecordControllTest extends TestCase
{

    protected function tearDown(): void
    {
        $_SESSION = [];
        $_POST = [];
        parent::tearDown();
    }

    public function testIfProductsAreLoadedAndDisplayed(): void
    {
        $_GET['productId'] = '1';
        $container = $this->getContainer();
        /** @var View $view */
        $view = $container->get(View::class);
        $dto = new ProductsDataTransferObject(
            1, 1, 'Jeans 1', 'jeans1', 'The first Jeans', '29,99'
        );
        $mockRepository = $this->createMock(ProductRepository::class);
        $mockRepository->method('getProductByProductId')->with(1)->willReturn($dto);
        $mockRepository->expects($this->once())->method('getProductByProductId');

        $detailControll = new UserProductSingleRecordControll($view, $mockRepository);

        $detailControll->renderView();
        $template = $view->getTemplate();
        $params = $view->getParams();

        self::assertSame('productSingleRecord.tpl', $template);
        self::assertIsArray($params);
        self::assertSame(
            [
                'productName' => [0 => 'Jeans 1:'],
                'productDescription' => [0 => 'The first Jeans'],
                'price' => [0 => '29,99'],
            ],
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