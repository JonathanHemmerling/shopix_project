<?php

declare(strict_types=1);

namespace AppTest\Controller\FrontendController;

use App\Controller\FrontendController\HomeControll;
use App\Core\View;
use App\Model\Mapper\MainMenuMapper;
use App\Model\ProductRepository;
use App\Service\Container;
use App\Service\DependencyProvider;
use PHPUnit\Framework\TestCase;

class HomeControllTest extends TestCase
{

    public function testIfMainCategorysAreLoadedAndDisplayed(): void
    {
        $container = $this->getContainer();
        $dto = ['mainId' => 1, 'mainName' => 'jeans', 'displayName' => 'Jeans'];
        $mapper = new MainMenuMapper();
        $dtoArray [] = $mapper->mapToMainDto($dto);
        $mockRepository = $this->createMock(ProductRepository::class);
        $mockRepository->method('getAllMainCategorys')->willReturn($dtoArray);
        $mockRepository->expects($this->once())->method('getAllMainCategorys');
        $detailControll = new HomeControll($view = $container->get(View::class), $mockRepository);

        $detailControll->renderView();
        $template = $view->getTemplate();
        $params = $view->getParams();
        $paramsThatShouldBeInArray = ['menu' => ['<a href="index.php?page=UserProductCategoryOverview&mainId=1">Jeans</a>']];

        self::assertSame('home.tpl', $template);
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