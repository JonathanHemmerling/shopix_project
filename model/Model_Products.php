<?php
function get_Categorys_From_Json($file_Name){
    $json_file = file_get_contents(__DIR__ . '/../jsons/' . $file_Name . '.json');
    $page_content = json_decode($json_file, JSON_OBJECT_AS_ARRAY);
    return $page_content;
}
?>