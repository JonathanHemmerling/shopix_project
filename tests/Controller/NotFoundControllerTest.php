<?php

declare(strict_types=1);

namespace AppTest\Controller;

use App\Controller\NotFoundControll;
use App\Core\View;
use \PHPUnit\Framework\TestCase;

class NotFoundControllerTest extends TestCase
{
    public function testNotFoundController()
    {
        $mock = $this->createMock(View::class);
        $mock->expects($this->once())
            ->method('getView')
            ->with(
                $this->equalTo(
                    '/home/jonathanhemmerling/PhpstormProjects/shopix_project/src/Core/../templates/notFound.tpl'
                )
            );

        $controller = new NotFoundControll(new View(new \Smarty()));
        $controller->getView('notFound.tpl');
    }
}