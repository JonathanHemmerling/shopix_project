<?php

declare(strict_types=1);

namespace AppTest\Controller\BackendController;

use App\Controller\BackendController\AdminLoginControll;
use App\Controller\BackendController\AdminLogoutControll;
use App\Core\RedirectInterface;
use App\Core\Session;
use App\Core\View;
use App\Model\LoginRepository;
use App\Service\Container;
use App\Service\DependencyProvider;
use App\Validation\UserDataValidation;
use PHPUnit\Framework\TestCase;

class AdminLogoutControllTest extends TestCase
{
    protected function tearDown(): void
    {
        $_SESSION = [];
        $_POST = [];
        parent::tearDown();
    }

    public function testIfTemplateIsSetUpAndUserIsLoggedOut()
    {
        $_SESSION['adminName'] = 'admin';
        $container = $this->getContainer();
        $view = $container->get(View::class);

        $adminControll = new AdminLogoutControll(
            $view,
            $container->get(Session::class)
        );

        $adminControll->renderView();
        $template = $view->getTemplate();
        $params = $view->getParams();
        $adminIsUnset = isset($_SESSION['adminName']);


        self::assertSame(['errors' => ['Logout successful!']], $params);
        self::assertSame('adminLogin.tpl', $template);
        self::assertNotTrue($adminIsUnset);
    }


    private function getContainer(): Container
    {
        $container = new Container();
        $dependencyProvider = new DependencyProvider();
        $dependencyProvider->providerDependency($container);
        return $container;
    }
}
