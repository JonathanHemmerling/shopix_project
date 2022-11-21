<?php
declare(strict_types=1);

namespace AppTest\BackendController;

require_once __DIR__ . '/../../src/functions/authFunctions.php';
use App\BackendController\LogoutControll;
use PHPUnit\Framework\TestCase;

class LogoutControllerTest extends TestCase
{

    public function testIfUserIsLoggedOut(): void
    {
        $logoutMock = $this->getMockBuilder(LogoutControll::class)
            ->onlyMethods(['logoutUser'])
            ->getMock();
        $logoutMock->expects($this->atLeastOnce())
            ->method('logoutUser')
            ->willReturn(true);
    }
}