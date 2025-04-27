<?php include 'includes/header.php'; ?>

<div class="row">
    <div class="col-12 text-center mb-4">
        <h1>Welcome to Movie Booking</h1>
        <p class="lead">Book your favorite movies at the best theaters near you!</p>
    </div>
</div>

<?php
include 'includes/db.php';

try {
    $stmt = $pdo->query("SELECT * FROM movies");
    $movies = $stmt->fetchAll();
    
    echo '<div class="row">';
    foreach ($movies as $movie) {
        echo '<div class="col-md-4 mb-4">';
        echo '<div class="card movie-card">';
        echo '<img src="images/' . htmlspecialchars($movie['poster']) . '" class="card-img-top" alt="' . htmlspecialchars($movie['title']) . '">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . htmlspecialchars($movie['title']) . '</h5>';
        echo '<p class="card-text">Genre: ' . htmlspecialchars($movie['genre']) . '<br>';
        echo 'Duration: ' . $movie['duration'] . ' minutes</p>';
        echo '<a href="select_location.php?movie_id=' . $movie['id'] . '" class="btn btn-primary">Book Now</a>';
        echo '</div></div></div>';
    }
    echo '</div>';
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<?php include 'includes/footer.php'; ?> 