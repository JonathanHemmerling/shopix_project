<?php

declare(strict_types=1);

namespace App\Controller\BackendController;


use App\Controller\ControllerInterface;
use App\Core\Redirect;
use App\Core\ViewInterface;
use App\Model\ProductRepository;

class CreateProductControll  implements ControllerInterface
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
            $productDataFromForm = $_POST;
            $this->products->createNewProduct((int)$productDataFromForm['mainId'], $productDataFromForm['displayName'], $productDataFromForm['productName'], $productDataFromForm['description'], $productDataFromForm['price']);
            $this->redirect->to('/index.php?page=CategoryData&backend');
        }
        $this->view->setTemplate('createProduct.tpl');
    }
}