<?php

function get_Categorys_From_Json($file_name){
    $json_file = file_get_contents(__DIR__ . '/../jsons/'.$file_name.'.json');
    $page_content = json_decode($json_file, JSON_OBJECT_AS_ARRAY);
    return $page_content;
}


function get_Page_Information_by_id($file_name, $id){

}
