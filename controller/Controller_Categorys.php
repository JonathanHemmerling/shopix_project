<?php
include __DIR__ . '/../model/Model_Categorys.php';

function get_Content_From_Model($file_Name){
    return get_Categorys_From_Json($file_Name);
}