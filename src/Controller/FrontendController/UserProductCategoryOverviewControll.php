<?php

declare(strict_types=1);

namespace App\Controller\FrontendController;

use App\Controller\ControllerInterface;
use App\Core\View;
use App\Model\ProductRepository;

class UserProductCategoryOverviewControll implements ControllerInterface
{

    private array $strForLinks = [];

    public function __construct(private readonly View $view, private readonly ProductRepository $productRepository)
    {
    }

    public function renderView(): void
    {
        $mainId = (int)$_GET['mainId'];
        $productDataSet = $this->productRepository->getProductByMainId($mainId);
        foreach ($productDataSet as $element) {
            $this->strForLinks[$element->productId] = $element->displayName;
        }
        $this->view->addTemplateParameter('categoryLink', $this->strForLinks);
        $this->view->setTemplate('productCategoryOverview.tpl');
    }
}