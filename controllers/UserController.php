<?php
require_once 'models/User.php';
require_once 'config/db.php';

class UserController {
    private $userModel;

    public function __construct() {
        global $pdo;
        $this->userModel = new User($pdo);
    }

    public function register($name, $email, $password) {
        if ($this->userModel->register($name, $email, $password)) {
            header('Location: index.php?action=login');
        } else {
            echo 'Registration failed. Please try again.';
        }
    }

    public function login($email, $password) {
        $user = $this->userModel->login($email, $password);
        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            return true;
        } else {
            echo 'Login failed. Please try again.';
            return false;
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: index.php');
    }
}
?>
