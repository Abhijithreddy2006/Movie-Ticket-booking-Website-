<?php
include '../includes/db.php';
if (isset($_POST['theater_id']) && isset($_POST['movie_id'])) {
    $theater_id = $_POST['theater_id'];
    $movie_id = $_POST['movie_id'];
    try {
        $stmt = $pdo->prepare("SELECT s.*, m.title FROM showtimes s JOIN movies m ON s.movie_id = m.id WHERE s.theater_id = ? AND s.movie_id = ?");
        $stmt->execute([$theater_id, $movie_id]);
        $showtimes = $stmt->fetchAll();
        echo json_encode($showtimes);
    } catch (Exception $e) {
        error_log("Showtimes error: " . $e->getMessage());
        echo json_encode([]);
    }
} else {
    echo json_encode([]);
}
?>