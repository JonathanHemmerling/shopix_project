<?php

declare(strict_types=1);

namespace AppTest\Core;

use App\Core\View;
use PHPUnit\Framework\TestCase;

class ViewTest extends TestCase
{
    public function testAddParameter(): void
    {
        $mock = $this->createMock(\Smarty::class);
        $mock->expects($this->once())
            ->method('assign')
            ->with($this->equalTo('String1'), $this->equalTo(['String2']));
        $view = new View($mock);
        $view->addTemplateParameter('String1', ['String2']);
    }

    public function testDisplay(): void
    {
        $mock = $this->createMock(\Smarty::class);
        $mock->expects($this->once())
            ->method('display')
            ->with(
                $this->equalTo(
                    '/opt/project/src/Core/../templates/name.tpl'
                )
            );
        $view = new View($mock);
        $view->display('name.tpl');
    }

}