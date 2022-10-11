<?php include __DIR__.'/../controller/Controller_Products.php';?>
<?php
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $content_list = [];
    $page_Content = get_Content_From_Model('products');
    foreach($page_Content as $content){
        if($content['product_id'] === $id){
            $content_list[] = $content;
    }
}?>
<?php foreach($content_list as $contents){
    ?> <li><a href= <?php echo 'index.php?productname=' . $contents['productname'] . '&id='. $contents['id'] . '.php'?>"> <?php $contents['displayname']?> </a>
<?php }}?>












<?php
/*if(!isset($_GET['id'])){
    if(isset($_GET['product_id'])){

    }
}
if(isset($_GET['id'])){
    $page_Id = $_GET['id'];
    $page_Content = get_Content_From_Model('product_' . $page_Id);*/?>



