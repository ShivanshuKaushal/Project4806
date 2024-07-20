<?php
require_once 'config/db.php';

class Review {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function addReview($user_id, $movie_id, $review, $stars) {
        $stmt = $this->pdo->prepare("INSERT INTO reviews (user_id, movie_id, review, stars) VALUES (:user_id, :movie_id, :review, :stars)");
        return $stmt->execute(['user_id' => $user_id, 'movie_id' => $movie_id, 'review' => $review, 'stars' => $stars]);
    }

    public function getReviews($movie_id) {
        $stmt = $this->pdo->prepare("SELECT reviews.*, users.name FROM reviews JOIN users ON reviews.user_id = users.id WHERE movie_id = :movie_id ORDER BY created_at DESC");
        $stmt->execute(['movie_id' => $movie_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
