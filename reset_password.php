<?php
session_start();
$error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
unset($_SESSION['error']);
$email = $_GET['email'] ?? '';
$token = $_GET['token'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white flex items-center justify-center min-h-screen">
    <div class="bg-gray-800 p-8 rounded-lg shadow-xl w-full max-w-md">
        <h2 class="text-2xl font-bold text-center mb-6">Reset Password</h2>
        <?php if ($error) { ?>
            <div class="bg-red-600 text-white p-3 rounded mb-4"><?php echo htmlspecialchars($error); ?></div>
        <?php } ?>
        <form action="reset_password_process.php" method="POST">
            <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">New Password</label>
                <input type="password" name="password" class="w-full p-2 bg-gray-700 rounded focus:outline-none focus:ring-2 focus:ring-red-500" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Confirm Password</label>
                <input type="password" name="confirm_password" class="w-full p-2 bg-gray-700 rounded focus:outline-none focus:ring-2 focus:ring-red-500" required>
            </div>
            <button type="submit" class="w-full bg-red-500 text-white py-2 rounded hover:bg-red-600">Reset Password</button>
        </form>
    </div>
</body>
</html>