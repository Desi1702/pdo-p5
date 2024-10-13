<?php
require_once "db.php";  
require_once "product.php";  

$db = new DB();
$product = new Product($db);

if (isset($_GET['id'])) 
{
    $id = $_GET['id'];

    $product->deleteProduct($id);

    echo "Product succesvol verwijderd!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css?v=1.0">
    <title>Delete</title>
</head>
<body>
<ul>
  <li><a href="product-insert.php">Product Insert</a></li>
  <li><a href="product-view.php">Product View</a></li>
  <li><a href="logout.php">Log out</a></li> 
</ul>
</body>
</html>