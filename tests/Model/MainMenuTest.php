<?php

declare(strict_types=1);

namespace AppTest\Model;

use App\Model\MainMenu;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class MainMenuTest extends TestCase
{
    public function testDataIsExtractedFromJson()
    {
        $mainMenu = new MainMenu(__DIR__ . '/data/syntactically-correct.json');

        $categories = $mainMenu->getMenuCategorysFromJson();
        self::assertIsArray($categories);
        self::assertCount(3, $categories);
    }

    public function testExceptionIsThrownOnNonExistingFile(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $mainMenu = new MainMenu(__DIR__ . '/data/non-existing.json');
        $mainMenu->getMenuCategorysFromJson();
    }

    /*public function testExceptionIsThrownOnNonDirectory(): void
    {
        $pathToJson = __DIR__ . '/data';
        $this->expectException(InvalidArgumentException::class);
        $this->expectErrorMessage('Expected a file, directory "' . $pathToJson . '" was given.');

        $mainMenu = new MainMenu($pathToJson);
        $mainMenu->getMenuCategorysFromJson();
    }*/

    public function testExceptionIsThrownOnBrokenJson(): void
    {
        $pathToJsonFile = __DIR__ . '/data/syntactically-incorrect.json';
        $this->expectException(RuntimeException::class);
        $this->expectErrorMessage('Invalid JSON stored in file "' . $pathToJsonFile . '".');

        $mainMenu = new MainMenu($pathToJsonFile);
        $mainMenu->getMenuCategorysFromJson();
    }
}