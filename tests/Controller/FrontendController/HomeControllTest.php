<?php

declare(strict_types=1);

namespace AppTest\FrontendController;

use App\Controller\FrontendController\HomeControll;
use App\Core\View;
use App\Model\Dto\MainMenuDataTransferObject;
use App\Model\ProductRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class HomeControllTest extends TestCase
{
    private MockObject $smartyMock;
    private MockObject $viewMock;
    private MockObject $productRepositoryMock;
    private HomeControll $homeController;
    private MockObject $mainDTOMock;


    public function testIsLinkCorrect()
    {
        $this->mainDTOMock = $this->getMockBuilder(MainMenuDataTransferObject::class)
            ->setConstructorArgs([1, 'jeans', 'Jeans'])
            ->getMock();
        $this->smartyMock = $this->getMockBuilder(\Smarty::class)
            ->getMock();
        $this->viewMock = $this->getMockBuilder(View::class)
            ->setConstructorArgs([$this->smartyMock])
            ->getMock();
        $this->productRepositoryMock = $this->getMockBuilder(ProductRepository::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getAllDataFromMainTable'])
            ->getMock();
        $this->homeController = new HomeControll($this->viewMock, $this->productRepositoryMock);
        $this->productRepositoryMock->method('getAllDataFromMainTable')
            ->willReturn([$this->mainDTOMock]);
        $this->homeController->renderView();
        $expectedLink = '<a href="index.php?page=List&mainId=1&productGroup=jeans">Jeans</a>';
        $link = $this->homeController->getStrForLinks();
        self::assertSame($expectedLink, $link[0]);
    }
    public function testIsTemplateNameCorrectSetUp(): void
    {
        $this->smartyMock = $this->getMockBuilder(\Smarty::class)
            ->getMock();
        $this->viewMock = $this->getMockBuilder(View::class)
            ->setConstructorArgs([$this->smartyMock])
            ->onlyMethods(['setTemplate'])
            ->getMock();
        $this->productRepositoryMock = $this->getMockBuilder(ProductRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->homeController = new HomeControll($this->viewMock, $this->productRepositoryMock);
        $this->viewMock->expects($this->once())
            ->method('setTemplate')
            ->with('home.tpl');
        $this->homeController->setStrForLinks(
            '<a href="index.php?page=List&mainId= . Test . &productGroup= . Test . "> . Test . </a>'
        );
        $this->homeController->renderView();
    }

    public function testIfParameterAddedToView(): void
    {
        $this->smartyMock = $this->getMockBuilder(\Smarty::class)
            ->getMock();
        $this->viewMock = $this->getMockBuilder(View::class)
            ->setConstructorArgs([$this->smartyMock])
            ->onlyMethods(['getParams', 'addTemplateParameter'])
            ->getMock();
        $this->viewMock->method('getParams')
            ->willReturn(['test']);
        $this->productRepositoryMock = $this->getMockBuilder(ProductRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->homeController = new HomeControll($this->viewMock, $this->productRepositoryMock);
        $this->viewMock->expects(self::atLeastOnce())
            ->method('addTemplateParameter');
        $this->viewMock->expects($this->exactly(2))
            ->method('addTemplateParameter');
        $this->homeController->setStrforLinks('test');
        $this->homeController->renderView();
        $paramsInView = $this->viewMock->getParams();
        $expectedStrForLink = $this->homeController->getStrForLinks()[0];
        $this->assertSame($expectedStrForLink, $paramsInView[0]);
    }
}