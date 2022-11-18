<?php

declare(strict_types=1);

namespace App\FrontendController;

use App\Core\View;
use App\Model\ProductRepository;
use App\Model\Products;

class ListControll implements ControllerInterface
{

    private array $strForLinks;
    private ProductRepository $products;
    private View $view;
    private const HomeLink = ['<a href="index.php">Home</a>'];

    public function __construct(View $view, ProductRepository $products = new ProductRepository('List'))
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
        return $this->products->getAllDataFromJson();
    }

    private function addCategorysToLinkArray(): void
    {
        $urlId = (int)$_GET['productId'];
        $listcategory = $this->products->findCategoryById($urlId);
        foreach ($listcategory as $listElement){
            $this->setStrForLinks($listElement);
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