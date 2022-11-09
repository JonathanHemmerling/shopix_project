<?php

declare(strict_types=1);

namespace AppTest\Controller;

use App\Controller\ListControll;
use App\Core\View;
use App\Model\ProductRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ListControllerTest extends TestCase
{
    private MockObject $smartyMock;
    private MockObject $viewMock;
    private MockObject $productRepositoryMock;
    private ListControll $listController;


    public function setUp(): void
    {
        $_GET['productId'] = '1';
        $jsonPath = file_get_contents(__DIR__ . '/../jsons/List.json');
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
        $this->listController = new ListControll($this->viewMock, $this->productRepositoryMock);
    }

    public function tearDown(): void
    {
        unset($this->homeController, $this->productRepositoryMock, $this->viewMock, $this->smartyMock);
        $_GET = [];
    }

    public function testIfDataRequestForJsonWorkedFine(): void
    {
        $jsonArray = $this->listController->getDataFromModel();
        self::assertIsArray($jsonArray);
        self::assertArrayHasKey(0, $jsonArray);
        self::assertCount(9, $jsonArray);
    }

    public function testIsStrForLinkComposedCorrect(): void
    {
        $this->listController->renderView();
        $linkArray = $this->listController->getStrForLinks();
        $expectedLink = 'index.php?page=Detail&jeans_1&categoryId=1&id=1>Jeans 1';
        self::assertIsArray($linkArray);
        self::assertArrayHasKey(0, $linkArray);
        self::assertCount(3, $linkArray);
        self::assertSame($expectedLink, $linkArray[0]);
    }

    public function testIsTemplateNameCorrectSetUp(): void
    {
        $this->viewMock->expects($this->once())
            ->method('setTemplate')
            ->with('category.tpl');
        $this->listController->renderView();
    }

    public function testIfParameterAddedToView(): void
    {
        $this->viewMock->expects(self::exactly(2))
            ->method('addTemplateParameter');
        $this->listController->setStrForLinks('test');
        $this->listController->renderView();
        $paramsInView = $this->viewMock->getParams();
        $expectedStrForLink = $this->listController->getStrForLinks()[0];
        self::assertSame($expectedStrForLink, $paramsInView[0]);


    }
}