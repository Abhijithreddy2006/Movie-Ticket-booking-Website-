<?php
session_start();
include 'includes/db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        // Mock token (in real apps, send email with token)
        $token = bin2hex(random_bytes(16));
        $stmt = $pdo->prepare("INSERT INTO password_resets (email, token) VALUES (?, ?) ON DUPLICATE KEY UPDATE token = ?");
        $stmt->execute([$email, $token, $token]);
        // Redirect to reset page (mocking email link)
        header("Location: reset_password.php?email=" . urlencode($email) . "&token=$token");
    } else {
        $_SESSION['error'] = "Email not found";
        header("Location: forgot_password.php");
    }
}
?>