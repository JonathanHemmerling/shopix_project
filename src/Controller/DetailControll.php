<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\View;
use App\Interfaces\ControllerInterface;
use App\Model\Products;


class DetailControll implements ControllerInterface
{
    private array $fullDataRecords;
    private array $itemsForProductToDisplay;
    private array $strForProductName;
    private array $strForProductDescription;
    private View $view;
    private readonly \Smarty $smarty;
    private Products $products;


    public function __construct()
    {
        $this->products = new Products();
        $this->smarty = new \Smarty();
        $this->view = new View();
        $this->fullDataRecords = $this->getProductDataFromModel();
        $this->getView();
    }

    public function getProductDataFromModel(): array
    {
        return $this->products->getProductsFromJson();
    }

    public function getProductNameAsArray(): void
    {
        $pageName = $_GET['page'];
        $pageId = $_GET['productId'];
        $productId = $_GET['id'];
        $productName = $this->fullDataRecords;
        foreach ($productName as $name) {
            if ($pageName === 'Detail' && $pageId === $name['productId'] && $productId == $name['id']) {
                $this->strForProductName[] = $name['displayName'] . ':';
                $this->strForProductDescription[] = $name['description'];
            }
        }
    }

    public function addProductNameParameterToView(): array
    {
        $this->itemsForProductToDisplay[] = $this->view->addTemplateParameter('<a href="index.php">Home</a>');
        $productNameStrArray = $this->strForProductName;
        foreach ($productNameStrArray as $productNameStr) {
            $this->itemsForProductToDisplay['id'] = $this->view->addTemplateParameter($productNameStr);
        }
        $productDescriptionStrArray = $this->strForProductDescription;
        foreach ($productDescriptionStrArray as $productDescriptionStr) {
            $this->itemsForProductToDisplay['value'] = $this->view->addTemplateParameter($productDescriptionStr);
        }
        return $this->itemsForProductToDisplay;
    }

    public function getView(): void
    {
        $this->getProductNameAsArray();
        $this->addProductNameParameterToView();
        $this->view->display('product.tpl', 'product', $this->itemsForProductToDisplay, $this->smarty);
    }
}