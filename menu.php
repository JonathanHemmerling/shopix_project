<?php include __DIR__.'/controller/Controller_Categorys.php';?>
<div id="menu">
    <?php echo 'Menu:';
    $menu_Content = get_Content_From_Model('categorys');
    foreach ($menu_Content as $list_object){?>
        <li><a href="<?php echo 'index.php?page='. $list_object['productcategory'] . '&id='. $list_object['id'] . '.php'; ?>"><?php echo $list_object['display_name'];?></a></li>
    <?php } ?>
    <a href="index.php">Home</a>
</div>
