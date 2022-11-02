<?php

declare(strict_types=1);

namespace AppTest\Controller;

use App\Controller\HomeControll;
use App\Controller\ListControll;
use App\Core\View;
use PHPUnit\Framework\TestCase;

class ListControllerTest extends TestCase
{
    public function testDisplay(): void
    {
        $mock = $this->createMock(View::class);
        $mock->expects($this->once())
            ->method('renderTemplate');

        $view = new ListControll($mock, ['productId'=>'1']);
        $view->renderView();
    }
}