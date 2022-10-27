<?php

declare(strict_types=1);

namespace AppTest\Core;

use App\Core\View;
use PHPUnit\Framework\TestCase;

class ViewTest extends TestCase
{
    public function testAddParameter(): void
    {
        $view = new View();
        $stringParameter = 'test parameter';
        $arrayParameter = ['1', '2'];
        $integerParameter = 13;
        $emptyParameter = null;
        self::assertEquals('test parameter', $view->addTemplateParameter($stringParameter));
        self::assertEquals('1', $view->addTemplateParameter($arrayParameter[0]));
        self::assertEquals('13', $view->addTemplateParameter($integerParameter));
        self::assertEquals('', $view->addTemplateParameter($emptyParameter));
    }

    public function testDisplay()
    {
        $view = new View();
    }

}