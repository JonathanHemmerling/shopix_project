<?php

namespace src;

use Src\Controller\CategoryController;

$category = new CategoryController() ?>
<div id="menu">
    <?php
    if (!isset($_GET['id'])) {
        echo 'Menu:';
        $menuContent = $category->getMenuDataFromModel('categorys');
        foreach ($menuContent as $listObject) {
            ?>
            <li><a href="<?php
                echo 'index.php?page=' . $listObject['productCategory'] . '&id=' . $listObject['id']; ?>"><?php
                    echo $listObject['displayName']; ?></a></li>
            <?php
        }
    }
    if (isset($_GET['id'])) {
        ?>
        <a href="../index.php">Home</a>
        <?php
    } ?>

</div>