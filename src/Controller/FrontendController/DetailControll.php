<?php

declare(strict_types=1);

namespace App\Controller\FrontendController;

use App\Controller\ControllerInterface;
use App\Core\ViewInterface;
use App\Model\ProductRepositoryInterface;


class DetailControll implements DetailControllInterface
{

    private array $strForProductName;
    private array $strForProductDescription;
    private array $strForPrice;
    private const HomeLink = ['<a href="index.php">Home</a>'];
    private const changeUserData = ['<a href="index.php?pageb=ChangeUser">Change Userdata</a>'];

    public function __construct(
        private ViewInterface $view,
        private ProductRepositoryInterface $products
    )
    {
    }

    public function setStrForProductName(array $strForProductName): void
    {
        $this->strForProductName = $strForProductName;
    }

    public function getStrForProductName(): array
    {
        return $this->strForProductName;
    }

    public function getStrForProductDescription(): array
    {
        return $this->strForProductDescription;
    }

    private function addProductParameterToProductArray(): void
    {
        $pageId = (int)$_GET['subId'];
        $singleProduct = $this->products->getAllDataFromProducts($pageId);
        //foreach ($singleProduct as $product) {
            $this->strForProductName[] = $singleProduct->displayName . ':';
            $this->strForProductDescription[] = $singleProduct->productDescription;
            $this->strForPrice[] = $singleProduct->price;
        //}
    }

    private function addParameterToView(): void
    {
        $this->addProductParameterToProductArray();
        $this->view->addTemplateParameter('productHome', self::HomeLink);
        $this->view->addTemplateParameter('productName', $this->strForProductName);
        $this->view->addTemplateParameter('productDescription', $this->strForProductDescription);
        $this->view->addTemplateParameter('price', $this->strForPrice);
        $this->view->addTemplateParameter('changeUserData', self::changeUserData);
    }

    public function renderView(): void
    {
        $this->addParameterToView();
        $this->view->setTemplate('product.tpl');
    }
}