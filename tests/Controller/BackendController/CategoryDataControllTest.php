<?php

declare(strict_types=1);

namespace AppTest\Controller\BackendController;

use App\Controller\BackendController\AdminMainProductCategoryOverviewControll;
use App\Core\RedirectInterface;
use App\Core\View;
use App\Model\ProductRepository;
use App\Service\Container;
use App\Service\DependencyProvider;
use PHPUnit\Framework\TestCase;

class CategoryDataControllTest extends TestCase
{
    protected function tearDown(): void
    {
        $_SESSION = [];
        $_POST = [];
        parent::tearDown();
    }

    public function testIfCorrectArrayIsSetUp()
    {
        $container = $this->getContainer();
        /** @var View $view */
        $view = $container->get(View::class);
        $mockRedirect = $this->createMock(RedirectInterface::class);
        $expectedArray = [
            'Jeans 1' => 'Jeans',
            'Jeans 2' => 'Jeans',
            'Jeans 3' => 'Jeans',
            'Jeans 4' => 'Jeans',
            'Sweatshirt 1' => 'Sweatshirts',
            'Sweatshirt 2' => 'Sweatshirts',
            'Sweatshirt 3' => 'Sweatshirts',
            'Sweatshirt 4' => 'Sweatshirts',
            'T-Shirt 1' => 'T-Shirts',
            'T-Shirt 2' => 'T-Shirts',
            'T-Shirt 3' => 'T-Shirts',
        ];
        $categoryDataControll = new AdminMainProductCategoryOverviewControll($view, $container->get(ProductRepository::class), $mockRedirect);
        $categoryDataControll->renderView();
        $params = $view->getParams();
        $template = $view->getTemplate();
        self::assertIsArray($params);
        self::assertSame($expectedArray, $params['main']);
        self::assertCount(2, $params);
        self::assertSame('productMainCategoryOverviewAdmin.tpl', $template);

    }

    private function getContainer(): Container
    {
        $container = new Container();
        $dependencyProvider = new DependencyProvider();
        $dependencyProvider->providerDependency($container);
        return $container;
    }
}