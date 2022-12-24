<?php

declare(strict_types=1);

namespace AppTest\Controller\BackendController;

use App\Controller\BackendController\AdminLoginControll;
use App\Core\RedirectInterface;
use App\Core\Session;
use App\Core\View;
use App\Model\LoginRepository;
use App\Service\Container;
use App\Service\DependencyProvider;
use App\Validation\UserDataValidation;
use PHPUnit\Framework\TestCase;

class AdminLoginControllTest extends TestCase
{
    protected function tearDown(): void
    {
        $_SESSION = [];
        $_POST = [];
        parent::tearDown();
    }

    public function testIfTemplateIsSetUp(): void
    {
        $_POST['submit'] = true;
        $_POST['adminName'] = 'admin';
        $_POST['password'] = 'adminpassword';
        $container = $this->getContainer();
        $mockRedirect = $this->createMock(RedirectInterface::class);
        $mockRedirect->expects($this->once())->method('to');
        $mockSession = $this->createMock(Session::class);
        $mockSession->expects($this->once())->method('loginAdmin');
        $adminControll = new AdminLoginControll($view = $container->get(View::class), $container->get(LoginRepository::class), $container->get(UserDataValidation::class), $mockSession, $mockRedirect);

        $adminControll->renderView();
        $template = $view->getTemplate();
        $params = $view->getParams();

        self::assertSame(['errors' => []], $params);
        self::assertSame('adminLogin.tpl', $template);
    }

    private function getContainer(): Container
    {
        $container = new Container();
        $dependencyProvider = new DependencyProvider();
        $dependencyProvider->providerDependency($container);
        return $container;
    }
}
