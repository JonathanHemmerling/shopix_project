<?php

declare(strict_types=1);

namespace AppTest\FrontendController;

use App\Controller\FrontendController\HomeControll;
use App\Core\View;
use App\Model\Mapper\MainMenuMapper;
use App\Model\ProductRepository;
use App\Service\Container;
use App\Service\DependencyProvider;
use PHPUnit\Framework\TestCase;

class HomeControllTest extends TestCase
{
    protected function tearDown(): void
    {
        $_SESSION = [];
        $_POST = [];
        parent::tearDown();
    }

    public function testIfMainCategorysAreLoadedAndDisplayed()
    {
        $container = $this->getContainer();
        /** @var View $view */
        $view = $container->get(View::class);

        $dto = ['mainId' => 1, 'mainName' => 'jeans', 'displayName' => 'Jeans'];
        $mapper = new MainMenuMapper();
        $dtoArray [] = $mapper->mapToMainDto($dto);
        $mockRepository = $this->createMock(ProductRepository::class);
        $mockRepository->method('getAllMainCategorys')->willReturn($dtoArray);
        $mockRepository->expects($this->once())->method('getAllMainCategorys');

        $detailControll = new HomeControll($view, $mockRepository);

        $detailControll->renderView();
        $template = $view->getTemplate();
        $params = $view->getParams();

        self::assertSame('home.tpl', $template);
        self::assertIsArray($params);
        self::assertSame(
            [
                'menu' => [
                    '<a href="index.php?page=List&mainId=1&mainName=jeans">Jeans</a>',
                ],
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