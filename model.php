<?php
function get_Page_Information_By_Id($file_name, $id){
    $json_file = file_get_contents(__DIR__ . 'jsons/'.$file_name.'.json');
    $page_content = json_decode($json_file, JSON_OBJECT_AS_ARRAY);
    return $page_content;
}
?>

