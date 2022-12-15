<?php

declare(strict_types=1);

namespace App\Controller\FrontendController;

use App\Controller\ControllerInterface;
use App\Core\View;
use App\Model\ProductRepository;

class UserProductCategoryOverviewControll implements ControllerInterface
{

    private array $strForLinks = [];

    public function __construct(private readonly View $view, private readonly ProductRepository $products)
    {
    }

    public function renderView(): void
    {
        $mainId = (int)$_GET['mainId'];
        $listContent = $this->products->getProductByMainId($mainId);
        foreach ($listContent as $listElement) {
            $this->strForLinks[$listElement->productId] = $listElement->displayName;
        }
        $this->view->addTemplateParameter('categoryLink', $this->strForLinks);
        $this->view->setTemplate('productCategoryOverview.tpl');
    }
}