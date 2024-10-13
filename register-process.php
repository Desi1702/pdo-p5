<?php
require_once 'db.php';

$db = new DB();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        header("Location: register.php?error=All fields are required.");
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: register.php?error=Invalid email format.");
        exit;
    }

    if ($password !== $confirm_password) {
        header("Location: register.php?error=Passwords do not match.");
        exit;
    }

    $sql = "SELECT * FROM users WHERE email = ?";
    $existingUser = $db->execute($sql, [$email])->fetch(PDO::FETCH_ASSOC);

    if ($existingUser) {
        header("Location: register.php?error=Email already registered.");
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $result = $db->execute($sql, [$username, $email, $hashed_password]);

    if ($result) {
        header("Location: product-insert.php");
        exit;
    } else {
        header("Location: register.php?error=Something went wrong. Please try again.");
        exit;
    }
}
