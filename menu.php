<?php include 'controller.php';?>
<div id="menu">
    <?php echo 'Menu:';
    $menu_content = get_content_from_model('categorys');
    foreach ($menu_content as $list_object){?>
        <li><a href="<?php echo 'index.php?page='. $list_object['productcategory'] . '&id='. $list_object['id'] . '.php'; ?>"><?php echo $list_object['display_name'];?></a></li>
    <?php } ?>
    <a href="index.php">Home</a>
</div>
