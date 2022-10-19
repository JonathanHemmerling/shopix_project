<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\View;
use App\Model\Products;

class ListControll
{
    private array $allProducts;
    private Products $products;
    private \Smarty $smarty;
    private View $view;

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
    public function getCategorysAsArr(): void
    {
        $productId = $_GET['productId'];
        foreach ($this->allProducts as $categoryLink) {
            if ($productId === $categoryLink['productId']) {
                $this->strForCategoryLinks[] = 'index.php?page=' . $categoryLink['detail'] . '&id=' . $categoryLink['id'] . '>' . $categoryLink['displayName'];
            }
        }
    }

    public function addCategoryParameterToView(): array
    {
        $this->itemsForCategoryToDisplay[] = $this->view->addTemplateParameter('<a href="index.php">Home</a>');
        $categoryStrArray = $this->strForCategoryLinks;
        foreach ($categoryStrArray as $categoryStr) {
            $this->itemsForCategoryToDisplay[] = $this->view->addTemplateParameter($categoryStr);
        }
        return $this->itemsForCategoryToDisplay;
    }

    public function getView(): void
    {
        $this->getCategorysAsArr();
        $this->addCategoryParameterToView();
        $this->view->display('category.tpl', 'category', $this->itemsForCategoryToDisplay, $this->smarty);
    }
}