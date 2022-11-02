<?php

declare(strict_types=1);

namespace AppTest\Controller;

use App\Controller\ListControll;
use App\Controller\NotFoundControll;
use App\Core\View;
use \PHPUnit\Framework\TestCase;

class NotFoundControllerTest extends TestCase
{
    public function testDisplay(): void
    {
        $mock = $this->createMock(View::class);
        $mock->expects($this->once())
            ->method('renderTemplate');

        $view = new NotFoundControll($mock);
        $view->renderView();
    }
}