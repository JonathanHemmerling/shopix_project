<?php

declare(strict_types=1);

namespace App\Controller\FrontendController;

use App\Core\ViewInterface;
use App\Model\ProductRepositoryInterface;

class HomeControll implements HomeControllInterface
{

    private array $strForLinks;
    private const changeUserData = ['<a href="index.php?pageb=ChangeUserData">Change Userdata</a>'];

    public function __construct(private ViewInterface $view, private ProductRepositoryInterface $mainMenu)
    {
    }

    public function setStrForLinks(string $link): void
    {
        $this->strForLinks[] = $link;
    }

    public function getStrForLinks(): array
    {
        return $this->strForLinks;
    }

    private function addMenuToLinkArray(): void
    {
        $menuContent = $this->mainMenu->getAllDataFromMainTable();
        foreach ($menuContent as $menuElement) {
            $mainId = $menuElement->mainId;
            $productGroup = $menuElement->productGroup;
            $displayName = $menuElement->displayName;
            $this->setStrForLinks(
                '<a href="index.php?page=List&mainId=' . $mainId . '&productGroup=' . $productGroup . '">' . $displayName . '</a>'
            );
        }
    }

    private function addParameterToView(): void
    {
        $this->addMenuToLinkArray();
        $this->view->addTemplateParameter('menu', $this->strForLinks);
        $this->view->addTemplateParameter('changeUserData', self::changeUserData);
    }

    public function renderView(): void
    {
        $this->addParameterToView();
        $this->view->setTemplate('home.tpl');
    }
}