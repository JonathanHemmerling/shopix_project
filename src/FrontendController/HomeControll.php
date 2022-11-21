<?php

declare(strict_types=1);

namespace App\FrontendController;

use App\Core\View;
use App\Model\ProductRepository;

class HomeControll implements ControllerInterface
{

    private array $strForLinks;
    private View $view;
    private ProductRepository $mainMenu;

    public function __construct(View $view, ProductRepository $mainMenu = new ProductRepository('Home'))
    {
        $this->mainMenu = $mainMenu;
        $this->view = $view;
    }

    public function setStrForLinks(string $link): void
    {
        $this->strForLinks[] = $link;
    }

    public function getStrForLinks(): array
    {
        return $this->strForLinks;
    }

    public function getDataFromModel(): array
    {
        return $this->mainMenu->getAllDataFromJson();
    }

    private function addMenuToLinkArray(): void
    {
        $menuContent = $this->getDataFromModel();
        foreach ($menuContent as $menuLink) {
            $category = $menuLink['category'];
            $id = $menuLink['id'];
            $displayName = $menuLink['displayName'];
            $this->setStrForLinks('index.php?page=List&' . $category . '&productId=' . $id . '>' . $displayName);
        }
    }

    private function addParameterToView(): void
    {
        $this->addMenuToLinkArray();
        $this->view->addTemplateParameter('menu', $this->strForLinks);
    }

    public function renderView(): void
    {
        $this->addParameterToView();
        $this->view->setTemplate('home.tpl');
    }
}