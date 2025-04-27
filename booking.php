<?php
session_start();
include 'includes/db.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
$movie_id = $_GET['movie_id'] ?? '';
if (!$movie_id) {
    header("Location: index.php");
    exit;
}
$stmt = $pdo->prepare("SELECT * FROM movies WHERE id = ?");
$stmt->execute([$movie_id]);
$movie = $stmt->fetch();
$stmt = $pdo->query("SELECT * FROM locations");
$locations = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book <?php echo htmlspecialchars($movie['title']); ?></title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-gray-900 text-white">
    <nav class="bg-black p-4 shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <a href="index.php" class="text-2xl font-bold text-red-500">Movie Booking</a>
            <div class="space-x-4">
                <a href="index.php" class="hover:text-red-500">Home</a>
                <?php if (isset($_SESSION['user_id'])) { ?>
                    <a href="logout.php" class="hover:text-red-500">Logout</a>
                <?php } else { ?>
                    <a href="login.php" class="hover:text-red-500">Login</a>
                    <a href="register.php" class="hover:text-red-500">Register</a>
                <?php } ?>
            </div>
        </div>
    </nav>
    <div class="container mx-auto mt-8">
        <h2 class="text-3xl font-bold text-center mb-8">Book Tickets for <?php echo htmlspecialchars($movie['title']); ?></h2>
        <div class="bg-gray-800 p-6 rounded-lg shadow-xl max-w-2xl mx-auto">
            <h3 class="text-xl font-semibold mb-4">Step 1: Select Location</h3>
            <select id="location" class="w-full p-2 rounded bg-gray-700 text-white mb-4" required>
                <option value="">Choose Location</option>
                <?php foreach ($locations as $location) { ?>
                    <option value="<?php echo $location['id']; ?>"><?php echo htmlspecialchars($location['name']); ?></option>
                <?php } ?>
            </select>

            <h3 class="text-xl font-semibold mb-4">Step 2: Select Theater</h3>
            <select id="theater" class="w-full p-2 rounded bg-gray-700 text-white mb-4" disabled required>
                <option value="">Choose Theater</option>
            </select>

            <h3 class="text-xl font-semibold mb-4">Step 3: Select Showtime</h3>
            <div id="showtimes" class="mb-4"></div>

            <h3 class="text-xl font-semibold mb-4">Step 4: Select Seats</h3>
            <div class="screen bg-gray-600 text-center py-2 rounded mb-4">Screen</div>
            <div id="seat-map" class="text-center"></div>

            <form id="booking-form" action="book_process.php" method="POST" class="mt-6">
                <input type="hidden" name="movie_id" value="<?php echo $movie_id; ?>">
                <input type="hidden" name="showtime_id" id="showtime_id">
                <input type="hidden" name="selected_seats" id="selected_seats">
                <button type="submit" class="w-full bg-red-500 text-white py-2 rounded hover:bg-red-600" id="book-btn" disabled>Proceed to Payment</button>
            </form>
        </div>
    </div>
    <script src="js/script.js"></script>
</body>
</html>