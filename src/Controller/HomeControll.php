<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\View;
use App\Model\ProductRepository;

class HomeControll implements ControllerInterface
{

    private array $strForMenuLinks;
    private View $view;
    private ProductRepository $mainMenu;

    public function __construct(View $view, ProductRepository $mainMenu)
    {
        $this->mainMenu = $mainMenu;
        $this->view = $view;
        $this->renderView();
    }

    private function getMenuDataFromModel(): array
    {
        return $this->mainMenu->getAllDataFromJson();
    }

    private function getMenuAsArr(): void
    {
        $menuContent = $this->getMenuDataFromModel();
        foreach ($menuContent as $menuLink) {
            $this->strForMenuLinks[] = 'index.php?page=List&' . $menuLink['category'] . '&productId=' . $menuLink['id'] . '>' . $menuLink['displayName'];
        }
    }

    private function addParameterToView(): void
    {
        $this->getMenuAsArr();
        $menuStrArray = $this->strForMenuLinks;
        $this->view->addTemplateParameter('menu', $menuStrArray);
    }

    public function renderView(): void
    {
        $this->addParameterToView();
        $this->view->setTemplate('home.tpl');
    }
}