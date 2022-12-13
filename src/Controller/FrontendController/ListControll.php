<?php

declare(strict_types=1);

namespace App\Controller\FrontendController;

use App\Controller\ControllerInterface;
use App\Core\View;
use App\Model\ProductRepository;

class ListControll  implements ControllerInterface
{

    private array $strForLinks;

    public function __construct(private View $view, private ProductRepository $products)
    {
    }

    public function renderView(): void
    {
        $mainId = (int)$_GET['mainId'];
        $listContent = $this->products->getProductByMainIdFromDatabase($mainId);
        foreach ($listContent as $listElement) {
            $productId = $listElement->productId;
            $productName = $listElement->productName;
            $displayName = $listElement->displayName;
            $this->strForLinks[] = (
                '<a href="index.php?page=Detail&productId=' . $productId . '&productName=' . $productName . '">' . $displayName . '</a>'
            );
        }
        $this->view->addTemplateParameter('categoryLink', $this->strForLinks);
        $this->view->setTemplate('category.tpl');
    }
}