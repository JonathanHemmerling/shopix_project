
<?php include 'header.php';
include 'menu.php';?>

<?php
if(isset($_GET['page'])){
    $page_name = $_GET['page'];?>
    <div id="content"><?php
        include 'controller.php';
        $page_content = get_content_from_model('product_' . $page_name);
        foreach ($page_content as $list_object){?>
            <li><a href="<?php echo 'index.php?page='. $list_object['productname'] . '&id='. $list_object['id'] . '.php'; ?>"><?php echo $list_object['productname'];?></a></li>
        <?php } ?>
    </div>
<?php }else {
}
    ?>
<?php include 'footer.php';?>


