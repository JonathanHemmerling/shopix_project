<?php

declare(strict_types=1);

namespace AppTest\Controller\BackendController;

use App\Controller\BackendController\LoginControll;
use App\Core\View;
use App\Model\LoginRepository;
use App\Model\Mapper\UserDataMapper;
use App\Validation\UserDataValidation;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;


class LoginControllerTest extends TestCase
{

    private MockObject $smartyMock;
    private MockObject $viewMock;
    private MockObject $loginRepositoryMock;
    private LoginControll $loginController;
    private MockObject $userDataValidation;
    private array $expectedJsonArray;

    public function setUp(): void
    {
        $_SESSION['submit'] = 'submit';
        $_SESSION['userName'] = '';
        $_SESSION['password'] = 'password';
        $_POST['userName'] = '';
        $jsonPath = file_get_contents(__DIR__ . '/../jsons/Login.json');
        $this->expectedJsonArray = json_decode($jsonPath, true);
        $userDataMapperMock = $this->getMockBuilder(UserDataMapper::class)
            ->getMock();
        $this->smartyMock = $this->getMockBuilder(\Smarty::class)
            ->getMock();
        $this->viewMock = $this->getMockBuilder(View::class)
            ->setConstructorArgs([$this->smartyMock])
            ->getMock();
        $this->loginRepositoryMock = $this->getMockBuilder(LoginRepository::class)
            ->setConstructorArgs(['Login', $userDataMapperMock])
            ->getMock();
        $this->loginRepositoryMock->method('getAllDataFromJson')
            ->willReturn($this->expectedJsonArray);
        $this->loginRepositoryMock->method('findUserByName')
            ->with('')
            ->willReturn(['userName' => '', 'password' => 'password']);
        $this->userDataValidation = $this->getMockBuilder(UserDataValidation::class)
            ->onlyMethods(['checkIfUserNameIsValid', 'getErrors'])
            ->getMock();

        $this->loginControllerMock = $this->getMockBuilder(LoginControll::class)
            ->setConstructorArgs([$this->viewMock, $this->loginRepositoryMock, $this->userDataValidation])
            ->onlyMethods(['validateLoginData','getUserDataSet', 'getLoginData', 'renderView'])
            ->getMock();
    }

    public function tearDown(): void
    {
        unset($this->loginController, $this->loginRepositoryMock, $this->viewMock, $this->smartyMock);
        $_POST = [];
    }



    public function testIfDataRequestForJsonWorkedFine(): void
    {
        $this->loginController = new LoginControll($this->viewMock, $this->loginRepositoryMock, $this->userDataValidation);
        $loginData = $this->loginController->getUserDataSet('');
        $expectedLoginData = '';
        self::assertSame($expectedLoginData, $loginData['userName']);
        self::assertNotSame($expectedLoginData, $loginData['password']);

        $this->loginRepositoryMock->expects($this->once())
            ->method('getAllDataFromJson')
            ->willReturn(['']);
        $this->loginRepositoryMock->getAllDataFromJson();

    }

    public function testIfTemplateIsSet(): void
    {
        $this->loginController = new LoginControll($this->viewMock, $this->loginRepositoryMock, $this->userDataValidation);
        $this->viewMock->expects(self::exactly(2))
            ->method('addTemplateParameter');
        $this->viewMock->expects($this->once())
            ->method('setTemplate')
            ->with('login.tpl');
        $this->loginController->renderView();
    }


    public function testIfLoginDataIsValid(): void
    {
        $this->loginController = new LoginControll($this->viewMock, $this->loginRepositoryMock, $this->userDataValidation);
        $this->userDataValidation->expects($this->once())
            ->method('checkIfUserNameIsValid')
            ->with('TestUser')
            ->willReturn(false);;
        $this->userDataValidation->checkIfUserNameIsValid('TestUser');
    }

    public function testIfLogInIsCalled(): void
    {
        $this->loginController = new LoginControll($this->viewMock, $this->loginRepositoryMock, $this->userDataValidation);
        $this->userDataValidation->expects($this->never())
            ->method('getErrors');
        $this->userDataValidation->method('checkIfUserNameIsValid')
            ->willReturn(false);
        $this->loginController->renderView();

    }

}