<?php
include __DIR__ . '/../model/Model_Products.php';

$public_end = strpos($_SERVER['SCRIPT_NAME'], '/public') + 7;
$doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
define("WWW_ROOT", $doc_root);

function get_Content_From_Model($file_Name){
    return get_Categorys_From_Json($file_Name);
}

function u($string="") {
    return urlencode($string);
}
function h($string="") {
    return htmlspecialchars($string);
}
function url_for($script_path) {
    // add the leading '/' if not present
    if($script_path[0] != '/') {
        $script_path = "/" . $script_path;
    }
    return WWW_ROOT . $script_path;
}

?>