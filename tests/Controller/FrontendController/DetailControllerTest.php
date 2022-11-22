<?php

declare(strict_types=1);

namespace AppTest\FrontendController;

use App\Core\View;
use App\Model\Dto\ProductsDataTransferObject;
use App\Model\Mapper\ListMapper;
use App\Model\Mapper\ProductsMapper;
use App\Model\ProductRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;


class DetailControllerTest extends TestCase
{
    private MockObject $smartyMock;
    private MockObject $viewMock;
    private MockObject $productRepositoryMock;
    private \App\Controller\FrontendController\DetailControll $detailController;
    private MockObject $listMapperMock;
    private MockObject $productsMapperMock;
    private MockObject $productsDTOMock;

    public function setUp(): void
    {
        $_GET['categoryId'] = '2';
        $_GET['id'] = '1';
        $jsonPath = file_get_contents(__DIR__ . '/../jsons/Detail.json');
        $expectedJsonArray = json_decode($jsonPath, true);
        $this->productsDTOMock = $this->getMockBuilder(ProductsDataTransferObject::class)
            ->setConstructorArgs(
                ['categoryId' => 2, 'detail' => 'jeans_1', 'displayName' => 'Jeans 1', 'description' => 'Test Jeans 1']
            )
            ->getMock();
        $this->listMapperMock = $this->getMockBuilder(ListMapper::class)
            ->getMock();
        $this->productsMapperMock = $this->getMockBuilder(ProductsMapper::class)
            ->getMock();
        $this->productsMapperMock->method('mapToProductsDto')
            ->willReturn($this->productsDTOMock);
        $this->smartyMock = $this->getMockBuilder(\Smarty::class)
            ->getMock();
        $this->viewMock = $this->getMockBuilder(View::class)
            ->setConstructorArgs([$this->smartyMock])
            ->getMock();
        $this->viewMock->method('getParams')
            ->willReturn(['test']);
        $this->productRepositoryMock = $this->getMockBuilder(ProductRepository::class)
            ->setConstructorArgs(['Detail', $this->listMapperMock, $this->productsMapperMock])
            ->getMock();
        $this->productRepositoryMock->method('getAllDataFromJson')
            ->willReturn($expectedJsonArray);
        $this->productRepositoryMock->method('findProductById')
            ->with(2, 1)
            ->willReturn($this->productsDTOMock);
        $this->detailController = new \App\Controller\FrontendController\DetailControll($this->viewMock, $this->productRepositoryMock);
    }

    public function tearDown(): void
    {
        unset($this->detailController, $this->productRepositoryMock, $this->viewMock, $this->smartyMock);
        $_GET = [];
    }

    public function testIfDataRequestForJsonWorkedFine(): void
    {
        $this->detailController->renderView();
        $productNameArray = $this->detailController->getStrForProductName();
        $productDescriptionArray = $this->detailController->getStrForProductDescription();
        self::assertIsArray($productNameArray);
        self::assertArrayHasKey(0, $productNameArray);
        self::assertCount(1, $productNameArray);
        self::assertIsArray($productDescriptionArray);
        self::assertArrayHasKey(0, $productDescriptionArray);
        self::assertCount(1, $productDescriptionArray);
    }

    public function testIsStrForLinkComposedCorrect(): void
    {
        $this->detailController->renderView();
        $linkArray = $this->detailController->getStrForProductName();
        $expectedLink = 'Jeans 1:';
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