<?php

declare(strict_types=1);

namespace AppTest\Controller;

use App\Controller\HomeControll;
use App\Core\View;
use App\Model\ProductRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class HomeControllerTest extends TestCase
{
    private MockObject $smartyMock;
    private MockObject $viewMock;
    private MockObject $productRepositoryMock;
    private HomeControll $homeController;

    public function setUp(): void
    {
        $jsonPath = file_get_contents(__DIR__ . '/../jsons/Home.json');
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

        $this->homeController = new HomeControll($this->viewMock, $this->productRepositoryMock);
    }

    public function tearDown(): void
    {
        unset($this->homeController, $this->productRepositoryMock, $this->viewMock, $this->smartyMock);
    }

    public function testIfDataRequestForJsonWorkedFine(): void
    {
        $jsonArray = $this->homeController->getDataFromModel();
        self::assertIsArray($jsonArray);
        self::assertArrayHasKey(0, $jsonArray);
        self::assertCount(3, $jsonArray);
    }

    public function testIsStrForLinkComposedCorrect(): void
    {
        $this->homeController->renderView();
        $linkArray = $this->homeController->getStrForLinks();
        $expectedLink = "index.php?page=List&sweatshirts&productId=2>Sweatshirts";
        self::assertIsArray($linkArray);
        self::assertArrayHasKey(1, $linkArray);
        self::assertCount(3, $linkArray);
        self::assertSame($expectedLink, $linkArray[1]);
    }

    public function testIsTemplateNameCorrectSetUp(): void
    {
        $this->viewMock->expects($this->once())
            ->method('setTemplate')
            ->with('home.tpl');
        $this->homeController->renderView();
    }

    public function testIfParameterAddedToView(): void
    {
        $this->viewMock->expects(self::once())
            ->method('addTemplateParameter');
        $this->homeController->setStrforLinks('test');
        $this->homeController->renderView();
        $paramsInView = $this->viewMock->getParams();
        $expectedStrForLink = $this->homeController->getStrForLinks()[0];
        $this->assertSame($expectedStrForLink, $paramsInView[0]);
    }
}