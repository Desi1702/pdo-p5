<?php
require_once 'db.php';
session_start();

$db = new DB();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        header("Location: login.php?error=All fields are required.");
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: login.php?error=Invalid email format.");
        exit;
    }

    $sql = "SELECT * FROM users WHERE email = ?";
    $user = $db->execute($sql, [$email])->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];

            header("Location: product-insert.php");
            exit;
        } else {
            header("Location: login.php?error=Incorrect password.");
            exit;
        }
    } else {
        header("Location: login.php?error=No account found with that email.");
        exit;
    }
}
