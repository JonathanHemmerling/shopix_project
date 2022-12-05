<?php

declare(strict_types=1);

namespace AppTest\FrontendController;

use App\Controller\FrontendController\ListControll;
use App\Core\View;
use App\Model\Dto\SubMenuDataTransferObject;
use App\Model\Mapper\MainMenuMapper;
use App\Model\Mapper\ProductsMapper;
use App\Model\Mapper\SubMenuMapper;
use App\Model\ProductRepository;
use App\SQL\SqlConnection;
use PDO;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ListControllTest extends TestCase
{
    private MockObject $smartyMock;
    private MockObject $viewMock;
    private MockObject $productRepositoryMock;
    private ListControll $listController;
    private MockObject $listDTOMock;
    private $pdoMock;
    private $sqlConMock;


    public function testIsStrForLinkComposedCorrect(): void
    {
        $_GET['mainId'] = '1';
        $this->pdoMock = $this->getMockBuilder(PDO::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->sqlConMock = $this->getMockBuilder(SqlConnection::class)
            ->getMock();
        $this->listDTOMock = $this->getMockBuilder(SubMenuDataTransferObject::class)
            ->setConstructorArgs(['subId' => 1, 'productNames' => 'jeans_1', 'displayName' => 'Jeans 1'])
            ->getMock();
        $this->listMapperMock = $this->getMockBuilder(SubMenuMapper::class)
            ->getMock();
        $this->listMapperMock->method('mapToListDto')
            ->willReturn($this->listDTOMock);
        $this->mainMenuMapperMock = $this->getMockBuilder(MainMenuMapper::class)
            ->getMock();
        $this->productsMapperMock = $this->getMockBuilder(ProductsMapper::class)
            ->getMock();
        $this->smartyMock = $this->getMockBuilder(\Smarty::class)
            ->getMock();
        $this->viewMock = $this->getMockBuilder(View::class)
            ->setConstructorArgs([$this->smartyMock])
            ->onlyMethods(['addTemplateParameter', 'setTemplate'])
            ->getMock();
        $this->productRepositoryMock = $this->getMockBuilder(ProductRepository::class)
            ->setConstructorArgs(
                [
                    $this->sqlConMock,
                    $this->pdoMock,
                    $this->productsMapperMock,
                    $this->listMapperMock,
                    $this->mainMenuMapperMock,
                ]
            )
            ->getMock();
        $this->productRepositoryMock->method('getAllDataFromSubCategorys')
            ->with(1)
            ->willReturn(
                [$this->listDTOMock]
            );
        $this->listController = new ListControll($this->viewMock, $this->productRepositoryMock);

        $this->productRepositoryMock->expects($this->atLeastOnce())
            ->method('getAllDataFromSubCategorys');
        $this->listController->renderView();
        $link = $this->listController->getStrForLinks();
        $expectedLink = '<a href="index.php?page=Detail&subId=1&productName=jeans_1">Jeans 1</a>';
        $this->assertSame($link[0], $expectedLink);
    }

    public function testIfParameterAddedToView(): void
    {
        $_GET['mainId'] = '1';
        $this->pdoMock = $this->getMockBuilder(PDO::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->sqlConMock = $this->getMockBuilder(SqlConnection::class)
            ->getMock();
        $this->listDTOMock = $this->getMockBuilder(SubMenuDataTransferObject::class)
            ->setConstructorArgs(['subId' => 1, 'productNames' => 'jeans_1', 'displayName' => 'Jeans 1'])
            ->getMock();
        $this->listMapperMock = $this->getMockBuilder(SubMenuMapper::class)
            ->getMock();
        $this->listMapperMock->method('mapToListDto')
            ->willReturn($this->listDTOMock);
        $this->mainMenuMapperMock = $this->getMockBuilder(MainMenuMapper::class)
            ->getMock();
        $this->productsMapperMock = $this->getMockBuilder(ProductsMapper::class)
            ->getMock();
        $this->smartyMock = $this->getMockBuilder(\Smarty::class)
            ->getMock();
        $this->viewMock = $this->getMockBuilder(View::class)
            ->setConstructorArgs([$this->smartyMock])
            ->onlyMethods(['addTemplateParameter', 'setTemplate', 'getTemplate'])
            ->getMock();
        $this->productRepositoryMock = $this->getMockBuilder(ProductRepository::class)
            ->setConstructorArgs(
                [
                    $this->sqlConMock,
                    $this->pdoMock,
                    $this->productsMapperMock,
                    $this->listMapperMock,
                    $this->mainMenuMapperMock,
                ]
            )
            ->getMock();
        $this->productRepositoryMock->method('getAllDataFromSubCategorys')
            ->with(1)
            ->willReturn(
                [$this->listDTOMock]
            );
        $this->listController = new ListControll($this->viewMock, $this->productRepositoryMock);
        $this->viewMock->expects($this->atLeastOnce())
            ->method('addTemplateParameter');
        $this->viewMock->expects(self::exactly(3))
            ->method('addTemplateParameter');
        $this->viewMock->expects($this->once())
            ->method('setTemplate')
            ->with('category.tpl');
        $this->listController->renderView();
    }
}