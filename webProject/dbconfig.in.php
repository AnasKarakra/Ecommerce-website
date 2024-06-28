<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "onlineshope";

try {
    $pdo = new PDO("mysql:host=$hostname;dbname=$database;charset=utf8", $username, $password);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>