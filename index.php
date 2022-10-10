
<?php include 'header.php';
include 'menu.php';?>

<?php
if(isset($_GET['page'])){
    $page_name = $_GET['page'];
    $page_content = get_content_from_model('product_' . $page_name);?>

    <div id="content"><?php echo ucfirst($page_name) . ': ' ?><br/>
        <?php
        foreach ($page_content as $list_object){?>
            <li><a href="<?php echo 'index.php?productname='. $list_object['productname'] . '&id='. $list_object['id'] . '.php'; ?>"><?php echo $list_object['productname'];?></a></li>
        <?php } ?>
    </div>
<?php } ?>
<?php include 'footer.php';?>


