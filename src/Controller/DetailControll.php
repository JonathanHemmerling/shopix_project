<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\View;
use App\Interfaces\ControllerInterface;
use App\Model\Products;


class DetailControll implements ControllerInterface
{

    private array $strForProductName;
    private array $strForProductDescription;
    private string $pageId;
    private string $productId;
    private View $view;
    private Products $products;


    public function __construct(View $view, array $useData = [])
    {
        $this->pageId = $useData['categoryId'];
        $this->productId = $useData['id'];
        $this->products = new Products();
        $this->view = $view;
    }

    private function getProductDataFromModel(): array
    {
        return $this->products->getProductsFromJson();
    }

    private function getProductNameAsArray(): void
    {
        $productName = $this->getProductDataFromModel();
        foreach ($productName as $name) {
            if ($this->pageId === $name['categoryId'] && $this->productId === $name['id']) {
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
        $this->view->renderTemplate('product.tpl');
    }

}