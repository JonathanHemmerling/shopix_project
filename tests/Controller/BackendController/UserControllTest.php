<?php

declare(strict_types=1);

namespace AppTest\Controller\BackendController;

use App\Controller\BackendController\CreateUserControll;
use App\Core\View;
use App\Model\UserRepository;
use App\Service\Container;
use App\Service\DependencyProvider;
use App\Validation\UserDataValidation;
use PHPUnit\Framework\TestCase;


class UserControllTest extends TestCase
{
    protected function tearDown(): void
    {
        $_SESSION = [];
        $_POST = [];
        parent::tearDown();
    }

    public function testIsFormSubmitted()
    {
        $_POST['submit'] = true;
        $_POST['userName'] = 'UserForTest';
        $_POST['firstName'] = 'User';
        $_POST['lastName'] = 'ForTest';
        $_POST['country'] = 'TestCountry';
        $_POST['postCode'] = '55555';
        $_POST['city'] = 'TestCity';
        $_POST['street'] = 'TestStreet';
        $_POST['streetNumber'] = '99';
        $_POST['email'] = 'test@test.test';
        $_POST['telefonNumber'] = '0123456789';
        $_POST['password'] = 'password';
        $_POST['confirmPassword'] = 'password';

        $container = $this->getContainer();
        /** @var View $view */
        $view = $container->get(View::class);
        $repository = $container->get(UserRepository::class);
        $validation = $container->get(UserDataValidation::class);

        $userControll = new CreateUserControll($view, $repository, $validation);

        $userControll->renderView();
        $template = $view->getTemplate();
        $params = $view->getParams();

        self::assertSame('createUser.tpl' ,$template);
        self::assertIsArray($params);
        self::assertSame(['errors' => [0 => 'Select another Username']],$params);


    }

    private function getContainer(): Container
    {
        $container = new Container();
        $dependencyProvider = new DependencyProvider();
        $dependencyProvider->providerDependency($container);
        return $container;
    }

