<?php
require_once 'users/user.php';

$user = new User();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    $result = $user->register($username, $email, $password, $confirm_password);

    if ($result === true) {
        header("Location: product-insert.php");
        exit;
    } else {
        header("Location: register.php?error=" . urlencode($result));
        exit;
    }
}
