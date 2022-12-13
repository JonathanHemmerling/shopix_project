<?php

declare(strict_types=1);

namespace App\Controller\FrontendController;

use App\Controller\ControllerInterface;
use App\Core\ViewInterface;
use App\Model\ProductRepositoryInterface;

class HomeControll  implements ControllerInterface
{

    private array $strForLinks;

    public function __construct(private ViewInterface $view, private ProductRepositoryInterface $mainMenu)
    {
    }

    public function renderView(): void
    {
        $menuContent = $this->mainMenu->getAllMainCategorysFromDatabase();
        foreach ($menuContent as $menuElement) {
            $mainId = $menuElement->mainId;
            $mainName = $menuElement->mainName;
            $displayName = $menuElement->displayName;
            $this->strForLinks [] = (
                '<a href="index.php?page=List&mainId=' . $mainId . '&mainName=' . $mainName . '">' . $displayName . '</a>'
            );
        }
        $this->view->addTemplateParameter('menu', $this->strForLinks);
        $this->view->setTemplate('home.tpl');
    }
}