<?php

declare(strict_types=1);

namespace AppTest\Controller\BackendController;

use App\Controller\BackendController\NewUserControll;
use App\Core\View;
use App\Model\Mapper\UserDataMapper;
use App\Model\UserRepository;
use App\Validation\NewUserDataValidation;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;


class NewUserControllerTest extends TestCase
{
    private MockObject $smartyMock;
    private MockObject $viewMock;
    private MockObject $newUserRepositoryMock;
    private \App\Controller\BackendController\LoginControll $loginController;
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
        $this->newUserRepositoryMock = $this->getMockBuilder(UserRepository::class)
            ->setConstructorArgs(['Login'])
            ->getMock();
        $this->newUserRepositoryMock->method('getCurrentUserData')
            ->willReturn($expectedJsonArray);
        $this->newUserRepositoryMock->method('addNewUserDataArrayToJson')
            ->with('TestUser');
        $this->newUserDataValidation = $this->getMockBuilder(NewUserDataValidation::class)
            ->onlyMethods(['checkIfUserNameIsValid','getErrors'])
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
            ->with('newUser.tpl');
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

}