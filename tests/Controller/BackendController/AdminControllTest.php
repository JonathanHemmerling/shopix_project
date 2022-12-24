<?php

declare(strict_types=1);

namespace AppTest\Controller\BackendController;

use App\Controller\BackendController\AdminControll;
use App\Core\View;
use App\Service\Container;
use App\Service\DependencyProvider;
use PHPUnit\Framework\TestCase;

class AdminControllTest extends TestCase
{
    protected function tearDown(): void
    {
        $_SESSION = [];
        $_POST = [];
        parent::tearDown();
    }
    public function testIfTemplateIsSetUp(): void
    {
        $container = $this->getContainer();
        $adminControll = new AdminControll($view = $container->get(View::class));

        $adminControll->renderView();
        $template = $view->getTemplate();

        self::assertSame('admin.tpl' ,$template);
    }


    private function getContainer(): Container
    {
        $container = new Container();
        $dependencyProvider = new DependencyProvider();
        $dependencyProvider->providerDependency($container);
        return $container;
    }
}
