<?php
include '../includes/db.php';
if (isset($_POST['showtime_id'])) {
    $showtime_id = $_POST['showtime_id'];
    $stmt = $pdo->prepare("SELECT seat_number FROM bookings WHERE showtime_id = ?");
    $stmt->execute([$showtime_id]);
    echo json_encode($stmt->fetchAll(PDO::FETCH_COLUMN));
}
?>