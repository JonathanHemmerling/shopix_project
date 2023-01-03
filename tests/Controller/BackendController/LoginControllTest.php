<?php

declare(strict_types=1);

namespace AppTest\Controller\BackendController;

use App\Controller\BackendController\LoginControll;
use App\Core\Redirect;
use App\Core\RedirectInterface;
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
    private Container $container;

    protected function setUp(): void
    {
        $_POST['userName'] = 'AdminName';
        $this->container = $this->getContainer();
        $validation = $this->container->get(UserDataValidation::class);
        $this->mockSession = $this->createMock(SessionInterface::class);
        $this->login = new LoginControll(
            $this->container->get(View::class),
            $this->container->get(LoginRepository::class),
            $validation,
            $this->mockSession,
            $this->container->get(Redirect::class),
        );
        parent::setUp();
    }

    protected function tearDown(): void
    {
        unset($this->mockSession, $this->login);
        $_SESSION = [];
        $_POST = [];
        parent::tearDown();
    }

    public function testIfUserNameIsValid(): void
    {
        $userRepository = $this->createMock(UserRepository::class);
        $loginRepository = $this->createMock(LoginRepository::class);
        $userDataValidation = new UserDataValidation($loginRepository, $userRepository);
        $loginRepository->expects($this->atLeastOnce())->method('findAdminByName')->willReturn(
            ['userName' => 'AdminName']
        );

        $userIsValid = $userDataValidation->checkIfUserNameIsValid('AdminName');
        $userIsBlank = $userDataValidation->checkIfUserNameIsValid('');
        $userNameIsToShort = $userDataValidation->checkIfUserNameIsValid('It');
        $userNameIsToLong = $userDataValidation->checkIfUserNameIsValid('1234567890ASDFGHJKLÖÄ123456');

        self::assertTrue($userIsValid);
        self::assertFalse($userIsBlank);
        self::assertFalse($userNameIsToShort);
        self::assertFalse($userNameIsToLong);
    }

    public function testIsAdminOrUserNotLoggedOut(): void
    {
        $_SESSION['userName'] = null;
        $_SESSION['adminName'] = null;
        $this->mockSession->expects($this->never())->method('logoutUser');

        $this->login->renderView();
    }

    public function testIsUserLoggedOut(): void
    {
        $_SESSION['userName'] = 'user';
        $_SESSION['adminName'] = null;
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

        $mockRedirect = $this->createMock(RedirectInterface::class);
        $mockRedirect->expects($this->once())->method('to');
        $this->mockSession->expects($this->once())->method('loginUser');
        $login = new LoginControll(
            $view = $this->container->get(View::class),
            $this->container->get(LoginRepository::class),
            $validation = $this->container->get(UserDataValidation::class),
            $this->mockSession,
            $mockRedirect
        );

        $login->renderView();
        $template = $view->getTemplate();
        $params = $view->getParams();
        $isUserValid = $validation->checkIfUserNameIsValid('');

        self::assertSame('login.tpl', $template);
        self::assertSame(['message' => []], $params);
        self::assertFalse($isUserValid);
    }

    public function testIfUserNameExists(): void
    {
        $_POST['submit'] = true;
        $_POST['userName'] = 'UserTest123';
        $_POST['password'] = 'password';
        $mockLogin = $this->getMockBuilder(LoginRepository::class)->setConstructorArgs(
            [$this->container->get(SqlConnection::class), $this->container->get(\PDO::class)]
        )->onlyMethods(['findUserByName'])->getMock();
        $mockLogin->expects($this->atLeastOnce())->method('findUserByName')->willReturn(
            ['userName' => 'UserTest123', 'hashedPassword' => 'password']
        );
        $validation = new UserDataValidation($mockLogin, $this->container->get(UserRepository::class));
        $login = new LoginControll(
            $this->container->get(View::class),
            $mockLogin,
            $validation,
            $this->mockSession,
            $this->container->get(Redirect::class)
        );

        $login->renderView();
        $userExists = $validation->checkIfUserNameIsValid($_POST['userName']);
        $userDoesNotExist = $validation->checkIfUserNameIsValid('user');

        self::assertTrue($userExists);
        self::assertFalse($userDoesNotExist);
    }


    private function getContainer(): Container
    {
        $container = new Container();
        $dependencyProvider = new DependencyProvider();
        $dependencyProvider->providerDependency($container);
        return $container;
    }
}