<?php

declare(strict_types=1);

namespace AppTest\BackendController;

use App\BackendController\LoginControll;
use App\BackendController\NewUserControll;
use App\BackendController\NewUserDataValidation;
use App\BackendController\UserDataValidation;
use App\Core\View;
use App\Model\LoginRepository;
use App\Model\Mapper\UserDataMapper;
use App\Model\NewUserRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;


class NewUserControllerTest extends TestCase
{
    private MockObject $smartyMock;
    private MockObject $viewMock;
    private MockObject $newUserRepositoryMock;
    private LoginControll $loginController;
    private Mockobject $loginControllerMock;
    private MockObject $newUserDataValidation;

    public function setUp(): void
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
        $this->newUserRepositoryMock = $this->getMockBuilder(NewUserRepository::class)
            ->setConstructorArgs(['Login'])
            ->getMock();
        $this->newUserRepositoryMock->method('getCurrentUserData')
            ->willReturn($expectedJsonArray);
        $this->newUserRepositoryMock->method('addNewUserDataArrayToJson')
            ->with('TestUser');
        $this->newUserDataValidation = $this->getMockBuilder(NewUserDataValidation::class)
            ->onlyMethods(['checkIfUserNameIsValid'])
            ->getMock();
        $this->newUserController = new NewUserControll($this->viewMock, $this->newUserRepositoryMock, $this->newUserDataValidation);
    }

    public function tearDown(): void
    {
        unset($this->newUserController, $this->newUserRepositoryMock, $this->viewMock, $this->smartyMock);
        $_POST = [];
    }

    public function testIfDataRequestForJsonWorkedFine(): void
    {

        $loginData = $this->newUserController->renderView();
        $expectedLoginData = 'TestUser';
        self::assertSame($expectedLoginData, $loginData['userName']);
        self::assertNotSame($expectedLoginData, $loginData['password']);

        $this->newUserRepositoryMock->expects($this->once())
            ->method('getAllDataFromJson')
            ->willReturn(['']);
        $this->newUserRepositoryMock->getCurrentUserData();

    }

    public function testIfTemplateIsSet(): void
    {
        $this->viewMock->expects(self::exactly(2))
            ->method('addTemplateParameter');
        $this->viewMock->expects($this->once())
            ->method('setTemplate')
            ->with('login.tpl');
        $this->loginController->renderView();
    }

    public function testIfLoginDataIsValid(): void
    {
        $this->loginControllerMock->expects($this->once())
            ->method('validateLoginData');
        $this->newUserDataValidation->expects($this->once())
            ->method('checkIfUserNameIsValid')
            ->with('TestUser')
            ->willReturn(false);
        $this->loginControllerMock->validateLoginData();
        $this->newUserDataValidation->checkIfUserNameIsValid('TestUser');
    }

}