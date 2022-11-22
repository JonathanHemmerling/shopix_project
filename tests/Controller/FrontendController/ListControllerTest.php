<?php

declare(strict_types=1);

namespace AppTest\FrontendController;

use App\Core\View;
use App\Model\Dto\ListDataTransferObject;
use App\Model\Mapper\ListMapper;
use App\Model\Mapper\ProductsMapper;
use App\Model\ProductRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ListControllerTest extends TestCase
{
    private MockObject $smartyMock;
    private MockObject $viewMock;
    private MockObject $productRepositoryMock;
    private \App\Controller\FrontendController\ListControll $listController;
    private MockObject $listDTOMock;

    public function setUp(): void
    {
        $_GET['productId'] = '1';
        $jsonPath = file_get_contents(__DIR__ . '/../jsons/List.json');
        $expectedJsonArray = json_decode($jsonPath, true);
        $this->listDTOMock = $this->getMockBuilder(ListDataTransferObject::class)
            ->setConstructorArgs(['categoryId' => 1, 'id' => 1, 'detail' => 'jeans_1', 'displayName' => 'Jeans 1'])
            ->getMock();
        $this->listMapperMock = $this->getMockBuilder(ListMapper::class)
            ->getMock();
        $this->listMapperMock->method('mapToListDto')
            ->willReturn($this->listDTOMock);
        $this->productsMapperMock = $this->getMockBuilder(ProductsMapper::class)
            ->getMock();
        $this->smartyMock = $this->getMockBuilder(\Smarty::class)
            ->getMock();
        $this->viewMock = $this->getMockBuilder(View::class)
            ->setConstructorArgs([$this->smartyMock])
            ->getMock();
        $this->viewMock->method('getParams')
            ->willReturn(['test']);
        $this->productRepositoryMock = $this->getMockBuilder(ProductRepository::class)
            ->setConstructorArgs(['List', $this->listMapperMock, $this->productsMapperMock])
            ->getMock();
        $this->productRepositoryMock->method('getAllDataFromJson')
            ->willReturn($expectedJsonArray);
        $this->productRepositoryMock->method('findCategoryById')
            ->with(1)
            ->willReturn(['index.php?page=Detail&sweatshirt_1&categoryId=2&id=1>Sweatshirt 1', 'index.php?page=Detail&sweatshirt_2&categoryId=2&id=2>Sweatshirt 2', 'index.php?page=Detail&sweatshirt_3&categoryId=2&id=3>Sweatshirt 3']);
        $this->listController = new \App\Controller\FrontendController\ListControll($this->viewMock, $this->productRepositoryMock);
    }

    public function tearDown(): void
    {
        unset($this->homeController, $this->productRepositoryMock, $this->viewMock, $this->smartyMock);
        $_GET = [];
    }

    public function testIsStrForLinkComposedCorrect(): void
    {
        $this->listController->renderView();
        $linkArray = $this->listController->getStrForLinks();
        $expectedLink = 'index.php?page=Detail&jeans_1&categoryId=1&id=1>Jeans 1';
        self::assertIsArray($linkArray);
        self::assertArrayHasKey(0, $linkArray);
        self::assertCount(3, $linkArray);
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