<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\View;
use App\Model\ProductRepository;
use App\Model\Products;

class ListControll implements ControllerInterface
{

    private array $strForCategoryLinks;
    private string $productId;
    private ProductRepository $products;
    private View $view;

    public function __construct(View $view, ProductRepository $products)
    {
        $this->productId = $_GET['productId'];
        $this->products = $products;
        $this->view = $view;
        $this->renderView();
    }

    private function getProductDataFromModel(): array
    {
        return $this->products->getAllDataFromJson();
    }

    private function getCategorysAsArr(): void
    {
        $categoryContent = $this->getProductDataFromModel();
        foreach ($categoryContent as $categoryLink) {
            if ($this->productId === $categoryLink['categoryId']) {
                $this->strForCategoryLinks[] = 'index.php?page=Detail&' . $categoryLink['detail'] . '&categoryId=' . $categoryLink['categoryId'] . '&id=' . $categoryLink['id'] . '>' . $categoryLink['displayName'];
            }
        }
    }

    private function addCategoryParameterToView(): void
    {
        $this->getCategorysAsArr();
        $this->view->addTemplateParameter('categoryHome', ['<a href="index.php">Home</a>']);
        $categoryStrArray = $this->strForCategoryLinks;
        $this->view->addTemplateParameter('categoryLink', $categoryStrArray);
    }

    public function renderView(): void
    {
        $this->addCategoryParameterToView();
        $this->view->setTemplate('category.tpl');
    }
}