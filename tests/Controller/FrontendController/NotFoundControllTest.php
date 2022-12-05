<?php

declare(strict_types=1);

namespace AppTest\FrontendController;

use App\Core\View;
use PHPUnit\Framework\TestCase;

class NotFoundControllTest extends TestCase
{
    public function testDisplay(): void
    {
        $viewMock = $this->createMock(View::class);
        $viewMock->expects($this->once())
            ->method('renderTemplate');

        $notFoundController = new \App\Controller\FrontendController\NotFoundControll($viewMock);
        $notFoundController->renderView();
    }

    public function testAreTemplateParameterSet()
    {
        $viewMock = $this->createMock(View::class);
        $viewMock->expects(self::once())
            ->method('addTemplateParameter');
        $notFoundController = new \App\Controller\FrontendController\NotFoundControll($viewMock);
        $notFoundController->renderView();
    }
}