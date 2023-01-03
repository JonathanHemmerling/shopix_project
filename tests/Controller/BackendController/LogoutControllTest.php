<?php

declare(strict_types=1);

namespace AppTest\Controller\BackendController;

use App\Controller\BackendController\LogoutControll;
use App\Core\Session;
use App\Core\View;
use App\Service\Container;
use App\Service\DependencyProvider;
use PHPUnit\Framework\TestCase;

class LogoutControllTest extends TestCase
{
    protected function tearDown(): void
    {
        $_SESSION = [];
        parent::tearDown();
    }

    public function testIfUserIsLoggedOut(): void
    {
        $_SESSION['lastLogin'] = time();
        $_SESSION['userName'] = 'test';
        $container = $this->getContainer();
        $logout = new LogoutControll($view = $container->get(View::class), $container->get(Session::class));

        $logout->renderView();
        $template = $view->getTemplate();
        $params = $view->getParams();
        $userIsUnset = isset($_SESSION['userName']);

        self::assertSame('login.tpl', $template);
        self::assertSame(['message' => [0 => 'Logout successful!']], $params);
        self::assertNotTrue($userIsUnset);
    }

    private function getContainer(): Container
    {
        $container = new Container();
        $dependencyProvider = new DependencyProvider();
        $dependencyProvider->providerDependency($container);
        return $container;
    }


}