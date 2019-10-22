<?php
require_once('lib/config.php');
require_once('lib/common.php');
require_once('lib/product_class.php');

if(isset($_GET['id']) && is_int($_GET['id'])) {
    header('Location:product_detail.php');
    exit;
}

$product_id = (isset($_GET['id']) ? $_GET['id'] : 0); 

$id = new Product();
$product = $id->selectProduct($product_id);

$images = $id->selectImages($product_id);

var_dump($images);

?>