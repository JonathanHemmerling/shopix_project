<?php

declare(strict_types=1);

namespace App\Controller\FrontendController;

use App\Controller\ControllerInterface;
use App\Core\ViewInterface;
use App\Model\ProductRepositoryInterface;

class HomeControll implements ControllerInterface
{
    private array $strForLinks;

    public function __construct(
        private readonly ViewInterface $view,
        private readonly ProductRepositoryInterface $mainMenuRepository
    ) {
    }

    public function renderView(): void
    {
        $allMenuCategorys = $this->mainMenuRepository->getAllMainCategorys();
        foreach ($allMenuCategorys as $singleMenuElement) {
            $this->strForLinks [] = (
                '<a href="index.php?page=UserProductCategoryOverview&mainId=' . $singleMenuElement->mainId . '">' . $singleMenuElement->displayName . '</a>'
            );
        }
        $this->view->addTemplateParameter('menu', $this->strForLinks);
        $this->view->setTemplate('home.tpl');
    }
}