<?php

declare(strict_types=1);

namespace AppTest\Controller\FrontendController;

use App\Controller\FrontendController\UserProductCategoryOverviewControll;
use App\Core\View;
use App\Model\Mapper\ProductsMapper;
use App\Model\ProductRepository;
use App\Service\Container;
use App\Service\DependencyProvider;
use PHPUnit\Framework\TestCase;

class UserProductCategoryOverViewControllTest extends TestCase
{
    protected function tearDown(): void
    {
        $_SESSION = [];
        $_POST = [];
        parent::tearDown();
    }

    public function testIfMainCategorysAreLoadedAndDisplayed(): void
    {
        $_GET['mainId'] = '1';
        $container = $this->getContainer();
        $dto = [
            'productId' => 1,
            'mainId' => 1,
            'displayName' => 'Jeans 1',
            'productName' => 'jeans1',
            'description' => 'First Jeans',
            'price' => '28,99',
        ];
        $mapper = new ProductsMapper();
        $dtoArray [] = $mapper->mapToProductsDto($dto);
        $mockRepository = $this->createMock(ProductRepository::class);
        $mockRepository->method('getProductByMainId')->with(1)->willReturn($dtoArray);
        $mockRepository->expects($this->atLeastOnce())->method('getProductByMainId');
        $detailControll = new UserProductCategoryOverviewControll($view = $container->get(View::class), $mockRepository);

        $detailControll->renderView();
        $template = $view->getTemplate();
        $params = $view->getParams();
        $paramsThatShouldBeInArray = ['categoryLink' => [1 => 'Jeans 1']];

       self::assertIsArray($mockRepository->getProductByMainId(1));
       self::assertIsNumeric($_GET['mainId']);
       self::assertSame('productCategoryOverview.tpl', $template);
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