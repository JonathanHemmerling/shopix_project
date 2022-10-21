<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\View;
use App\Interfaces\ControllerInterface;
use App\Model\Products;

class ListControll implements ControllerInterface
{
    private bool $flag = false;
    private array $fullDataRecords;
    private array $strForCategoryLinks;
    private array $itemsForCategoryToDisplay;
    private Products $products;
    private readonly \Smarty $smarty;
    private View $view;

    public function __construct()
    {
        $this->products = new Products();
        $this->smarty = new \Smarty();
        $this->view = new View();
        $this->fullDataRecords = $this->getProductDataFromModel();
        $this->issetFlag();
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

    public function issetFlag()
    {
        if (isset($_GET['productId'])) {
            $this->flag = true;
        }
    }

    public function getView(): void
    {
        $this->getCategorysAsArr();
        $this->addCategoryParameterToView();
        $this->view->display('category.tpl', 'category', $this->itemsForCategoryToDisplay, $this->smarty);
    }
}