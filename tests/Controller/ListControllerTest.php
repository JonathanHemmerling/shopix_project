<?php

declare(strict_types=1);

namespace AppTest\Controller;

use App\Controller\ListControll;
use App\Core\View;
use PHPUnit\Framework\TestCase;

class ListControllerTest extends TestCase
{
    public function testListController(): void
    {
        $listControll = new ListControll(new View(new \Smarty()));

        $viewRender = $listControll->renderView();
        self::equalTo()


    }
}