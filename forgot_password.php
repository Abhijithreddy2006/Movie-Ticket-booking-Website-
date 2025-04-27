<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white flex items-center justify-center min-h-screen">
    <div class="bg-gray-800 p-8 rounded-lg shadow-xl w-full max-w-md">
        <h2 class="text-2xl font-bold text-center mb-6">Forgot Password</h2>
        <p class="text-center mb-4">Enter your email to reset your password.</p>
        <form action="forgot_password_process.php" method="POST">
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Email</label>
                <input type="email" name="email" class="w-full p-2 bg-gray-700 rounded focus:outline-none focus:ring-2 focus:ring-red-500" required>
            </div>
            <button type="submit" class="w-full bg-red-500 text-white py-2 rounded hover:bg-red-600">Send Reset Link</button>
        </form>
    </div>
</body>
</html>