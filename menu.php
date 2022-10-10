<div>
    <?php echo 'Menu';
    include 'controller.php';
    $menu_content = get_content('categorys');
    foreach ($menu_content as $list_object){?>
        <li><a href="<?php echo '/views/index.php?page='. $list_object['productcategory'] . '&id='. $list_object['id'] . '.php'; ?>"><?php echo $list_object['productcategory'];?></a></li>
    <?php } ?>
</div>
