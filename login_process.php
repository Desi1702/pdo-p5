<?php
require_once 'users/user.php';
session_start();

$user = new User();

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = $user->login($email, $password);

    if (is_array($result)) 
    {
        $_SESSION['user_id'] = $result['id'];
        $_SESSION['username'] = $result['username'];
        $_SESSION['email'] = $result['email'];

        header("Location: product-insert.php");
        exit;
    } else 
    {
        header("Location: login.php?error=" . urlencode($result));
        exit;
    }
}
