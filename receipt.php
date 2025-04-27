<?php
session_start();
if (!isset($_SESSION['user_id']) || !isset($_SESSION['booking_details'])) {
    header("Location: login.php");
    exit;
}
$details = $_SESSION['booking_details'];
unset($_SESSION['booking_details']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmed</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white">
    <nav class="bg-black p-4 shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <a href="index.php" class="text-2xl font-bold text-red-500">Movie Booking</a>
            <div class="space-x-4">
                <a href="index.php" class="hover:text-red-500">Home</a>
                <a href="logout.php" class="hover:text-red-500">Logout</a>
            </div>
        </div>
    </nav>
    <div class="container mx-auto mt-8">
        <h2 class="text-3xl font-bold text-center mb-8">Booking Confirmed</h2>
        <div class="bg-gray-800 p-6 rounded-lg shadow-xl max-w-md mx-auto">
            <h3 class="text-xl font-semibold mb-4">Your Ticket</h3>
            <p><strong>Movie:</strong> <?php echo htmlspecialchars($details['title']); ?></p>
            <p><strong>Theater:</strong> <?php echo htmlspecialchars($details['theater']); ?></p>
            <p><strong>Date & Time:</strong> <?php echo $details['show_date'] . ' ' . $details['show_time']; ?></p>
            <p><strong>Seats:</strong> <?php echo htmlspecialchars($details['seats']); ?></p>
            <p><strong>Booking ID:</strong> <?php echo $details['booking_id']; ?></p>
            <a href="index.php" class="mt-6 block bg-red-500 text-white text-center py-2 rounded hover:bg-red-600">Back to Home</a>
        </div>
    </div>
    <footer class="bg-black text-center py-4 mt-12">
        <p class="text-gray-400">© 2025 Movie Booking System</p>
    </footer>
</body>
</html>