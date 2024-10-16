<?php
require_once "db.php";  
require_once "product.php";  

$db = new DB(); 

$product = new Product($db);  
try
{
    if ($_SERVER ['REQUEST_METHOD'] == 'POST')
    {
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 1000000000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}

        $product->insertProduct($_POST['omschrijving'],$_POST['prijs'], $target_file);
        echo "Successfully inserted product";
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
    <link rel="stylesheet" href="style.css?v=1.0">
    <title>Document</title>
</head>
<body>
<ul>
  <li><a class="active" href="#productinsert">Product Insert</a></li>
  <li><a href="product-view.php">Product View</a></li>
  <li><a href="logout.php">Log out</a></li> 


</ul>
<div class="container">
    <h2>Insert Product</h2>

    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <input type="file" name="fileToUpload" id="fileToUpload" required>
        </div>

        <div class="form-group">
            <input type="text" name="omschrijving" placeholder="Omschrijving" required>
        </div>

        <div class="form-group">
            <input type="number" name="prijs" placeholder="Prijs" required>
        </div>

        <div class="form-group">
            <input type="submit" value="Submit">
        </div>
    </form>
</div>



</body>
</html>