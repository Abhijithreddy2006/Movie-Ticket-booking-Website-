<?php
session_start();
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Validation
    if (empty($email) || empty($password)) {
        header("Location: login.php?error=All fields are required");
        exit();
    }

    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            
            // Redirect to previous page if set, otherwise to home
            if (isset($_SESSION['redirect_url'])) {
                $redirect = $_SESSION['redirect_url'];
                unset($_SESSION['redirect_url']);
                header("Location: " . $redirect);
            } else {
                header("Location: index.php");
            }
            exit();
        } else {
            header("Location: login.php?error=Invalid email or password");
            exit();
        }
    } catch (PDOException $e) {
        header("Location: login.php?error=Login failed. Please try again.");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
} 