<?php
include __DIR__ . '/../model/Model_Products.php';
function get_Content_From_Model($product_id){
    return get_Products_By_Id($product_id);
}
?>