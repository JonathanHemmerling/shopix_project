<?php

declare(strict_types=1);

namespace AppTest\Core;

use App\Core\View;
use PHPUnit\Framework\TestCase;

class ViewTest extends TestCase
{
    public function testAddParameter(): void
    {
        $mock = $this->getMockBuilder(View::class)
            ->onlyMethods(['addTemplateParameter'])
            ->getMock();
        $mock->expects($this->once())
            ->method('addTemplateParameter');
        $mock->addTemplateParameter('string', ['String']);
    }

    public function testDisplay(): void
    {
        $mock = $this->getMockBuilder(View::class)
            ->onlyMethods(['renderTemplate'])
            ->getMock();
        $mock->expects($this->once())
            ->method('renderTemplate');
        $mock->renderTemplate('string');
    }
}