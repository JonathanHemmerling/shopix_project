<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\View;
use App\Model\ProductRepository;
use App\Model\Products;

class ListControll implements ControllerInterface
{

    private array $strForLinks;
    private ProductRepository $products;
    private View $view;
    private const HomeLink = ['<a href="index.php">Home</a>'];

    public function __construct(View $view, ProductRepository $products)
    {
        $this->products = $products;
        $this->view = $view;
    }

    public function getStrForLinks(): array
    {
        return $this->strForLinks;
    }

    public function setStrForLinks(string $strForLinks): void
    {
        $this->strForLinks[] = $strForLinks;
    }

    public function getDataFromModel(): array
    {
        return $this->products->getJsonFileContent();
    }

    private function addCategorysToLinkArray(): void
    {
        $urlId = (int)$_GET['productId'];
        $listRep = new ProductRepository('List');
        $listcategory = $listRep->findCategoryById($urlId);
        foreach ($listcategory as $categoryElement) {
            $categoryDetail = $categoryElement->detail;
            $categoryId = $categoryElement->categoryId;
            $id = $categoryElement->id;
            $displayName = $categoryElement->displayName;
            $this->setStrForLinks(
                'index.php?page=Detail&' . $categoryDetail . '&categoryId=' . $categoryId . '&id=' . $id . '>' . $displayName
            );
        }
    }
    private function addCategoryParameterToView(): void
    {
        $this->addCategorysToLinkArray();
        $this->view->addTemplateParameter('categoryHome', self::HomeLink);
        $this->view->addTemplateParameter('categoryLink', $this->strForLinks);
    }

    public function renderView(): void
    {
        $this->addCategoryParameterToView();
        $this->view->setTemplate('category.tpl');
    }
}