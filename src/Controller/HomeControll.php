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
    private array $fullDataRecords;
    private array $strForMenuLinks;
    private MainMenu $mainMenu;
    private View $view;

    public function __construct()
    {
        $this->mainMenu = new MainMenu();
        $this->view = new View(new \Smarty());
        $this->fullDataRecords = $this->getMenuDataFromModel();
        $this->getView();
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

    public function addParameterToView(): void
    {
        $menuStrArray = $this->strForMenuLinks;
        $this->view->addTemplateParameter('menu', $menuStrArray);
    }

    public function getView(): void
    {
        $this->getMenuAsArr();
        $this->addParameterToView();
        $this->view->display('home.tpl');
    }

}