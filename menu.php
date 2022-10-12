<?php include __DIR__.'/controller/Controller_Categorys.php';?>
<div id="menu">
    <?php echo 'Menu:';
    $menu_Content = get_Content_From_Model('categorys');
    foreach ($menu_Content as $list_Object){?>
        <li><a href="<?php echo 'index.php?page='. $list_Object['product_Category'] . '&id='. $list_Object['id']; ?>"><?php echo $list_Object['display_Name'];?></a></li>
    <?php } ?>
    <a href="index.php">Home</a>
</div>
