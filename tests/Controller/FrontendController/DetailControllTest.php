<?php

declare(strict_types=1);

namespace AppTest\FrontendController;

use App\Controller\FrontendController\DetailControll;
use App\Core\View;
use App\Model\Dto\ProductsDataTransferObject;
use App\Model\Mapper\MainMenuMapper;
use App\Model\Mapper\ProductsMapper;
use App\Model\Mapper\SubMenuMapper;
use App\Model\ProductRepository;
use App\SQL\SqlConnection;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;


class DetailControllTest extends TestCase
{
    private MockObject $smartyMock;
    private MockObject $viewMock;
    private MockObject $productRepositoryMock;
    private MockObject $productsMapperMock;
    private MockObject $productsDTOMock;
    private MockObject $pdoMock;
    private $sqlConMock;
    private DetailControll $detailControll;


    public function testIfProductsAreLoadedAndDisplayed()
    {
        $this->listMapperMock = $this->getMockBuilder(SubMenuMapper::class)
            ->getMock();
        $this->mainMenuMapperMock = $this->getMockBuilder(MainMenuMapper::class)
            ->getMock();
        $this->sqlConMock = $this->getMockBuilder(SqlConnection::class)
            ->getMock();
        $this->pdoMock = $this->getMockBuilder(\PDO::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->smartyMock = $this->getMockBuilder(\Smarty::class)
            ->getMock();
        $this->viewMock = $this->getMockBuilder(View::class)
            ->setConstructorArgs([$this->smartyMock])
            ->onlyMethods(['addTemplateParameter', 'getParams'])
            ->getMock();
        $this->productsMapperMock = $this->getMockBuilder(ProductsMapper::class)
            ->getMock();
        $this->productRepositoryMock = $this->getMockBuilder(ProductRepository::class)
            ->setConstructorArgs([$this->sqlConMock, $this->pdoMock, $this->productsMapperMock, $this->listMapperMock, $this->mainMenuMapperMock])
            ->onlyMethods(['getAllDataFromProducts'])
            ->getMock();
        $this->productsDTOMock = $this->getMockBuilder(ProductsDataTransferObject::class)
            ->setConstructorArgs(
                ['displayName' => 'TestProduct', 'productDescription' => 'TestDescription', 'price' => '10']
            )
            ->getMock();
        $this->productRepositoryMock->method('getAllDataFromProducts')
            ->willReturn($this->productsDTOMock);
        $this->detailControll = new DetailControll($this->viewMock, $this->productRepositoryMock);

        $this->detailControll->setStrForPrice(['10']);
        $this->detailControll->setStrForProductDescription(['TestDescription']);
        $this->detailControll->setStrForProductName(['TestProduct']);
        $_GET['subId'] = '1';
        $this->productRepositoryMock->expects($this->atLeastOnce())
            ->method('getAllDataFromProducts');

        $this->viewMock->expects($this->atLeastOnce())
            ->method('addTemplateParameter');
        $this->viewMock->expects(self::exactly(5))
            ->method('addTemplateParameter');
        $this->detailControll->renderView();
    }

    public function testIsTemplateNameCorrectSetUp(): void
    {
        $_GET['subId'] = '1';
        $this->listMapperMock = $this->getMockBuilder(SubMenuMapper::class)
            ->getMock();
        $this->mainMenuMapperMock = $this->getMockBuilder(MainMenuMapper::class)
            ->getMock();
        $this->sqlConMock = $this->getMockBuilder(SqlConnection::class)
            ->getMock();
        $this->pdoMock = $this->getMockBuilder(\PDO::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->smartyMock = $this->getMockBuilder(\Smarty::class)
            ->getMock();
        $this->viewMock = $this->getMockBuilder(View::class)
            ->setConstructorArgs([$this->smartyMock])
            ->onlyMethods(['addTemplateParameter', 'getParams', 'setTemplate'])
            ->getMock();
        $this->productsMapperMock = $this->getMockBuilder(ProductsMapper::class)
            ->getMock();
        $this->productRepositoryMock = $this->getMockBuilder(ProductRepository::class)
            ->setConstructorArgs([$this->sqlConMock, $this->pdoMock, $this->productsMapperMock, $this->listMapperMock, $this->mainMenuMapperMock])
            ->onlyMethods(['getAllDataFromProducts'])
            ->getMock();
        $this->productsDTOMock = $this->getMockBuilder(ProductsDataTransferObject::class)
            ->setConstructorArgs(
                ['displayName' => 'TestProduct', 'productDescription' => 'TestDescription', 'price' => '10']
            )
            ->getMock();
        $this->productRepositoryMock->method('getAllDataFromProducts')
            ->willReturn($this->productsDTOMock);
        $this->detailControll = new DetailControll($this->viewMock, $this->productRepositoryMock);

        $this->viewMock->expects($this->once())
            ->method('setTemplate')
            ->with('product.tpl');
        $this->detailControll->renderView();
    }

    public function testIsStrForLinkComposedCorrect(): void
    {
        $_GET['subId'] = '1';
        $this->listMapperMock = $this->getMockBuilder(SubMenuMapper::class)
            ->getMock();
        $this->mainMenuMapperMock = $this->getMockBuilder(MainMenuMapper::class)
            ->getMock();
        $this->sqlConMock = $this->getMockBuilder(SqlConnection::class)
            ->getMock();
        $this->pdoMock = $this->getMockBuilder(\PDO::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->smartyMock = $this->getMockBuilder(\Smarty::class)
            ->getMock();
        $this->viewMock = $this->getMockBuilder(View::class)
            ->setConstructorArgs([$this->smartyMock])
            ->onlyMethods(['addTemplateParameter', 'getParams'])
            ->getMock();
        $this->productsMapperMock = $this->getMockBuilder(ProductsMapper::class)
            ->getMock();
        $this->productRepositoryMock = $this->getMockBuilder(ProductRepository::class)
            ->setConstructorArgs([$this->sqlConMock, $this->pdoMock, $this->productsMapperMock, $this->listMapperMock, $this->mainMenuMapperMock])
            ->onlyMethods(['getAllDataFromProducts'])
            ->getMock();
        $this->productsDTOMock = $this->getMockBuilder(ProductsDataTransferObject::class)
            ->setConstructorArgs(
                ['displayName' => 'TestProduct', 'productDescription' => 'TestDescription', 'price' => '10']
            )
            ->getMock();
        $this->productRepositoryMock->method('getAllDataFromProducts')
            ->willReturn($this->productsDTOMock);
        $this->detailControll = new DetailControll($this->viewMock, $this->productRepositoryMock);

        $this->detailControll->setStrForPrice(['10']);
        $this->detailControll->setStrForProductDescription(['TestDescription']);
        $this->detailControll->setStrForProductName(['TestProduct']);
        $this->detailControll->renderView();
        $productName = $this->detailControll->getStrForProductName();
        $expectedName = 'TestProduct:';
        self::assertIsArray($productName);
        self::assertArrayHasKey(0, $productName);
        self::assertCount(1, $productName);
        self::assertSame($expectedName, $productName[0]);

        $productDescription = $this->detailControll->getStrForProductDescription();
        $expectedDescription = 'TestDescription';
        self::assertIsArray($productDescription);
        self::assertArrayHasKey(0, $productDescription);
        self::assertCount(1, $productDescription);
        self::assertSame($expectedDescription, $productDescription[0]);

        $productPrice = $this->detailControll->getStrForPrice();
        $expectedPrice = '10';
        self::assertIsArray($productPrice);
        self::assertArrayHasKey(0, $productPrice);
        self::assertCount(1, $productPrice);
        self::assertSame($expectedPrice, $productPrice[0]);

        self::assertSame((int)$_GET['subId'], 1);
    }

}