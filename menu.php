<?php include __DIR__ . '/Controller/CategoryController.php';?>

<?php $category = new CategoryController()?>

<div id="menu">
    <?php echo 'Menu:';
    if(!isset($_GET['id'])){
    $menu_Content = $category -> getMenuDataFromModel('categorys');
    foreach ($menu_Content as $list_Object){?>
        <li><a href="<?php echo 'index.php?page='. $list_Object['product_Category'] . '&id='. $list_Object['id']; ?>"><?php echo $list_Object['display_Name'];?></a></li>
    <?php } }
    if(isset($_GET['id'])){
    ?>
    <a href="index.php">Home</a>
<?php }?>

</div>
