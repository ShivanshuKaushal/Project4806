<?php
require_once 'controllers/MovieController.php';

$controller = new MovieController();

if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
    $controller->searchMovie($searchTerm);
} else {
    include 'views/search.php';
}
?>
