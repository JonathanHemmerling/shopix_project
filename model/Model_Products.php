<?php
function get_Categorys_From_Json($file_Name){
    $json_File = file_get_contents(__DIR__ . '/../jsons/' . $file_Name . '.json');
    $page_Content = json_decode($json_File, JSON_OBJECT_AS_ARRAY);
    return $page_Content;
}
function get_Product_From_Json($id){

}
?>