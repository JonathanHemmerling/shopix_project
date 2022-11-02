<?php

declare(strict_types=1);

namespace AppTest\Controller;

use App\Controller\DetailControll;

use App\Controller\HomeControll;
use App\Core\View;
use PHPUnit\Framework\TestCase;


class DetailControllerTest extends TestCase
{
    public function testDisplay(): void
    {
        $mock = $this->createMock(View::class);
        $mock->expects($this->once())
            ->method('renderTemplate');

        $view = new DetailControll($mock, ['categoryId' => '1', 'id' => '1']);
        $view->renderView();
    }
}