<?php include __DIR__.'/../controller/Controller_Products.php';?>
<?php
if(!isset($_GET['id'])){
    if(isset($_GET['product_id'])){

    }
}
if(isset($_GET['id'])){
    $page_Id = $_GET['id'];
    $page_Content = get_Content_From_Model('product_' . $page_Id);?>

    <div id="content"><?php echo ucfirst('TEST') . ': ' ?><br/>
        <?php
        foreach ($page_Content as $list_Object){?>
            <li><a href="<?php echo 'index.php?productname='. $list_Object['productname'] . '&id='. $list_Object['_product_Id'] . '.php'; ?>"><?php echo $list_Object['productname'];?></a></li>
        <?php } ?>
    </div>
<?php } ?>


