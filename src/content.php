<?php

namespace src;

use Src\Controller\ProductsController;

$allProducts = new ProductsController();
if (isset($_GET['page'])) {
$id = $_GET['id'];
$submenuContent = $allProducts->getContentFromModel('products');
foreach ($submenuContent as $subContent){
if ($subContent['productId'] === $id){
?>
<li><a href= <?php
    echo 'index.php?productPage=' . $subContent['productName'] . '&id=' . $subContent['id']; ?>> <?php
        echo $subContent['displayName']; ?> </a>
    <?php
    }
    }
    }
    if (isset($_GET['productPage'])) {
        $id = $_GET['id'];
        $product = $_GET['productPage'];
        $descriptionContent = $allProducts->getContentFromModel('products');
        foreach ($descriptionContent as $descriptContent) {
            if ($descriptContent['productName'] === $product && $descriptContent['id'] === $id) {
                echo $descriptContent['displayName'] . ': '; ?>
                <br/>
                <?php
                echo $descriptContent['description'];
            }
        }
    } ?>
