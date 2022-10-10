<?php
include 'model.php';

function get_content_from_model($product){
    return get_page_information_from_json($product);
}
function redirect_to($location) {
    header("Location: " . $location);
    exit;
}
?>

