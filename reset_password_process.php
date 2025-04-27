<?php
session_start();
include 'includes/db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $token = $_POST['token'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $_SESSION['error'] = "Passwords do not match";
        header("Location: reset_password.php?email=" . urlencode($email) . "&token=$token");
        exit;
    }

    $stmt = $pdo->prepare("SELECT * FROM password_resets WHERE email = ? AND token = ?");
    $stmt->execute([$email, $token]);
    if ($stmt->fetch()) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE email = ?");
        $stmt->execute([$hashed_password, $email]);
        $stmt = $pdo->prepare("DELETE FROM password_resets WHERE email = ?");
        $stmt->execute([$email]);
        header("Location: login.php?success=Password reset successfully");
    } else {
        $_SESSION['error'] = "Invalid or expired token";
        header("Location: reset_password.php?email=" . urlencode($email) . "&token=$token");
    }
}
?>