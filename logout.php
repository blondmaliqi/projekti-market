<?php
// logout.php - Dil nga llogaria
require_once 'config.php';

// Pastro të gjitha variablat e sesionit
$_SESSION = array();

// Nëse përdoret cookie për sesionin, fshije atë
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Shkatërro sesionin
session_destroy();

// Ridrejto në kryefaqe
header('Location: index.php');
exit();
?>