<?php include 'header.php';?>
<?php include 'menu.php';?>

<?php
$page_name = $page_name ?? '';
$id = $id ?? '';
if(isset($_GET['page'])) {
    $page_name = $_GET['page'];
    $id = $_GET['id'];
    echo $page_name;
    if(!$page_name && !$id){
        redirect_to('/index.php');
    }
}


?>
<div id="content"><?php
    include 'controller.php';
    $page_content = get_content('product_' . $page_name);
    foreach ($page_content as $list_object){?>
        <li><a href="<?php echo '/views/index.php?page='. $list_object['productname'] . '&id='. $list_object['id'] . '.php'; ?>"><?php echo $list_object['productname'];?></a></li>
    <?php } ?>
</div>
<?php include 'footer.php';

