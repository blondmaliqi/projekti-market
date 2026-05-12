<?php
// checkout_api.php - API për ruajtjen e porosive
session_start();
require_once 'config.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    file_put_contents('debug_log.txt', print_r($data, true));
    
    $fullName = $data['fullName'] ?? '';
    $email = $data['email'] ?? '';
    $phone = $data['phone'] ?? '';
    $address = $data['address'] ?? '';
    $city = $data['city'] ?? '';
    $postal_code = $data['postal_code'] ?? '';
    $paymentMethod = $data['paymentMethod'] ?? 'cash';
    
    // Merr artikujt nga shporta
    $userId = $_SESSION['user_id'] ?? null;
    
    if ($userId) {
        // Merr nga MySQL
        $stmt = $pdo->prepare("SELECT c.*, p.name, p.price, p.image FROM cart c JOIN products p ON c.product_id = p.id WHERE c.user_id = ?");
        $stmt->execute([$userId]);
        $cartItems = $stmt->fetchAll();
    } else {
        // Merr nga localStorage (dërguar nga JavaScript)
        $cartItems = $data['cartItems'] ?? [];
    }
    
    if (empty($cartItems)) {
        echo json_encode(['success' => false, 'message' => 'Shporta është bosh']);
        exit();
    }
    
    // Llogarit totalet
    $subtotal = 0;
    foreach ($cartItems as $item) {
        $subtotal += $item['price'] * $item['quantity'];
    }
    $shipping = $subtotal >= 35 ? 0 : 5;
    $total = $subtotal + $shipping;
    
    // Gjenero numrin e porosisë
    $orderNumber = 'EM-' . strtoupper(substr(md5(uniqid()), 0, 8));
    
    try {
        $pdo->beginTransaction();
        
        // Ruaj porosinë
        $stmt = $pdo->prepare("INSERT INTO orders (user_id, order_number, full_name, email, phone, address, city, postal_code, subtotal, shipping, total, payment_method, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending')");
        $stmt->execute([$userId, $orderNumber, $fullName, $email, $phone, $address, $city, $postal_code, $subtotal, $shipping, $total, $paymentMethod]);
        $orderId = $pdo->lastInsertId();
        
        // Ruaj artikujt e porosisë
        foreach ($cartItems as $item) {
            $stmt = $pdo->prepare("INSERT INTO order_items (order_id, product_id, product_name, product_price, product_image, quantity) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$orderId, $item['product_id'] ?? $item['id'], $item['name'], $item['price'], $item['image'] ?? '', $item['quantity']]);
        }
        
        // Zbraz shportën
        if ($userId) {
            $stmt = $pdo->prepare("DELETE FROM cart WHERE user_id = ?");
            $stmt->execute([$userId]);
        }
        
        $pdo->commit();
        
        echo json_encode(['success' => true, 'orderNumber' => $orderNumber]);
    } catch(Exception $e) {
        $pdo->rollBack();
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
    exit();
}
?>