<?php
class DB
{
    private $dbh;
    protected $stmt;

    public function __construct($db = "winkel", $host = "localhost", $user = "root", $pass = "")
    {
        try {
            $this->dbh = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection error: ") . $e->getMessage();
        }
    }

    public function execute($sql, $placeholders = null)
    {
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute($placeholders);
        return $stmt;
    }

    public function getAllProducts()
    {
        $sql = "SELECT * FROM product";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute();

        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $products;
    }

    public function editProduct($id, $omschrijving, $prijs)
    {
        $sql = "UPDATE product SET omschrijving = ?, prijs = ? WHERE id = ?";
        return $this->execute($sql, [$omschrijving, $prijs, $id]);
    }

    public function deleteProduct($id)
    {
        $sql = "DELETE FROM product WHERE id = ?";
        return $this->execute($sql, [$id]);
    }
    
}
