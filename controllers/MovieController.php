<?php
require_once 'models/Movie.php';
require_once 'config/config.php';

class MovieController {
    private $movieModel;

    public function __construct() {
        $this->movieModel = new Movie(OMDB_API_URL, OMDB_API_KEY);
    }

    public function searchMovie($title) {
        $movie = $this->movieModel->getMovie($title);
        include 'views/movie.php';
    }
}
?>
