<?php
include __DIR__ . '/../model/Model_Categorys.php';

function get_Content_From_Model($product){
    return get_Categorys_From_Json($product);
}