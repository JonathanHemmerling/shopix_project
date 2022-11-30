<?php

declare(strict_types=1);

namespace App\Controller\FrontendController;

use App\Controller\ControllerInterface;
use App\Core\View;
use App\Model\ProductRepository;

class ListControll implements ListControllInterface
{

    private array $strForLinks;
    private const HomeLink = ['<a href="index.php">Home</a>'];
    private const changeUserData = ['<a href="index.php?pageb=ChangeUser">Change Userdata</a>'];

    public function __construct(private View $view, private ProductRepository $products)
    {

    }

    public function getStrForLinks(): array
    {
        return $this->strForLinks;
    }

    public function setStrForLinks(string $strForLinks): void
    {
        $this->strForLinks[] = $strForLinks;
    }


    private function addCategorysToLinkArray(): void
    {
        $urlId = (int)$_GET['mainId'];
        $listContent = $this->products->getAllDataFromSubCategorys($urlId);
        foreach ($listContent as $listElement) {
            $subId = $listElement->subId;
            $productName = $listElement->productNames;
            $displayName = $listElement->displayName;
            $this->setStrForLinks('<a href="index.php?page=Detail&subId=' . $subId . '&productName=' . $productName . '">' . $displayName . '</a>');
        }
    }

    private function addCategoryParameterToView(): void
    {
        $this->addCategorysToLinkArray();
        $this->view->addTemplateParameter('categoryHome', self::HomeLink);
        $this->view->addTemplateParameter('categoryLink', $this->strForLinks);
        $this->view->addTemplateParameter('changeUserData', self::changeUserData);
    }

    public function renderView(): void
    {
        $this->addCategoryParameterToView();
        $this->view->setTemplate('category.tpl');
    }
}