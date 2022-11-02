<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\View;
use App\Interfaces\ControllerInterface;
use App\Model\Products;

class ListControll implements ControllerInterface
{
    /**
     * @var string[]
     */
    private array $strForCategoryLinks;
    private Products $products;
    private View $view;

    public function __construct(View $view)
    {
        $this->products = new Products();
        $this->view = $view;
    }

    private function getProductDataFromModel(): array
    {
        return $this->products->getProductsFromJson();
    }

    private function getCategorysAsArr(): void
    {
        $productId = $_GET['productId'];
        $categoryContent = $this->getProductDataFromModel();;
        foreach ($categoryContent as $categoryLink) {
            if ($productId === $categoryLink['categoryId']) {
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
        $this->view->display('category.tpl');
    }
}