    /*public function setUp(): void
    {
        $_SESSION['submit'] = 'submit';
        $_SESSION['userName'] = 'TestUser';
        $_SESSION['password'] = 'password';
        $_POST['userName'] = 'TestUser';
        $jsonPath = file_get_contents(__DIR__ . '/../jsons/Login.json');
        $expectedJsonArray = json_decode($jsonPath, true);
        $userDataMapperMock = $this->getMockBuilder(UserDataMapper::class)
            ->getMock();
        $this->smartyMock = $this->getMockBuilder(\Smarty::class)
            ->getMock();
        $this->viewMock = $this->getMockBuilder(View::class)
            ->setConstructorArgs([$this->smartyMock])
            ->getMock();
        $this->newUserRepositoryMock = $this->getMockBuilder(UserRepository::class)
            ->setConstructorArgs(['Login'])
            ->getMock();
        $this->newUserRepositoryMock->method('getCurrentUserData')
            ->willReturn($expectedJsonArray);
        $this->newUserRepositoryMock->method('addNewUserDataArrayToJson')
            ->with('TestUser');
        $this->newUserDataValidation = $this->getMockBuilder(NewUserDataValidation::class)
            ->onlyMethods(['checkIfUserNameIsValid', 'getErrors'])
            ->getMock();
        $this->newUserController = new CreateUserControll(
            $this->viewMock,
            $this->newUserRepositoryMock,
            $this->newUserDataValidation
        );
    }

    public function tearDown(): void
    {
        unset($this->newUserController, $this->newUserRepositoryMock, $this->viewMock, $this->smartyMock);
        $_POST = [];
    }

    public function testIfDataRequestForJsonWorkedFine(): void
    {
        $loginData = $this->newUserController->validateLoginData();
        self::returnValue([]);
        self::assertNotTrue($loginData);

        $this->newUserRepositoryMock->expects($this->once())
            ->method('getCurrentUserData')
            ->willReturn(['']);
        $this->newUserRepositoryMock->getCurrentUserData();
    }

    public function testIfTemplateIsSet(): void
    {
        $this->viewMock->expects(self::exactly(2))
            ->method('addTemplateParameter');
        $this->viewMock->expects($this->once())
            ->method('setTemplate')
            ->with('createUser.tpl');
        $this->newUserController->renderView();
    }

    public function testIfLoginDataIsValid(): void
    {
        $this->newUserDataValidation->expects($this->once())
            ->method('checkIfUserNameIsValid')
            ->with('TestUser')
            ->willReturn(false);
        $this->newUserController->validateLoginData();
        $this->newUserDataValidation->checkIfUserNameIsValid('TestUser');
    }

    public function testIfLogInIsCalled(): void
    {
        $this->newUserDataValidation->expects($this->never())
            ->method('getErrors');
        $this->newUserDataValidation->method('checkIfUserNameIsValid')
            ->willReturn(false);
        $this->newUserController->renderView();
    }

    public function testIfErrorIsThrown()
    {
        $pdo = $this->getMockBuilder(\PDO::class)
            ->disableOriginalConstructor()
            ->getMock();
        $smarty = $this->getMockBuilder(\Smarty::Class)
            ->getMock();
        $view = $this->getMockBuilder(View::class)
            ->setConstructorArgs([$smarty])
            ->onlyMethods(['setTemplate'])
            ->getMock();
        $session = $this->getMockBuilder(Session::class)
            ->onlyMethods(['loginUser'])
            ->getMock();
        $sqlcon = $this->getMockBuilder(SqlConnection::class)
            ->getMock();
        $loginRepo = $this->getMockBuilder(LoginRepository::class)
            ->setConstructorArgs([$sqlcon, $pdo])
            ->onlyMethods(['findUserByName'])
            ->getMock();
        $userRepo = $this->getMockBuilder(UserRepository::class)
            ->setConstructorArgs([$sqlcon])
            ->getMock();
        $userValidation = $this->getMockBuilder(UserDataValidation::class)
            ->setConstructorArgs([$loginRepo, $userRepo])
            ->onlyMethods(['checkIfUserNameIsValid', 'getErrors', 'checkIfPasswordIsValid', 'verifyPassword'])
            ->getMock();
        $userControll = new CreateUserControll($view, $userRepo, $userValidation);
        $_POST['submit'] = 'log';
        $_POST['userName'] = '';
        $_POST['firstName'] = 'test';
        $_POST['lastName'] = 'user';
        $_POST['country'] = 'test';
        $_POST['postCode'] = '55555';
        $_POST['city'] = 'test';
        $_POST['street'] = 'test';
        $_POST['streetNumber'] = '12';
        $_POST['email'] = 'test';
        $_POST['telefonNumber'] = 'test';
        $_POST['password'] = password_hash('password', PASSWORD_BCRYPT);
        $_POST['confirmPassword'] = 'password';
        $userValidation->method('checkIfUserNameIsValid')
            ->willReturn(false);
        $userValidation->method('checkIfPasswordIsValid')
            ->willReturn(true);

        $userRepo->expects($this->never())
            ->method('addNewUserDataArrayToDb');
        $userValidation->expects(($this->atLeastOnce()))
            ->method('getErrors');

        $userControll->renderView();
    }

    public function testUserRegistration()
    {
        $pdo = $this->getMockBuilder(\PDO::class)
            ->disableOriginalConstructor()
            ->getMock();
        $smarty = $this->getMockBuilder(\Smarty::Class)
            ->getMock();
        $view = $this->getMockBuilder(View::class)
            ->setConstructorArgs([$smarty])
            ->onlyMethods(['setTemplate', 'addTemplateParameter'])
            ->getMock();
        $sqlcon = $this->getMockBuilder(SqlConnection::class)
            ->getMock();
        $loginRepo = $this->getMockBuilder(LoginRepository::class)
            ->setConstructorArgs([$sqlcon, $pdo])
            ->onlyMethods(['findUserByName'])
            ->getMock();
        $userRepo = $this->getMockBuilder(UserRepository::class)
            ->setConstructorArgs([$sqlcon])
            ->getMock();
        $userValidation = $this->getMockBuilder(UserDataValidation::class)
            ->setConstructorArgs([$loginRepo, $userRepo])
            ->onlyMethods(['checkIfUserNameIsValid', 'checkIfPasswordIsValid', 'verifyPassword'])
            ->getMock();
        $userControll = new CreateUserControll($view, $userRepo, $userValidation);
        $_POST['submit'] = 'log';
        $_POST['userName'] = 'UserTest123';
        $_POST['firstName'] = 'test';
        $_POST['lastName'] = 'user';
        $_POST['country'] = 'test';
        $_POST['postCode'] = '55555';
        $_POST['city'] = 'test';
        $_POST['street'] = 'test';
        $_POST['streetNumber'] = '12';
        $_POST['email'] = 'test';
        $_POST['telefonNumber'] = 'test';
        $_POST['password'] = password_hash('password', PASSWORD_BCRYPT);
        $_POST['confirmPassword'] = 'password';
        $userValidation->method('checkIfUserNameIsValid')
            ->willReturn(true);
        $userValidation->method('checkIfPasswordIsValid')
            ->willReturn(true);
        $userRepo->expects($this->atLeastOnce())
            ->method('addNewUserDataArrayToDb');


        $userRepo->expects($this->atLeastOnce())
            ->method('addNewUserDataArrayToDb');

        $view->expects($this->atLeastOnce())
            ->method('setTemplate')
            ->with('createUser.tpl');
        $view->expects($this->exactly(1))
            ->method('addTemplateParameter');
        $userControll->renderView();
    }
*/
}