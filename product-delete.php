<?php
require_once "db.php";  
require_once "product.php";  

$db = new DB();
$product = new Product($db);

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $product->deleteProduct($id);

    echo "Product succesvol verwijderd!";
}

?>
