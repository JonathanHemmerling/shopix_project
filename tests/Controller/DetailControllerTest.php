<?php

declare(strict_types=1);

namespace AppTest\Controller;

use App\Controller\DetailControll;

use App\Controller\ListControll;
use App\Core\View;
use App\Model\ProductRepository;
use AppTest\jsons\jsonDecode;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;


class DetailControllerTest extends TestCase
{
    private MockObject $smartyMock;
    private MockObject $viewMock;
    private MockObject $productRepositoryMock;
    private DetailControll $detailController;

    public function setUp(): void
    {
        $_GET['categoryId'] = '2';
        $_GET['id'] = '1';
        $jsonPath = file_get_contents(__DIR__ . '/../jsons/Detail.json');
        $expectedJsonArray = json_decode($jsonPath, true);
        $this->smartyMock = $this->getMockBuilder(\Smarty::class)
            ->getMock();
        $this->viewMock = $this->getMockBuilder(View::class)
            ->setConstructorArgs([$this->smartyMock])
            ->getMock();
        $this->viewMock->method('getParams')
            ->willReturn(['test']);
        $this->productRepositoryMock = $this->getMockBuilder(ProductRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->productRepositoryMock->method('getJsonFileContent')
            ->willReturn($expectedJsonArray);
        $this->detailController = new DetailControll($this->viewMock, $this->productRepositoryMock);
    }

    public function tearDown(): void
    {
        unset($this->detailController, $this->productRepositoryMock, $this->viewMock, $this->smartyMock);
        $_GET = [];
    }

    public function testIfDataRequestForJsonWorkedFine(): void
    {
        $jsonArray = $this->detailController->getDataFromModel();
        self::assertIsArray($jsonArray);
        self::assertArrayHasKey(0, $jsonArray);
        self::assertCount(9, $jsonArray);
    }

    public function testIsStrForLinkComposedCorrect(): void
    {
        $this->detailController->renderView();
        $linkArray = $this->detailController->getStrForProductName();
        $expectedLink = 'Sweatshirt 1:';
        self::assertIsArray($linkArray);
        self::assertArrayHasKey(0, $linkArray);
        self::assertCount(1, $linkArray);
        self::assertSame($expectedLink, $linkArray[0]);
    }

    public function testIsTemplateNameCorrectSetUp(): void
    {
        $this->viewMock->expects($this->once())
            ->method('setTemplate')
            ->with('product.tpl');
        $this->detailController->renderView();
    }

    public function testIfParameterAddedToView(): void
    {
        $this->viewMock->expects(self::exactly(3))
            ->method('addTemplateParameter');
        $this->detailController->setStrForProductName(['test']);
        $this->detailController->renderView();
        $paramsInView = $this->viewMock->getParams();
        $expectedStrForLink = $this->detailController->getStrForProductName()[0];
        $this->assertSame($expectedStrForLink, $paramsInView[0]);
    }

}