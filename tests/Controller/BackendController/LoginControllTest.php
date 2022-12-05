<?php

declare(strict_types=1);

namespace AppTest\Controller\BackendController;

include_once 'authFunctions.php';
use App\Controller\BackendController\LoginControll;
use App\Core\Session;
use App\Core\View;
use App\Model\LoginRepository;
use App\Model\UserRepository;
use App\SQL\SqlConnection;
use App\Validation\UserDataValidation;
use PHPUnit\Framework\TestCase;


class LoginControllTest extends TestCase
{
    public function testIsUserLoggedIn()
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
            ->onlyMethods(['checkIfUserNameIsValid', 'verifyPassword'])
            ->getMock();
        $loginControll = new LoginControll($view ,$loginRepo, $userValidation ,$session);
        $_POST['submit'] = 'Login';
        $_POST['userName'] = 'UserTest123';
        $_POST['password'] = 'password';
        $userValidation->method('checkIfUserNameIsValid')
            ->willReturn(true);
        $userValidation->method('verifyPassword')
            ->willReturn(true);
        $loginRepo->method('findUserByName')
            ->willReturn(['hashedPassword' => 'password']);


        $session->expects($this->atLeastOnce())
            ->method('loginUser');

        $view->expects($this->atLeastOnce())
            ->method('setTemplate')
             ->with('login.tpl');
        $view->expects($this->exactly(2))
            ->method('addTemplateParameter');
        $loginControll->renderView();
    }

    public function testIfErrorsAreThrown(): void
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
            ->onlyMethods(['checkIfUserNameIsValid', 'verifyPassword', 'getErrors'])
            ->getMock();
        $loginControll = new LoginControll($view ,$loginRepo, $userValidation ,$session);
        $_POST['submit'] = 'Login';
        $_POST['userName'] = '';
        $_POST['password'] = '';
        $userValidation->method('checkIfUserNameIsValid')
            ->willReturn(false);
        $userValidation->method('verifyPassword')
            ->willReturn(false);
        $loginRepo->method('findUserByName')
            ->willReturn(['hashedPassword' => 'password']);

        $userValidation->expects($this->atLeastOnce())
            ->method('getErrors');
        $loginControll->renderView();
    }


}