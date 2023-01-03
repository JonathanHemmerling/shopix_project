<?php

declare(strict_types=1);

namespace AppTest\FrontendController;

use App\Controller\FrontendController\NotFoundControll;
use App\Core\View;
use App\Service\Container;
use App\Service\DependencyProvider;
use PHPUnit\Framework\TestCase;

class NotFoundControllTest extends TestCase
{
    public function testIfArrayIsLoaded(): void
    {
        $container = $this->getContainer();
        $notFoundControll = new NotFoundControll($view = $container->get(View::class));

        $notFoundControll->renderView();
        $params = $view->getParams();
        $templates = $view->getTemplate();

        self::assertCount(1, $params);
        self::assertSame('notFound.tpl', $templates);
    }

    private function getContainer(): Container
    {
        $container = new Container();
        $dependencyProvider = new DependencyProvider();
        $dependencyProvider->providerDependency($container);
        return $container;
    }
}