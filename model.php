<?php
function get_page_information_from_json($file_name){
    $json_file = file_get_contents('jsons/'.$file_name.'.json');
    $page_content = json_decode($json_file, JSON_OBJECT_AS_ARRAY);
    return $page_content;
}
?>

