<?php

declare(strict_types=1);

namespace AppTest\FrontendController;

use App\Controller\FrontendController\HomeControll;
use App\Controller\FrontendController\NotFoundControll;
use App\Core\View;
use App\Model\Mapper\MainMenuMapper;
use App\Model\ProductRepository;
use App\Service\Container;
use App\Service\DependencyProvider;
use PHPUnit\Framework\TestCase;

class NotFoundControllTest extends TestCase
{
    protected function tearDown(): void
    {
        $_SESSION = [];
        $_POST = [];
        parent::tearDown();
    }

    public function testIfArrayIsLoaded(): void
    {
        $container = $this->getContainer();
        /** @var View $view */
        $view = $container->get(View::class);

        $notFoundControll = new NotFoundControll($view);
        $notFoundControll->renderView();
        $params = $view->getParams();
        $templates = $view->getTemplate();

        self::assertCount(1, $params);
        self::assertIsArray($params);
        self::assertSame('notFound.tpl' ,$templates);


    }

    private function getContainer(): Container
    {
        $container = new Container();
        $dependencyProvider = new DependencyProvider();
        $dependencyProvider->providerDependency($container);
        return $container;
    }
}