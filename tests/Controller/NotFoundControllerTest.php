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
        $viewMock = $this->createMock(View::class);
        $viewMock->expects($this->once())
            ->method('renderTemplate');

        $notFoundController = new NotFoundControll($viewMock);
        $notFoundController->renderView();
    }

    public function testAreTemplateParameterSet()
    {
        $viewMock = $this->createMock(View::class);
        $viewMock->expects(self::once())
            ->method('addTemplateParameter');
        $notFoundController = new NotFoundControll($viewMock);
        $notFoundController->renderView();
    }
}