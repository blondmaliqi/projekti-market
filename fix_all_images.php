<?php
// fix_all_images.php - Ekzekuto NJE HERE
require_once 'config.php';

$products = $pdo->query("SELECT id, name, image FROM products")->fetchAll();

foreach ($products as $product) {
    $image = $product['image'];
    
    // Hiq 'images/' ose 'images' nga fillimi
    $filename = $image;
    if (strpos($filename, 'images/') === 0) {
        $filename = substr($filename, 7);
    } elseif (strpos($filename, 'images') === 0) {
        $filename = substr($filename, 6);
    }
    
    // Kontrollo nese ekziston
    $filepath = __DIR__ . '/' . $filename;
    
    if (!file_exists($filepath)) {
        // Perdore domate.jpg si placeholder
        echo "❌ Mungon: $filename → Po perdor domate.jpg<br>";
        $newImage = 'domate.jpg';
        $pdo->prepare("UPDATE products SET image = ? WHERE id = ?")->execute([$newImage, $product['id']]);
    } else {
        // Perdore emrin e thjeshte pa images/
        $newImage = $filename;
        if ($image !== $newImage) {
            $pdo->prepare("UPDATE products SET image = ? WHERE id = ?")->execute([$newImage, $product['id']]);
            echo "🔧 Rregulluar: $image → $newImage<br>";
        } else {
            echo "✅ OK: $filename<br>";
        }
    }
}

echo "<br><strong>✅ Mbaroi! Tani rifresko <a href='admin.php?section=products'>admin.php</a></strong>";
?>