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
    private array $strForMenuLinks;
    private MainMenu $mainMenu;
    private View $view;

    public function __construct(View $view)
    {
        $this->mainMenu = new MainMenu();
        $this->view = $view;

    }

    private function getMenuDataFromModel(): array
    {
        return $this->mainMenu->getMenuCategorysFromJson();
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
        $this->view->display('home.tpl');
    }

}