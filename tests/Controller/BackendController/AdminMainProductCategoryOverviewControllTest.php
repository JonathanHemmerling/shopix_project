<?php

declare(strict_types=1);

namespace AppTest\Controller\BackendController;

use App\Controller\BackendController\AdminMainProductCategoryOverviewControll;
use App\Core\View;
use App\Model\ProductRepository;
use App\Service\Container;
use App\Service\DependencyProvider;
use PHPUnit\Framework\TestCase;

class AdminMainProductCategoryOverviewControllTest extends TestCase
{
    public function testIfArrayIsSetUp(): void
    {
        $container = $this->getContainer();
        /** @var View $view */
        $categoryDataControll = new AdminMainProductCategoryOverviewControll(
            $view = $container->get(View::class),
            $container->get(ProductRepository::class)
        );
        $paramsThatShouldBeInArray = ['mainCategory' => [1 => 'Jeans', 2 => 'Sweatshirts', 3 => 'T-Shirts']];

        $categoryDataControll->renderView();
        $params = $view->getParams();
        $template = $view->getTemplate();


        self::assertSame($paramsThatShouldBeInArray, $params);
        self::assertCount(1, $params);
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