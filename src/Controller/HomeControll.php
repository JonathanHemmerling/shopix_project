<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\View;
use App\Interfaces\ControllerInterface;
use App\Model\MainMenu;

class HomeControll implements ControllerInterface
{
    /**
     * @var string[]
     */
    public array $addParameterToView;
    private array $fullDataRecords;
    private array $itemsForMenuToDisplay;
    private array $strForMenuLinks;
    private MainMenu $mainMenu;
    private readonly \Smarty $smarty;
    private View $view;

    public function __construct()
    {
        $this->mainMenu = new MainMenu();
        $this->smarty = new \Smarty();
        $this->view = new View();
        $this->fullDataRecords = $this->getMenuDataFromModel();
        //$this->getView();
    }

    private function getMenuDataFromModel(): array
    {
        return $this->mainMenu->getMenuCategorysFromJson();
    }

    public function getMenuAsArr(): void
    {
        $menuContent = $this->fullDataRecords;
        foreach ($menuContent as $menuLink) {
            $this->strForMenuLinks[] = 'index.php?page=List&' . $menuLink['category'] . '&productId=' . $menuLink['id'] . '>' . $menuLink['displayName'];
        }
    }

    public function addParameterToView(): array
    {
        $menuStrArray = $this->strForMenuLinks;
        foreach ($menuStrArray as $menuStr) {
            $this->itemsForMenuToDisplay[] = $this->view->addTemplateParameter($menuStr);
        }
        return $this->itemsForMenuToDisplay;
    }

    public function getView(): void
    {
        $this->getMenuAsArr();
        $this->addParameterToView();
        $this->view->display('home.tpl', 'menu', $this->itemsForMenuToDisplay, $this->smarty);
    }

}