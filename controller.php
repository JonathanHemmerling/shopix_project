<?php
include 'model.php';

function get_content($product){
    return get_page($product);
}
function redirect_to($location) {
    header("Location: " . $location);
    exit;
}
?>

