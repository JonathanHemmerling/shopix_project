<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\View;
use App\Interfaces\ControllerInterface;
use App\Model\Products;


class DetailControll implements ControllerInterface
{
    private array $fullDataRecords;
    private array $strForProductName;
    private array $strForProductDescription;
    private View $view;
    private Products $products;


    public function __construct()
    {
        $this->products = new Products();
        $this->view = new View(new \Smarty());
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
        $pageId = $_GET['categoryId'];
        $productId = $_GET['id'];
        $productName = $this->fullDataRecords;
        foreach ($productName as $name) {
            if ($pageName === 'Detail' && $pageId === $name['categoryId'] && $productId == $name['id']) {
                $this->strForProductName[] = $name['displayName'] . ':';
                $this->strForProductDescription[] = $name['description'];
            }
        }
    }

    public function addProductNameParameterToView(): void
    {
        $this->view->addTemplateParameter('productHome', ['<a href="index.php">Home</a>']);
        $productNameStrArray = $this->strForProductName;
        $this->view->addTemplateParameter('productName', $productNameStrArray);

        $productDescriptionStrArray = $this->strForProductDescription;
        $this->view->addTemplateParameter('productDescription', $productDescriptionStrArray);
    }

    public function getView(): void
    {
        $this->getProductNameAsArray();
        $this->addProductNameParameterToView();
        $this->view->display('product.tpl');
    }
}