<?php

declare(strict_types=1);

namespace App\Controller\BackendController;

use App\Controller\ControllerInterface;
use App\Core\Redirect;
use App\Core\ViewInterface;
use App\Model\ProductRepository;

class CategoryDataControll implements ControllerInterface
{


    public function __construct(
        private ViewInterface $view,
        private ProductRepository $products,
        private Redirect $redirect
    ) {
    }

    public function renderView(): void
    {
        if (isset($_POST['submit'])) {
            $productName = $_GET['productName'];
            $this->products->deleteProductById($productName);
            $this->redirect->to("index.php?page=CategoryData&backend");
        }
        $arrayMain = [];
        $arrayProducts = [];
        $mainCategorys = $this->products->getAllMainCategorysFromDatabase();
        foreach ($mainCategorys as $row) {
            $products= $this->products->getProductByMainIdFromDatabase($row->mainId);
            foreach ($products as $product) {
                $arrayMain[$product->displayName] = $row->displayName;
            }
        }

    $this->view->addTemplateParameter('main', $arrayMain);
    $this->view->addTemplateParameter('products', $arrayProducts);

    $this->view->setTemplate('categorydata.tpl');
    }
}