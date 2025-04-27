<?php
session_start();
include 'includes/db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $movie_id = $_POST['movie_id'];
    $showtime_id = $_POST['showtime_id'];
    $selected_seats = explode(',', $_POST['selected_seats']);
    if (empty($showtime_id) || empty($selected_seats)) {
        error_log("Booking error: Missing showtime_id or seats");
        header("Location: booking.php?movie_id=$movie_id&error=Missing data");
        exit;
    }
    try {
        $stmt = $pdo->prepare("SELECT s.*, m.title, t.name AS theater FROM showtimes s 
                               JOIN movies m ON s.movie_id = m.id 
                               JOIN theaters t ON s.theater_id = t.id 
                               WHERE s.id = ?");
        $stmt->execute([$showtime_id]);
        $showtime = $stmt->fetch();
        if (!$showtime) {
            error_log("Booking error: Invalid showtime_id $showtime_id");
            header("Location: booking.php?movie_id=$movie_id&error=Invalid showtime");
            exit;
        }
        foreach ($selected_seats as $seat) {
            $stmt = $pdo->prepare("INSERT INTO bookings (user_id, showtime_id, seat_number) VALUES (?, ?, ?)");
            $stmt->execute([$user_id, $showtime_id, $seat]);
            $booking_id = $pdo->lastInsertId();
        }
        $_SESSION['booking_details'] = [
            'booking_id' => $booking_id,
            'title' => $showtime['title'],
            'theater' => $showtime['theater'],
            'show_date' => $showtime['show_date'],
            'show_time' => $showtime['show_time'],
            'seats' => $_POST['selected_seats']
        ];
        header("Location: payment.php");
        exit;
    } catch (PDOException $e) {
        error_log("Booking error: " . $e->getMessage());
        header("Location: booking.php?movie_id=$movie_id&error=Database error");
        exit;
    }
} else {
    header("Location: login.php");
    exit;
}
?>