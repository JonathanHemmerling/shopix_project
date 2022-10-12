<?php
include __DIR__ . '/../model/Model_Products.php';

function get_Content_From_Model($file_Name){
    return get_Categorys_From_Json($file_Name);
}

function get_Content_From_Model_By_Id($id){
    return get_Product_From_Json($id);
}
?>