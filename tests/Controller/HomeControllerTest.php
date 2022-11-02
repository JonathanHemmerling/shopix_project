<?php

declare(strict_types=1);

namespace AppTest\Controller;

use App\Controller\HomeControll;
use App\Core\View;
use PHPUnit\Framework\TestCase;

class HomeControllerTest extends TestCase
{

    public function testDisplay(): void
    {
        $mock = $this->createMock(View::class);
        $mock->expects($this->once())
            ->method('renderTemplate');

        $view = new HomeControll($mock);
        $view->renderView();
    }
}