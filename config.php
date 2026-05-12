<?php
$host = 'localhost';
$dbname = 'u177281879_market';
$username = 'u177281879_market';
$password = 'VENDOS_FJALEKALIMIN_KETU';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    http_response_code(503);
    die("Gabim ne lidhje me databaze. Kontrolloni kredencialet.");
}

define('SITE_NAME', 'Express Market');
define('CURRENCY', 'EUR');
define('TAX_RATE', 18);
define('FREE_SHIPPING_MIN', 35);
define('SHIPPING_COST', 5);
define('SITE_EMAIL', 'expressmarket@gmail.com');
define('SITE_PHONE', '+383 44 522 777');
define('SITE_ADDRESS', 'Rruga Adem Jashari 12, Gjilan');

date_default_timezone_set('Europe/Tirane');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function loginUser($pdo, $email, $password) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    if ($user && password_verify($password, $user['password'])) {
        return $user;
    }
    // fallback for plain-text passwords (old accounts)
    if ($user && $user['password'] === $password) {
        return $user;
    }
    return false;
}

function registerUser($pdo, $firstName, $lastName, $email, $password, $phone = null) {
    $hashed = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, email, password, phone) VALUES (?, ?, ?, ?, ?)");
    return $stmt->execute([$firstName, $lastName, $email, $hashed, $phone]);
}
?>
