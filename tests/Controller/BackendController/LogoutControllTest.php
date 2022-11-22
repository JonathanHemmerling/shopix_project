<?php

declare(strict_types=1);

namespace AppTest\Controller\BackendController;

use App\Controller\BackendController\LogoutControll;
use App\Controller\Session;
use App\Core\View;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class LogoutControllTest extends TestCase{
    private MockObject $viewMock;
    private MockObject $sessionMock;
    private LogoutControll $logoutController;

    public function testIfUserIsLoggedOut():void
    {
        $_SESSION['lastLogin'] = time();
        $_SESSION['userName'] = 'test';
        $this->viewMock = $this->getMockBuilder(View::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['addTemplateParameter','setTemplate'])
            ->getMock();
        $this->sessionMock = $this->getMockBuilder(Session::class)
            ->onlyMethods(['logoutUser'])
            ->getMock();
        $this->sessionMock->expects($this->once())
            ->method('logoutUser');

        $this->logoutController = new LogoutControll($this->viewMock, $this->sessionMock);

        $this->viewMock->expects($this->exactly(2))
            ->method('addTemplateParameter')
            ->withAnyParameters();

        $this->viewMock->expects($this->once())
            ->method('setTemplate')
            ->with('login.tpl');
        $this->logoutController->renderView();


    }


}