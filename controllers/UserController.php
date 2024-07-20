<?php
require_once 'models/User.php';
require_once 'config/db.php';

class UserController {
    private $userModel;

    public function __construct() {
        global $pdo;
        $this->userModel = new User($pdo);
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
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
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();
        header('Location: index.php');
    }
    public function generateAIReview($movieTitle, $movie_id) {
        $url = "https://generativelanguage.googleapis.com/v1/models/gemini-pro:generateContent?key=" . $_ENV['GOOGLE_API'];

        $data = array(
            "contents" => array(
                array(
                    "role" => "user",
                    "parts" => array(
                        array(
                            "text" => "Please give a review of the movie " . $movieTitle . " with an average rating of 4 out of 5."
                        )
                    )
                )
            )
        );

        $json_data = json_encode($data);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);
        $curlError = curl_error($ch);
        curl_close($ch);

        if ($curlError) {
            error_log('Curl error: ' . $curlError);
            echo 'Curl error: ' . $curlError;
            return false;
        }

        $responseData = json_decode($response, true);
        if (isset($responseData['candidates'][0]['content']['parts'][0]['text'])) {
            $reviewText = $responseData['candidates'][0]['content']['parts'][0]['text'];
            $stars = 4; 
            
            $this->saveReview($_SESSION['user_id'], $movieTitle,$movie_id, $reviewText, $stars);
            return true;
        } else {
           
            return false;
        }
    }

    private function saveReview($userId, $movieTitle,$movie_id, $reviewText, $stars) {
        global $pdo;


        $stmt = $pdo->prepare("INSERT INTO reviews (user_id, movie_id, review, stars, created_at) VALUES (:user_id, :movie_id, :review, :stars, NOW())");
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':movie_id', $movie_id);
        $stmt->bindParam(':review', $reviewText);
        $stmt->bindParam(':stars', $stars);
        $stmt->execute();
    }

   
    
     
    }
?>
