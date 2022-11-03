<?php

declare(strict_types=1);

namespace AppTest\Service;

use App\Controller\DetailControll;
use App\Controller\HomeControll;
use App\Controller\ListControll;
use App\Service\ControllerProvider;
use PHPUnit\Framework\TestCase;

class ControllerProviderTest extends TestCase
{

    public function testGetList(): void
    {
        $controllerProvider = new ControllerProvider();
        $array1 = $controllerProvider->getList();
        $array2 = [DetailControll::class, HomeControll::class, ListControll::class];
        self::assertIsArray($controllerProvider->getList());
        self::assertEquals($array1, $array2);
    }

    public function testGetClassByString(): void
    {
        $controllerProvider = new ControllerProvider();
         self::assertEquals('App\Controller\TesttitleControll', $controllerProvider->getClassByString('Testtitle'));
    }
}