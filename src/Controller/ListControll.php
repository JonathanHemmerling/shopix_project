<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\View;
use App\Model\ProductRepository;
use App\Model\Products;

class ListControll implements ControllerInterface
{

    private array $strForLinks;
    private string $productId;
    private ProductRepository $products;
    private View $view;
    private const HomeLink = ['<a href="index.php">Home</a>'];

    public function __construct(View $view, ProductRepository $products)
    {
        $this->productId = $_GET['productId'];
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
        $categoryContent = $this->getDataFromModel();
        foreach ($categoryContent as $categoryLink) {
            if ($this->productId === $categoryLink['categoryId']) {
                $this->setStrForLinks(
                    'index.php?page=Detail&' . $categoryLink['detail'] . '&categoryId=' . $categoryLink['categoryId'] . '&id=' . $categoryLink['id'] . '>' . $categoryLink['displayName']
                );
            }
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