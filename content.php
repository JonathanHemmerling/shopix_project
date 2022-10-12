<?php include __DIR__.'/../controller/Controller_Products.php';?>
<?php
if(isset($_GET['page'])) {
    $id = $_GET['id'];
    $submenu_Content = get_Content_From_Model('products');
    foreach($submenu_Content as $sub_Content){
        if($sub_Content['product_Id'] === $id){?>
            <li><a href= <?php echo 'index.php?product_Page=' . $sub_Content['product_Name'] . '&id='. $sub_Content['id'];?>> <?php echo $sub_Content['display_Name'];?> </a>
<?php }}}
if(isset($_GET['product_Page'])) {
    $id = $_GET['id'];
    $product = $_GET['product_Page'];
    $description_Content = get_Content_From_Model('products');
    foreach ($description_Content as $descript_Content) {
        if ($descript_Content['product_Name'] === $product && $descript_Content['id'] === $id) {
            echo $descript_Content['display_Name'] . ': ';?>
            <br />
        <?php echo $descript_Content['description'];
        }
    }
}?>
