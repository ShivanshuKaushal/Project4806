<?php
// index.php
require_once 'config/db.php';
require_once 'controllers/MovieController.php';
require_once 'controllers/UserController.php';

session_start();

$movieController = new MovieController();
$userController = new UserController();

$action = $_GET['action'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($action === 'register') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $userController->register($name, $email, $password);
    } elseif ($action === 'login') {
        $email = $_POST['email'];
        $password = $_POST['password'];
        if ($userController->login($email, $password)) {
            $redirect = $_GET['redirect'] ?? 'index.php';
            header('Location: ' . $redirect);
        }
    } elseif ($action === 'addReview') {
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            $movie_id = $_POST['movie_id'];
            $review_text = $_POST['review_text'];
            $stars = $_POST['stars'];
            $movieController->addReview($user_id, $movie_id, $review_text, $stars);
        } else {
            header('Location: index.php?action=login');
        }
    }
} else {
    if ($action === 'logout') {
        $userController->logout();
    } elseif ($action === 'register') {
        include 'views/register.php';
    } elseif ($action === 'login') {
        include 'views/login.php';
    } elseif (isset($_GET['search'])) {
        $searchTerm = $_GET['search'];
        $movieController->searchMovie($searchTerm);
    } else {
        include 'views/search.php';
    }
}
?>
