<?php
// config/db.php

define('DB_HOST', '5mh.h.filess.io'); 
define('DB_PORT', '3305'); 
define('DB_NAME', 'Project4806_gunnoisehe'); 
define('DB_USER', 'Project4806_gunnoisehe'); 
define('DB_PASS', $_ENV['DB_PASS']); 

try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}
?>
