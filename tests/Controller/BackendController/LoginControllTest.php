<?php

declare(strict_types=1);

namespace AppTest\Controller\BackendController;

use App\Controller\BackendController\LoginControll;
use App\Core\Redirect;
use App\Core\RedirectInterface;
use App\Core\Session;
use App\Core\SessionInterface;
use App\Core\View;
use App\Model\LoginRepository;
use App\Model\UserRepository;
use App\Service\Container;
use App\Service\DependencyProvider;
use App\SQL\SqlConnection;
use App\Validation\UserDataValidation;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;


class LoginControllTest extends TestCase
{
    private MockObject $mockSession;
    private LoginControll $login;
    protected function setUp(): void
    {
        $container = $this->getContainer();
        $validation = $container->get(UserDataValidation::class);
        $this->mockSession = $this->createMock(SessionInterface::class);
        $this->login = new LoginControll($view = $container->get(View::class), $container->get(LoginRepository::class), $validation, $this->mockSession, $container->get(Redirect::class),);
        parent::setUp();
    }

    protected function tearDown(): void
    {
        unset($this->mockSession, $this->login);
        $_SESSION = [];
        $_POST = [];
        parent::tearDown();
    }
    public function testIsAdminOrUserNotLoggedOut(): void
    {
        $_SESSION['userName'] = Null;
        $_SESSION['adminName'] = Null;
        $this->mockSession->expects($this->never())->method('logoutUser');
        $this->login->renderView();
    }

    public function testIsUserLoggedOut(): void
    {
        $_SESSION['userName'] = 'User';
        $_SESSION['adminName'] = Null;
        $this->mockSession->expects($this->once())->method('logoutUser');
        $this->login->renderView();
    }
    public function testIsAdminLoggedOut(): void
    {
        $_SESSION['userName'] = null;
        $_SESSION['adminName'] = 'Admin';
        $this->mockSession->expects($this->once())->method('logoutUser');
        $this->login->renderView();
    }

    public function testIsUserLoggedIn(): void
    {
        $_POST['submit'] = true;
        $_POST['userName'] = 'UserTest123';
        $_POST['password'] = 'password';
        $container = $this->getContainer();
        $mockRedirect = $this->createMock(RedirectInterface::class);
        $mockRedirect->expects($this->once())->method('to');
        $this->mockSession->expects($this->once())->method('loginUser');
        $login = new LoginControll($view = $container->get(View::class), $container->get(LoginRepository::class), $validation = $container->get(UserDataValidation::class), $this->mockSession, $mockRedirect);

        $login->renderView();
        $template = $view->getTemplate();
        $params = $view->getParams();
        $isUserValid = $validation->checkIfUserNameIsValid('');

        self::assertSame('login.tpl' ,$template);
        self::assertSame(['errors' => []],$params);
        self::assertFalse($isUserValid);
        }


    private function getContainer(): Container
    {
        $container = new Container();
        $dependencyProvider = new DependencyProvider();
        $dependencyProvider->providerDependency($container);
        return $container;
    }
}