<?php

declare(strict_types=1);

namespace App\Controller\BackendController;

use App\Controller\ControllerInterface;
use App\Core\ViewInterface;
use App\Model\ProductRepositoryInterface;

class AdminMainProductCategoryOverviewControll implements ControllerInterface
{
    public function __construct(
        private readonly ViewInterface $view,
        private readonly ProductRepositoryInterface $products,
    ) {
    }

    public function renderView(): void
    {
        $mainCategorys = $this->products->getAllMainCategorys();
        foreach ($mainCategorys as $row) {
            $mainCategorysArray[$row->mainId] = $row->displayName;
        }

        $this->view->addTemplateParameter('mainCategorys', $mainCategorysArray);

        $this->view->setTemplate('productMainCategoryOverviewAdmin.tpl');
    }
}