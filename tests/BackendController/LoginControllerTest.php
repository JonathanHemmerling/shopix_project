<?php

declare(strict_types=1);

namespace AppTest\FrontendController;

use App\BackendController\LoginControll;
use App\Core\View;
use App\Model\Dto\UserDataTransferObject;
use App\Model\LoginRepository;
use App\Model\Mapper\UserDataMapper;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;


class LoginControllerTest extends TestCase
{
    private MockObject $smartyMock;
    private MockObject $viewMock;
    private MockObject $loginRepositoryMock;
    private LoginControll $loginController;
    private Mockobject $loginControllerMock;

    public function setUp(): void
    {
        $_SESSION['submit'] = 'submit';
        $_SESSION['userId'] = 1;
        $_SESSION['userName'] = 'TestUser';
        $_SESSION['password'] = 'password';
        $_POST['userName'] = 'TestUser';
        $jsonPath = file_get_contents(__DIR__ . '/../jsons/Login.json');
        $expectedJsonArray = json_decode($jsonPath, true);
        $userDTOMock = $this->getMockBuilder(UserDataTransferObject::class)
            ->setConstructorArgs(
                ['userId' => 1, 'userName' => 'TestUser', 'password' => 'password']
            )
            ->getMock();
        $userDataMapperMock = $this->getMockBuilder(UserDataMapper::class)
            ->getMock();
        $userDataMapperMock->method('mapToUserDto')
            ->willReturn($userDTOMock);
        $this->smartyMock = $this->getMockBuilder(\Smarty::class)
            ->getMock();
        $this->viewMock = $this->getMockBuilder(View::class)
            ->setConstructorArgs([$this->smartyMock])
            ->getMock();
        $this->viewMock->method('getParams')
            ->willReturn(['test']);
        $this->loginRepositoryMock = $this->getMockBuilder(LoginRepository::class)
            ->setConstructorArgs(['Login', $userDataMapperMock])
            ->getMock();
        $this->loginRepositoryMock->method('getJsonFileContent')
            ->willReturn($expectedJsonArray);
        $this->loginRepositoryMock->method('findUserByName')
            ->with('TestUser')
            ->willReturn($userDTOMock);
        $this->loginController = new LoginControll($this->viewMock, $this->loginRepositoryMock);
        $this->loginControllerMock = $this->getMockBuilder(LoginControll::class)
            ->setConstructorArgs([$this->viewMock])
            ->getMock();
    }

    public function tearDown(): void
    {
        unset($this->loginController, $this->loginRepositoryMock, $this->viewMock, $this->smartyMock);
        $_POST = [];
    }

    public function testIfDataRequestForJsonWorkedFine(): void
    {
        $this->loginController->renderView();
        $loginData = $this->loginController->getLoginData();
        $expectedLoginData = 'TestUser';
        self::assertSame($expectedLoginData, $loginData->userName);
        self::assertNotSame($expectedLoginData, $loginData->password);
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
        $this->loginControllerMock->renderView();
        $this->loginControllerMock->expects(self::any())
            ->method('validateLoginData');
        $this->loginControllerMock->expects(self::any())
            ->method('loginUser')
            ->with('TestUser');
        self::assertNotSame($_POST['userName'], $this->loginControllerMock->getLoginData());
    }

}