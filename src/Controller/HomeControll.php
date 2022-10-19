<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\View;
use App\Model\MainMenu;

class HomeControll
{
    private array $strForMenuLinks = [];
    private array $itemsForMenuToDisplay = [];
    private readonly \Smarty $smarty;
    private View $view;

    public function __construct()
    {
        $this->smarty = new \Smarty();
        $this->view = new View();
        $this->addParameterToView();
        $this->getView();
    }

    private function getMenuDataFromModel(): array
    {
        return (new MainMenu())->getMenuCategorysFromJson();
    }

    public function getMenuAsArr(): array
    {
        $menuContent = $this->getMenuDataFromModel();
        foreach ($menuContent as $menuLink) {
            $this->strForMenuLinks[] = 'index.php?page=' . $menuLink['category'] . '&productId=' . $menuLink['id'] . '>' . $menuLink['displayName'];
        }
        return $this->strForMenuLinks;
    }

    public function addParameterToView(): array
    {
        $menuStrArray = $this->getMenuAsArr();
        foreach ($menuStrArray as $menuStr) {
            $this->itemsForMenuToDisplay[] = $this->view->addTemplateParameter($menuStr);
        }
        return $this->itemsForMenuToDisplay;
    }

    public function getView(): void
    {
        if (!isset($_GET['page'])) {
            $this->view->display('index.tpl','menu', $this->itemsForMenuToDisplay, $this->smarty);
        }
    }
}