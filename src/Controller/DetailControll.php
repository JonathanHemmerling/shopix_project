<?php
declare(strict_types=1);

namespace App\Controller;

use App\Core\View;
use App\Model\Products;


class DetailControll{
    private View $view;
    private \Smarty $smarty;
    private Products $products;
    private array $allProducts;

    public function __construct()
    {
        $this->products = new Products();
        $this->smarty = new \Smarty();
        $this->view = new View();
        $this->allProducts = $this->getProductDataFromModel();
        $this->getView();
    }
    public function getProductDataFromModel(): array
    {
        return $this->products ->getProductsFromJson();
    }
    public function getProductNameAsArray(): void
    {
        $pageId = $_GET['id'];
        $detail =$_GET['page'];
        foreach ($this->allProducts as $name) {
            if ($pageId === $name['id'] && $detail === $name['detail']) {
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