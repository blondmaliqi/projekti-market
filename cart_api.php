<?php
// cart_api.php - API për shportën
session_start();
require_once 'config.php';

header('Content-Type: application/json');

// Merr shportën
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $cart = [];
    
    if (isset($_SESSION['user_id'])) {
        $stmt = $pdo->prepare("
            SELECT c.*, p.name, p.price, p.image 
            FROM cart c 
            JOIN products p ON c.product_id = p.id 
            WHERE c.user_id = ?
        ");
        $stmt->execute([$_SESSION['user_id']]);
        $cart = $stmt->fetchAll();
    }
    
    echo json_encode(['cart' => $cart]);
    exit();
}

// Shto në shportë
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['success' => false, 'message' => 'Duhet të jeni i kyçur']);
        exit();
    }
    
    $product_id = $data['product_id'] ?? 0;
    $quantity = $data['quantity'] ?? 1;
    
    $stmt = $pdo->prepare("SELECT id, quantity FROM cart WHERE user_id = ? AND product_id = ?");
    $stmt->execute([$_SESSION['user_id'], $product_id]);
    $existing = $stmt->fetch();
    
    if ($existing) {
        $stmt = $pdo->prepare("UPDATE cart SET quantity = quantity + ? WHERE id = ?");
        $stmt->execute([$quantity, $existing['id']]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)");
        $stmt->execute([$_SESSION['user_id'], $product_id, $quantity]);
    }
    
    echo json_encode(['success' => true]);
    exit();
}

// Përditëso sasinë
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['success' => false]);
        exit();
    }
    
    $product_id = $data['product_id'] ?? 0;
    $quantity = $data['quantity'] ?? 0;
    
    if ($quantity <= 0) {
        $stmt = $pdo->prepare("DELETE FROM cart WHERE user_id = ? AND product_id = ?");
        $stmt->execute([$_SESSION['user_id'], $product_id]);
    } else {
        $stmt = $pdo->prepare("UPDATE cart SET quantity = ? WHERE user_id = ? AND product_id = ?");
        $stmt->execute([$quantity, $_SESSION['user_id'], $product_id]);
    }
    
    echo json_encode(['success' => true]);
    exit();
}

// Fshi nga shporta
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['success' => false]);
        exit();
    }
    
    $product_id = $data['product_id'] ?? 0;
    
    $stmt = $pdo->prepare("DELETE FROM cart WHERE user_id = ? AND product_id = ?");
    $stmt->execute([$_SESSION['user_id'], $product_id]);
    
    echo json_encode(['success' => true]);
    exit();
}

// Zbraz shportën
if ($_SERVER['REQUEST_METHOD'] === 'PATCH') {
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['success' => false]);
        exit();
    }
    
    $stmt = $pdo->prepare("DELETE FROM cart WHERE user_id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    
    echo json_encode(['success' => true]);
    exit();
}
?>