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
    public array $addCategoryParameterToView;
    private array $fullDataRecords;
    private array $strForCategoryLinks;
    private array $itemsForCategoryToDisplay;
    private Products $products;
    private readonly \Smarty $smarty;
    private View $view;

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

    public function getCategorysAsArr(): void
    {
        $productId = $_GET['productId'];
        $categoryContent = $this->fullDataRecords;
        foreach ($categoryContent as $categoryLink) {
            if ($productId === $categoryLink['categoryId']) {
                $this->strForCategoryLinks[] = 'index.php?page=Detail&' . $categoryLink['detail'] . '&categoryId=' . $categoryLink['categoryId'] . '&id=' . $categoryLink['id'] . '>' . $categoryLink['displayName'];
            }
        }
    }

    public function addCategoryParameterToView(): void
    {
        $this->view->addTemplateParameter('categoryHome', ['<a href="index.php">Home</a>']);
        $categoryStrArray = $this->strForCategoryLinks;
        $this->view->addTemplateParameter('categoryLink', $categoryStrArray);
    }


    public function getView(): void
    {
        $this->getCategorysAsArr();
        $this->addCategoryParameterToView();
        $this->view->display('category.tpl');
    }
}