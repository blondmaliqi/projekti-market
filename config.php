<?php
// config.php

// Konfigurimi i Bazës së të Dhënave
$host = 'localhost';
$dbname = 'express_market';
$username = 'root';
$password = '';  // Bosh për XAMPP/Laragon

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("❌ Gabim në lidhje: " . $e->getMessage());
}

// Konfigurimi i Faqes
define('SITE_NAME', 'Express Market');
define('CURRENCY', '€');
define('CURRENCY_CODE', 'EUR');
define('TAX_RATE', 18);
define('FREE_SHIPPING_MIN', 35);
define('SHIPPING_COST', 5);
define('SITE_EMAIL', 'expressmarket@gmail.com');
define('SITE_PHONE', '+383 44 522 777');
define('SITE_ADDRESS', 'Rruga Adem Jashari 12, Gjilan');

// Zona kohore
date_default_timezone_set('Europe/Tirane');

// Sesioni
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Funksion i thjeshtë për login (plain text - vetëm për testim!)
function loginUser($pdo, $email, $password) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
    $stmt->execute([$email, $password]);
    return $stmt->fetch();
}

// Funksion për regjistrim (plain text - vetëm për testim!)
function registerUser($pdo, $firstName, $lastName, $email, $password, $phone = null) {
    $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, email, password, phone) VALUES (?, ?, ?, ?, ?)");
    return $stmt->execute([$firstName, $lastName, $email, $password, $phone]);
}
?>