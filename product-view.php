<?php
require_once "db.php";  
require_once "product.php";  
$db = new DB(); 
$product = new Product($db);  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<table>
  <th>Product Code</th>
  <th>Naam</th>
  <th>Prijs</th>
  <th colspan = "2">Action</th>
  
  <?php
  $producten = $product->selectProducts();
  foreach ($producten as $product)
  {
    echo "<tr>";

    echo "<td>".$product['id']."</td>";
    echo "<td>".$product['omschrijving']."</td>";
    echo "<td>".$product['prijs']."</td>";
    echo "<td><a href = 'product-delete.php'?id=" .$product['id'].">Delete</a> </td>";
    echo "<td> <a href='product-edit.php'?id="  .$product['id'].">Edit</a> </td>";
    echo "</tr>";
  }
  ?>
</table>
</body>
</html>