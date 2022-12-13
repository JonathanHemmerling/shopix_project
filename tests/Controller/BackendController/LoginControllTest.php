<?php

declare(strict_types=1);

namespace AppTest\Controller\BackendController;

use App\Controller\BackendController\LoginControll;
use App\Core\RedirectInterface;
use App\Core\Session;
use App\Core\View;
use App\Model\LoginRepository;
use App\Model\UserRepository;
use App\Service\Container;
use App\Service\DependencyProvider;
use App\SQL\SqlConnection;
use App\Validation\UserDataValidation;
use PHPUnit\Framework\TestCase;


class LoginControllTest extends TestCase
{
    protected function tearDown(): void
    {
        $_SESSION = [];
        $_POST = [];
        parent::tearDown();
    }

    public function testIsUserLoggedIn()
    {
        $_POST['submit'] = true;
        $_POST['userName'] = 'UserTest123';
        $_POST['password'] = 'password';

        $container = $this->getContainer();
        /** @var View $view */
        $view = $container->get(View::class);

        $mockRedirect = $this->createMock(RedirectInterface::class);
        $mockRedirect->expects($this->once())->method('to');
        $mockSession = $this->createMock(Session::class);
        $mockSession->expects($this->once())->method('loginUser');

        $login = new LoginControll(
            $view,
            $container->get(LoginRepository::class),
            $container->get(UserDataValidation::class),
            $mockSession,
            $mockRedirect,
        );

        $login->renderView();

        $params = $view->getParams();
        }


    private function getContainer(): Container
    {
        $container = new Container();
        $dependencyProvider = new DependencyProvider();
        $dependencyProvider->providerDependency($container);
        return $container;
    }
}