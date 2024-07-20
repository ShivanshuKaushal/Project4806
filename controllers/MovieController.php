<?php
require_once 'models/Movie.php';
require_once 'models/Review.php';
require_once 'config/db.php';
require_once 'config/config.php';

class MovieController {
    private $movieModel;
    private $reviewModel;

    public function __construct() {
        global $pdo;
        $this->movieModel = new Movie(OMDB_API_URL, OMDB_API_KEY);
        $this->reviewModel = new Review($pdo);
    }

    public function searchMovie($title) {
        $movie = $this->movieModel->getMovie($title);
        $reviews = [];
        if ($movie && isset($movie['imdbID'])) {
            $reviews = $this->reviewModel->getReviews($movie['imdbID']);
        }
        include 'views/movie.php';
    }

    public function addReview($user_id, $movie_id, $review_text, $stars) {
        $this->reviewModel->addReview($user_id, $movie_id, $review_text, $stars);
        return true;
    }
}
?>
