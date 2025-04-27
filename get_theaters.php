<?php
include '../includes/db.php';
if (isset($_POST['location_id'])) {
    $location_id = $_POST['location_id'];
    $stmt = $pdo->prepare("SELECT * FROM theaters WHERE location_id = ?");
    $stmt->execute([$location_id]);
    echo json_encode($stmt->fetchAll());
}
?>