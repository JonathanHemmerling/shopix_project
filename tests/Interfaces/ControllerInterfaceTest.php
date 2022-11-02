<?php

declare(strict_types=1);

namespace AppTest\Interfaces;

use App\Interfaces\ControllerInterface;
use PHPUnit\Framework\TestCase;

class ControllerInterfaceTest extends TestCase
{
    public function testInterfaceOutput(): void
    {
        $mockControllerInterface = $this->createMock(ControllerInterface::class);
        $mockControllerInterface ->expects($this->never())
                                ->method('renderView');
    }
}