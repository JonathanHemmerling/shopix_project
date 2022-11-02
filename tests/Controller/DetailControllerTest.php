<?php

declare(strict_types=1);

namespace AppTest\Controller;

use App\Controller\DetailControll;

use App\Core\View;
use PHPUnit\Framework\TestCase;


class DetailControllerTest extends TestCase
{

    public function testItGetsDataFromModel(): void
    {
        $detailController = new DetailControll(new View(new \Smarty()));
        $detailArray = $detailController->getProductDataFromModel();
        self::assertIsArray($detailArray);
        self::assertEquals(
            [
                "id" => "1",
                "categoryId" => "1",
                "category" => "jeans",
                "categoryDisplayName" => "Jeans",
                "displayName" => "Jeans 1",
                "detail" => "jeans_1",
                "preis" => "45 €",
                "description" => "The first Jeans"
            ],
            $detailArray[0]
        );
    }

    public function testDidItAddParameterToView(): void
    {
        $mock = $this->createMock(View::class);
        $mock->expects($this->once())
            ->method('addTemplateParameter');
        $detailController = new DetailControll();
        $detailController->addProductNameParameterToView();
    }

    public function testDoesItRenderView(): void
    {
    }

}