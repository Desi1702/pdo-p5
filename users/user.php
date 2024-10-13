<?php
require_once 'db.php';

class User {
    private $db;

    public function __construct() 
    {
        $this->db = new DB();
    }

    public function register($username, $email, $password, $confirm_password) 
    {
        if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) 
        {
            return "All fields are required.";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
        {
            return "Invalid email format.";
        }

        if ($password !== $confirm_password) 
        {
            return "Passwords do not match.";
        }

        $sql = "SELECT * FROM users WHERE email = ?";
        $existingUser = $this->db->execute($sql, [$email])->fetch(PDO::FETCH_ASSOC);

        if ($existingUser) 
        {
            return "Email already registered.";
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $result = $this->db->execute($sql, [$username, $email, $hashed_password]);

        if ($result) 
        {
            return true; 
        } else 
        {
            return "Something went wrong. Please try again.";
        }
    }

    public function login($email, $password) 
    {
        if (empty($email) || empty($password)) 
        {
            return "All fields are required.";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
        {
            return "Invalid email format.";
        }

        $sql = "SELECT * FROM users WHERE email = ?";
        $user = $this->db->execute($sql, [$email])->fetch(PDO::FETCH_ASSOC);

        if ($user) 
        {
            if (password_verify($password, $user['password'])) 
            {
                return $user;
            } else {
                return "Incorrect password.";
            }
        } else 
        {
            return "No account found with that email.";
        }
    }
}
