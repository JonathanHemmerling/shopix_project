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
        private readonly ProductRepositoryInterface $productRepository,
    ) {
    }

    public function renderView(): void
    {
        $mainCategory = $this->productRepository->getAllMainCategorys();
        foreach ($mainCategory as $row) {
            $mainCategoryDataSet[$row->mainId] = $row->displayName;
        }

        $this->view->addTemplateParameter('mainCategory', $mainCategoryDataSet);

        $this->view->setTemplate('productMainCategoryOverviewAdmin.tpl');
    }
}