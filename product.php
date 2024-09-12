<?php
require_once "db.php";

Class Product
{
    private $pdo;

    public function __construct(DB $pdo)
    {
        $this->pdo = $pdo;
    }

    public function insertProduct($omschrijving, $prijs, $fileToUpload) : PDOStatement | False
    {
        return $this->pdo->execute("INSERT INTO product (omschrijving, prijs, fileToUpload) VALUES (?,?,?)", [$omschrijving, $prijs, $fileToUpload]);
    }
}
?>