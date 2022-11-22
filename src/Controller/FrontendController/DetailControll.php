<?php

declare(strict_types=1);

namespace App\Controller\FrontendController;

use App\Controller\ControllerInterface;
use App\Core\View;
use App\Model\ProductRepository;


class DetailControll implements ControllerInterface
{

    private array $strForProductName;
    private array $strForProductDescription;
    private View $view;
    private ProductRepository $products;
    private const HomeLink = ['<a href="index.php">Home</a>'];

    public function __construct(View $view, ProductRepository $products = new ProductRepository('Detail'))
    {
        $this->view = $view;
        $this->products = $products;
    }

    public function setStrForProductName(array $strForProductName): void
    {
        $this->strForProductName = $strForProductName;
    }

    public function getStrForProductName(): array
    {
        return $this->strForProductName;
    }

    public function getStrForProductDescription(): array
    {
        return $this->strForProductDescription;
    }

    private function addProductParameterToProductArray(): void
    {
        $pageId = (int)$_GET['categoryId'];
        $productId = (int)$_GET['id'];
        $singleProduct = $this->products->findProductById($pageId, $productId);
        $this->strForProductName[] = $singleProduct->displayName . ':';
        $this->strForProductDescription[] = $singleProduct->description;
    }

    private function addParameterToView(): void
    {
        $this->addProductParameterToProductArray();
        $this->view->addTemplateParameter('productHome', self::HomeLink);
        $this->view->addTemplateParameter('productName', $this->strForProductName);
        $this->view->addTemplateParameter('productDescription', $this->strForProductDescription);
    }

    public function renderView(): void
    {
        $this->addParameterToView();
        $this->view->setTemplate('product.tpl');
    }
}