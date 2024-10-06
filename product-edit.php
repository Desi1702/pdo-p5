<?php
require_once "db.php";  
require_once "product.php";  

$db = new DB();
$product = new Product($db);

if (isset($_GET['id'])) 
{
    $id = $_GET['id'];
    $productDetails = $product->selectProductById($id); 
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $id = $_POST['id'];
    $omschrijving = $_POST['omschrijving'];
    $prijs = $_POST['prijs'];

    $product->editProduct($id, $omschrijving, $prijs);

    echo "Product succesvol bijgewerkt!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Bewerken</title>
</head>
<body>
    <h1>Product Bewerken</h1>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $productDetails['id']; ?>">
        <input type="text" name="omschrijving" value="<?php echo $productDetails['omschrijving']; ?>" placeholder="Omschrijving">
        <br>
        <input type="number" name="prijs" value="<?php echo $productDetails['prijs']; ?>" placeholder="Prijs">
        <br>
        <input type="submit" value="Bijwerken">
    </form>
</body>
</html>
