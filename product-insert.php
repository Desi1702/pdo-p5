<?php
require_once "db.php";   // Verander naar require_once
require_once "product.php";  // Verander naar require_once

// Maak een nieuwe instantie van de DB class
$db = new DB(); 

// Geef de DB-instantie door aan het Product-object
$product = new Product($db);  // Nu wordt het juiste object doorgegeven
try
{
    if ($_SERVER ['REQUEST_METHOD'] == 'POST')
    {
        $product->insertProduct($_POST['naam'], $_POST['prijs']);
        echo "Succesfully inserted product";
    }
} catch (\Exception $e)
{
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method = "POST">
        <input type = "text" name = "naam" Placeholder = "Naam">
        <input type = "number" name = "prijs" Placeholder = "Prijs">
        <input type = "submit" value = "submit">
    </form>
</body>
</html>