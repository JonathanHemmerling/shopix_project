<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\View;
use App\Model\ProductRepository;
use App\Model\Products;


class DetailControll implements ControllerInterface
{

    private array $strForProductName;
    private array $strForProductDescription;
    private View $view;
    private ProductRepository $products;


    public function __construct(View $view, ProductRepository $products)
    {
        $this->products = $products;
        $this->view = $view;
        $this->renderView();
    }

    private function getProductDataFromModel(): array
    {
        return $this->products->getAllDataFromJson();
    }

    private function getProductNameAsArray(): void
    {
        $pageId = $_GET['categoryId'];
        $productId = $_GET['id'];

        $productName = $this->getProductDataFromModel();
        foreach ($productName as $name) {
            if ($pageId === $name['categoryId'] && $productId === $name['id']) {
                $this->strForProductName[] = $name['displayName'] . ':';
                $this->strForProductDescription[] = $name['description'];
            }
        }
    }

    private function addProductNameParameterToView(): void
    {
        $this->getProductNameAsArray();
        $this->view->addTemplateParameter('productHome', ['<a href="index.php">Home</a>']);
        $productNameStrArray = $this->strForProductName;
        $this->view->addTemplateParameter('productName', $productNameStrArray);

        $productDescriptionStrArray = $this->strForProductDescription;
        $this->view->addTemplateParameter('productDescription', $productDescriptionStrArray);
    }

    public function renderView(): void
    {
        $this->addProductNameParameterToView();
        $this->view->setTemplate('product.tpl');
    }

}