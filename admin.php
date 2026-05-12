<?php
// admin.php - Paneli i Administrimit Express Market
require_once 'config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

if (!file_exists('images')) {
    mkdir('images', 0755, true);
}


function fixImagePathAdmin($image) {
    if (!$image) return '';
    
    // Hiq 'images/' ose 'images' nga fillimi nëse ka
    $filename = $image;
    if (strpos($filename, 'images/') === 0) {
        $filename = substr($filename, 7);
    } elseif (strpos($filename, 'images') === 0 && strpos($filename, 'images/') !== 0) {
        $filename = substr($filename, 6);
    }
    
    // Kontrollo nëse ekziston në dosjen kryesore
    if (file_exists(__DIR__ . '/' . $filename)) {
        return $filename;
    }
    
    // Kontrollo nëse ekziston në dosjen images/
    if (file_exists(__DIR__ . '/images/' . $filename)) {
        return 'images/' . $filename;
    }
    
    // Kthe emrin e thjeshtë
    return $filename;
}

// ========== AKTIVO KRIJIMIN E PRODUKTIT ==========
if (isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];
    $stock_quantity = $_POST['stock_quantity'];
    $has_alcohol = isset($_POST['has_alcohol']) ? 1 : 0;
    
    // Ngarko foton
    $image = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $filename = $_FILES['image']['name'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        
        if (in_array($ext, $allowed)) {
            $new_filename = time() . '_' . preg_replace('/[^a-zA-Z0-9.]/', '_', $filename);
            $upload_path = 'images/' . $new_filename;
            
            if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_path)) {
                $image = $upload_path;
            }
        }
    }
    
    $stmt = $pdo->prepare("INSERT INTO products (name, description, price, image, category_id, stock_quantity, has_alcohol) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$name, $description, $price, $image, $category_id, $stock_quantity, $has_alcohol]);
    
    $success_message = "✅ Produkti u shtua me sukses!";
}

// ========== PËRDITËSO PRODUKTIN ==========
if (isset($_POST['update_product'])) {
    $id = $_POST['product_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];
    $stock_quantity = $_POST['stock_quantity'];
    $has_alcohol = isset($_POST['has_alcohol']) ? 1 : 0;
    $is_active = isset($_POST['is_active']) ? 1 : 0;
    
    // Përditëso foton nëse ka foto të re
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $filename = $_FILES['image']['name'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        
        if (in_array($ext, $allowed)) {
           $new_filename = time() . '_' . preg_replace('/[^a-zA-Z0-9.]/', '_', $filename);
            $upload_path = 'images/' . $new_filename;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_path)) {
                $old_stmt = $pdo->prepare("SELECT image FROM products WHERE id = ?");
                $old_stmt->execute([$id]);
                $old_image = $old_stmt->fetchColumn();
                if ($old_image && file_exists($old_image)) {
                    unlink($old_image);
                }
                
                $stmt = $pdo->prepare("UPDATE products SET name=?, description=?, price=?, image=?, category_id=?, stock_quantity=?, has_alcohol=?, is_active=? WHERE id=?");
                $stmt->execute([$name, $description, $price, $upload_path, $category_id, $stock_quantity, $has_alcohol, $is_active, $id]);
            }
        }
    } else {
        $stmt = $pdo->prepare("UPDATE products SET name=?, description=?, price=?, category_id=?, stock_quantity=?, has_alcohol=?, is_active=? WHERE id=?");
        $stmt->execute([$name, $description, $price, $category_id, $stock_quantity, $has_alcohol, $is_active, $id]);
    }
    
    $success_message = "✅ Produkti u përditësua me sukses!";
}

// ========== FSHI PRODUKTIN ==========
if (isset($_GET['delete_product'])) {
    $id = (int)$_GET['delete_product'];
    $img_stmt = $pdo->prepare("SELECT image FROM products WHERE id = ?");
    $img_stmt->execute([$id]);
    $image = $img_stmt->fetchColumn();
    if ($image && file_exists($image)) {
        unlink($image);
    }
    $pdo->prepare("DELETE FROM products WHERE id = ?")->execute([$id]);
    $success_message = "Produkti u fshi!";
}

// ========== PËRDITËSO POROSINË ==========
if (isset($_POST['update_order'])) {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];
    $stmt = $pdo->prepare("UPDATE orders SET status=? WHERE id=?");
    $stmt->execute([$status, $order_id]);
    $success_message = "✅ Statusi i porosisë u përditësua!";
}

// ========== FSHI POROSINË ==========
if (isset($_GET['delete_order'])) {
    $order_id = $_GET['delete_order'];
    
    // Fshi artikujt e porosisë
    $pdo->prepare("DELETE FROM order_items WHERE order_id = ?")->execute([$order_id]);
    
    // Fshi porosinë
    $pdo->prepare("DELETE FROM orders WHERE id = ?")->execute([$order_id]);
    
    $success_message = "🗑️ Porosia u fshi me sukses!";
}

// ========== NDRYSHO ROLIN E PËRDORUESIT ==========
if (isset($_POST['update_user_role'])) {
    $user_id = $_POST['user_id'];
    $role = $_POST['role'];
    $stmt = $pdo->prepare("UPDATE users SET role=? WHERE id=?");
    $stmt->execute([$role, $user_id]);
    $success_message = "✅ Roli i përdoruesit u përditësua!";
}

// ========== FSHI PËRDORUESIN ==========
if (isset($_GET['delete_user'])) {
    $id = (int)$_GET['delete_user'];
    $pdo->prepare("DELETE FROM users WHERE id = ? AND id != ?")->execute([$id, $_SESSION['user_id']]);
    $success_message = "Perdoruesi u fshi!";
}

// ========== SHËNO MESAZHIN SI TË LEXUAR ==========
if (isset($_GET['read_contact'])) {
    $id = (int)$_GET['read_contact'];
    $pdo->prepare("UPDATE contacts SET is_read = 1 WHERE id = ?")->execute([$id]);
}

// Merr statistikat
$totalProducts = $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();
$totalUsers = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
$totalOrders = $pdo->query("SELECT COUNT(*) FROM orders")->fetchColumn();
$totalRevenue = $pdo->query("SELECT COALESCE(SUM(total), 0) FROM orders WHERE status != 'cancelled'")->fetchColumn();
$pendingOrders = $pdo->query("SELECT COUNT(*) FROM orders WHERE status = 'pending'")->fetchColumn();
$unreadMessages = $pdo->query("SELECT COUNT(*) FROM contacts WHERE is_read = 0")->fetchColumn();

// Merr kategoritë
$categories = $pdo->query("SELECT * FROM categories ORDER BY name")->fetchAll();

// Seksioni aktiv
$section = $_GET['section'] ?? 'dashboard';
?>

<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Express Market</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Inter', sans-serif;
            background: #f5f5f5;
            color: #1e1e1e;
            display: flex;
            min-height: 100vh;
        }
        
        /* Sidebar */
        .sidebar {
            width: 260px;
            background: #1e2b24;
            color: #e4d9cd;
            padding: 24px 0;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            overflow-y: auto;
        }
        
        .sidebar h2 {
            font-family: 'Playfair Display', serif;
            color: #e7b42c;
            font-size: 22px;
            padding: 0 20px 20px;
            border-bottom: 1px solid #3a4a3e;
            margin-bottom: 20px;
        }
        
        .sidebar h2 i {
            margin-right: 10px;
        }
        
        .sidebar nav a {
            display: block;
            color: #b8c4b8;
            text-decoration: none;
            padding: 12px 20px;
            transition: all 0.2s;
            border-left: 4px solid transparent;
        }
        
        .sidebar nav a:hover, .sidebar nav a.active {
            background: #2a3a30;
            color: #e7b42c;
            border-left-color: #e7b42c;
        }
        
        .sidebar nav a i {
            width: 24px;
            margin-right: 10px;
        }
        
        .sidebar-footer {
            padding: 20px;
            border-top: 1px solid #3a4a3e;
            margin-top: auto;
        }
        
        .sidebar-footer a {
            color: #b8c4b8;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .sidebar-footer a:hover {
            color: #e7b42c;
        }
        
        /* Main Content */
        .main-content {
            margin-left: 260px;
            flex: 1;
            padding: 30px;
        }
        
        .page-title {
            font-family: 'Playfair Display', serif;
            font-size: 32px;
            color: #1e3a2e;
            margin-bottom: 30px;
        }
        
        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            border-radius: 20px;
            padding: 24px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            border: 1px solid #ede5d8;
        }
        
        .stat-card i {
            font-size: 32px;
            color: #e7b42c;
            margin-bottom: 12px;
        }
        
        .stat-number {
            font-size: 32px;
            font-weight: 700;
            color: #1e3a2e;
        }
        
        .stat-label {
            color: #5f6b5e;
            font-size: 14px;
            margin-top: 4px;
        }
        
        /* Table */
        .table-container {
            background: white;
            border-radius: 20px;
            padding: 24px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            border: 1px solid #ede5d8;
            overflow-x: auto;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        th {
            background: #1e3a2e;
            color: white;
            padding: 12px 16px;
            text-align: left;
            font-weight: 600;
            font-size: 13px;
        }
        
        td {
            padding: 12px 16px;
            border-bottom: 1px solid #ede5d8;
            font-size: 14px;
        }
        
        tr:hover {
            background: #fef7ec;
        }
        
        /* Buttons */
        .btn {
            padding: 8px 16px;
            border-radius: 30px;
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
            border: none;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.15s;
        }
        
        .btn-primary {
            background: #e7b42c;
            color: #1e3a2e;
            box-shadow: 0 3px 0 #b47c1c;
        }
        
        .btn-primary:hover {
            background: #f0c040;
            transform: translateY(-2px);
        }
        
        .btn-danger {
            background: #c0392b;
            color: white;
        }
        
        .btn-danger:hover {
            background: #e74c3c;
        }
        
        .btn-success {
            background: #27ae60;
            color: white;
        }
        
        .btn-success:hover {
            background: #2ecc71;
        }
        
        .btn-sm {
            padding: 6px 12px;
            font-size: 11px;
        }
        
        /* Form */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #1e3a2e;
        }
        
        .form-group input, .form-group textarea, .form-group select {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #ede5d8;
            border-radius: 14px;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
        }
        
        .form-group textarea {
            resize: vertical;
            min-height: 80px;
        }
        
        .form-group input:focus, .form-group textarea:focus, .form-group select:focus {
            outline: none;
            border-color: #e7b42c;
        }
        
        .form-group-full {
            grid-column: 1 / -1;
        }
        
        /* Alerts */
        .alert {
            padding: 14px 20px;
            border-radius: 14px;
            margin-bottom: 20px;
            font-weight: 500;
        }
        
        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .alert-info {
            background: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
        }
        
        /* Responsive */
        @media (max-width: 1000px) {
            .sidebar {
                width: 200px;
            }
            .main-content {
                margin-left: 200px;
            }
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .form-grid {
                grid-template-columns: 1fr;
            }
        }
        
        @media (max-width: 700px) {
            .sidebar {
                width: 60px;
            }
            .sidebar h2 span, .sidebar nav a span, .sidebar-footer span {
                display: none;
            }
            .sidebar h2 i, .sidebar nav a i, .sidebar-footer i {
                margin-right: 0;
            }
            .main-content {
                margin-left: 60px;
            }
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<aside class="sidebar">
    <h2><i class="fas fa-store"></i> <span>Express Market</span></h2>
    <nav>
        <a href="?section=dashboard" class="<?php echo $section === 'dashboard' ? 'active' : ''; ?>">
            <i class="fas fa-home"></i> <span>Paneli Kryesor</span>
        </a>
        <a href="?section=products" class="<?php echo $section === 'products' ? 'active' : ''; ?>">
            <i class="fas fa-box"></i> <span>Produktet</span>
        </a>
        <a href="?section=add-product" class="<?php echo $section === 'add-product' ? 'active' : ''; ?>">
            <i class="fas fa-plus-circle"></i> <span>Shto Produkt</span>
        </a>
        <a href="?section=orders" class="<?php echo $section === 'orders' ? 'active' : ''; ?>">
            <i class="fas fa-shopping-cart"></i> <span>Porositë</span>
        </a>
        <a href="?section=users" class="<?php echo $section === 'users' ? 'active' : ''; ?>">
            <i class="fas fa-users"></i> <span>Përdoruesit</span>
        </a>
        <a href="?section=contacts" class="<?php echo $section === 'contacts' ? 'active' : ''; ?>">
            <i class="fas fa-envelope"></i> <span>Mesazhet</span>
        </a>
    </nav>
    <div class="sidebar-footer">
        <a href="index.php"><i class="fas fa-arrow-left"></i> <span>Kthehu te Faqja</span></a>
        <a href="logout.php" style="margin-top: 10px;"><i class="fas fa-sign-out-alt"></i> <span>Dil</span></a>
    </div>
</aside>

<!-- Main Content -->
<main class="main-content">
    
    <?php if (isset($success_message)): ?>
        <div class="alert alert-success"><?php echo $success_message; ?></div>
    <?php endif; ?>
    
    <?php if ($section === 'dashboard'): ?>
        <!-- ==================== PANELI KRYESOR ==================== -->
        <h1 class="page-title"><i class="fas fa-tachometer-alt" style="color: #e7b42c;"></i> Paneli Kryesor</h1>
        
        <div class="stats-grid">
            <div class="stat-card">
                <i class="fas fa-box"></i>
                <div class="stat-number"><?php echo $totalProducts; ?></div>
                <div class="stat-label">Produkte Gjithsej</div>
            </div>
            <div class="stat-card">
                <i class="fas fa-users"></i>
                <div class="stat-number"><?php echo $totalUsers; ?></div>
                <div class="stat-label">Përdorues</div>
            </div>
            <div class="stat-card">
                <i class="fas fa-shopping-cart"></i>
                <div class="stat-number"><?php echo $totalOrders; ?></div>
                <div class="stat-label">Porosi (<?php echo $pendingOrders; ?> në pritje)</div>
            </div>
            <div class="stat-card">
                <i class="fas fa-euro-sign"></i>
                <div class="stat-number"><?php echo number_format($totalRevenue, 2); ?>€</div>
                <div class="stat-label">Të Ardhura Gjithsej</div>
            </div>
        </div>
        
        <div class="table-container">
            <h3 style="margin-bottom: 16px;"><i class="fas fa-clock" style="color: #e7b42c;"></i> Porositë e Fundit</h3>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Klienti</th>
                        <th>Totali</th>
                        <th>Statusi</th>
                        <th>Data</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $recentOrders = $pdo->query("SELECT * FROM orders ORDER BY created_at DESC LIMIT 10")->fetchAll();
                    foreach ($recentOrders as $order):
                    ?>
                    <tr>
                        <td>#<?php echo $order['order_number']; ?></td>
                        <td><?php echo htmlspecialchars($order['full_name']); ?></td>
                        <td><?php echo number_format($order['total'], 2); ?>€</td>
                        <td><?php echo $order['status']; ?></td>
                        <td><?php echo date('d/m/Y', strtotime($order['created_at'])); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
    <?php elseif ($section === 'products'): ?>
        <!-- ==================== TË GJITHA PRODUKTET ==================== -->
        <h1 class="page-title"><i class="fas fa-box" style="color: #e7b42c;"></i> Të Gjitha Produktet</h1>
        <a href="?section=add-product" class="btn btn-primary" style="margin-bottom: 20px;">
            <i class="fas fa-plus"></i> Shto Produkt të Ri
        </a>
        
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Foto</th>
                        <th>Emri</th>
                        <th>Kategoria</th>
                        <th>Çmimi</th>
                        <th>Stoku</th>
                        <th>Statusi</th>
                        <th>Veprimet</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $products = $pdo->query("SELECT p.*, c.name as category_name FROM products p LEFT JOIN categories c ON p.category_id = c.id ORDER BY p.id DESC")->fetchAll();
                    foreach ($products as $product):
                    ?>
                    <tr>
                        <td><?php echo $product['id']; ?></td>
                        <td>
                            <?php if ($product['image']): ?>
                                <img src="<?php echo fixImagePathAdmin($product['image']); ?>" alt="" style="width: 40px; height: 40px; object-fit: cover; border-radius: 8px;" onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2240%22 height=%2240%22%3E%3Crect fill=%22%23fef7ec%22 width=%2240%22 height=%2240%22/%3E%3Ctext x=%2250%25%22 y=%2250%25%22 dominant-baseline=%22middle%22 text-anchor=%22middle%22 font-size=%2220%22 fill=%22%23d4b58c%22%3E📦%3C/text%3E%3C/svg%3E'">
                            <?php else: ?>
                                <i class="fas fa-image" style="color: #ccc;"></i>
                            <?php endif; ?>
                        </td>
                        <td><?php echo htmlspecialchars($product['name']); ?></td>
                        <td><?php echo $product['category_name']; ?></td>
                        <td><?php echo number_format($product['price'], 2); ?>€</td>
                        <td><?php echo $product['stock_quantity']; ?></td>
                        <td><?php echo $product['is_active'] ? '🟢 Aktiv' : '🔴 Joaktiv'; ?></td>
                        <td>
                            <a href="?section=edit-product&id=<?php echo $product['id']; ?>" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                            <a href="?section=products&delete_product=<?php echo $product['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Fshi këtë produkt?')"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
    <?php elseif ($section === 'add-product' || $section === 'edit-product'): ?>
        <!-- ==================== SHTO / PËRDITËSO PRODUKT ==================== -->
        <?php
        $editMode = false;
        $productData = ['name' => '', 'description' => '', 'price' => '', 'image' => '', 'category_id' => '', 'stock_quantity' => 0, 'has_alcohol' => 0, 'is_active' => 1];
        
        if ($section === 'edit-product' && isset($_GET['id'])) {
            $editMode = true;
            $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
            $stmt->execute([$_GET['id']]);
            $productData = $stmt->fetch();
        }
        ?>
        
        <h1 class="page-title">
            <i class="fas <?php echo $editMode ? 'fa-edit' : 'fa-plus-circle'; ?>" style="color: #e7b42c;"></i>
            <?php echo $editMode ? 'Përditëso Produktin' : 'Shto Produkt të Ri'; ?>
        </h1>
        
        <div class="table-container">
            <form method="POST" enctype="multipart/form-data">
                <?php if ($editMode): ?>
                    <input type="hidden" name="product_id" value="<?php echo $productData['id']; ?>">
                <?php endif; ?>
                
                <div class="form-grid">
                    <div class="form-group">
                        <label><i class="fas fa-tag"></i> Emri i Produktit</label>
                        <input type="text" name="name" value="<?php echo htmlspecialchars($productData['name']); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label><i class="fas fa-list"></i> Kategoria</label>
                        <select name="category_id" required>
                            <option value="">Zgjidh kategorinë</option>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?php echo $cat['id']; ?>" <?php echo $productData['category_id'] == $cat['id'] ? 'selected' : ''; ?>>
                                    <?php echo $cat['name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label><i class="fas fa-euro-sign"></i> Çmimi (€)</label>
                        <input type="number" name="price" step="0.01" value="<?php echo $productData['price']; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label><i class="fas fa-cubes"></i> Sasia në Stok</label>
                        <input type="number" name="stock_quantity" value="<?php echo $productData['stock_quantity']; ?>" required>
                    </div>
                    
                    <div class="form-group form-group-full">
                        <label><i class="fas fa-align-left"></i> Përshkrimi</label>
                        <textarea name="description"><?php echo htmlspecialchars($productData['description']); ?></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label><i class="fas fa-image"></i> Foto e Produktit</label>
                        <?php if ($editMode && $productData['image']): ?>
                            <p style="margin-bottom: 8px; font-size: 13px; color: #666;">
                                Foto aktuale: <?php echo $productData['image']; ?>
                                <br>Ngarko foto të re për ta zëvendësuar
                            </p>
                        <?php endif; ?>
                        <input type="file" name="image" accept="image/*" <?php echo $editMode ? '' : ''; ?>>
                    </div>
                    
                    <div class="form-group">
                        <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                            <input type="checkbox" name="has_alcohol" <?php echo $productData['has_alcohol'] ? 'checked' : ''; ?>>
                            <span>Produkt Alkoolik (+18)</span>
                        </label>
                        <?php if ($editMode): ?>
                            <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; margin-top: 10px;">
                                <input type="checkbox" name="is_active" <?php echo $productData['is_active'] ? 'checked' : ''; ?>>
                                <span>Produkt Aktiv</span>
                            </label>
                        <?php endif; ?>
                    </div>
                </div>
                
                <button type="submit" name="<?php echo $editMode ? 'update_product' : 'add_product'; ?>" class="btn btn-primary" style="margin-top: 20px;">
                    <i class="fas <?php echo $editMode ? 'fa-save' : 'fa-plus'; ?>"></i>
                    <?php echo $editMode ? 'Përditëso Produktin' : 'Shto Produktin'; ?>
                </button>
                
                <?php if ($editMode): ?>
                    <a href="?section=products" class="btn" style="margin-top: 20px; background: #ccc; color: #333;">
                        <i class="fas fa-times"></i> Anulo
                    </a>
                <?php endif; ?>
            </form>
        </div>


        <?php elseif ($section === 'orders'): ?>
    <!-- ==================== POROSITË ==================== -->
    <h1 class="page-title"><i class="fas fa-shopping-cart" style="color: #e7b42c;"></i> Porositë</h1>
    
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Emri i Plotë</th>
                    <th>Email</th>
                    <th>Adresa</th>
                    <th>Qyteti</th>
                    <th>Kodi Postar</th>
                    <th>Telefoni</th>
                    <th>Pagesa</th>
                    <th>Totali</th>
                    <th>Statusi</th>
                    <th>Data</th>
                    <th>Veprimet</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $orders = $pdo->query("SELECT * FROM orders ORDER BY created_at DESC")->fetchAll();
                foreach ($orders as $order):
                ?>
                <tr>
                    <td><strong>#<?php echo htmlspecialchars($order['order_number']); ?></strong></td>
                    <td><?php echo htmlspecialchars($order['full_name']); ?></td>
                    <td><?php echo htmlspecialchars($order['email']); ?></td>
                    <td><?php echo htmlspecialchars($order['address']); ?></td>
                    <td><?php echo htmlspecialchars($order['city']); ?></td>
                    <td><?php echo htmlspecialchars($order['postal_code']); ?></td>
                    <td><?php echo htmlspecialchars($order['phone']); ?></td>
                    <td><?php echo $order['payment_method'] === 'cash' ? '💵 Cash' : '💳 Kartë'; ?></td>
                    <td><strong><?php echo number_format($order['total'], 2); ?>€</strong></td>
                    <td>
                        <form method="POST" style="display: inline;">
                            <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                            <select name="status" onchange="this.form.submit()" style="padding: 6px 10px; border-radius: 8px; font-size: 12px;">
                                <option value="pending" <?php echo $order['status'] === 'pending' ? 'selected' : ''; ?>>Në Pritje</option>
                                <option value="confirmed" <?php echo $order['status'] === 'confirmed' ? 'selected' : ''; ?>>Konfirmuar</option>
                                <option value="shipped" <?php echo $order['status'] === 'shipped' ? 'selected' : ''; ?>>Transportuar</option>
                                <option value="delivered" <?php echo $order['status'] === 'delivered' ? 'selected' : ''; ?>>Dorëzuar</option>
                                <option value="cancelled" <?php echo $order['status'] === 'cancelled' ? 'selected' : ''; ?>>Anuluar</option>
                            </select>
                            <input type="hidden" name="update_order" value="1">
                        </form>
                    </td>
                    <td><?php echo date('d/m/Y H:i', strtotime($order['created_at'])); ?></td>
                    <td style="display: flex; gap: 6px;">
                        <button class="btn btn-primary btn-sm" onclick="alert('Detajet e Porosisë #<?php echo $order['order_number']; ?>\n\n👤 Klienti: <?php echo htmlspecialchars($order['full_name']); ?>\n📧 Email: <?php echo htmlspecialchars($order['email']); ?>\n📞 Tel: <?php echo htmlspecialchars($order['phone']); ?>\n📍 Adresa: <?php echo htmlspecialchars($order['address']); ?>\n🏙️ Qyteti: <?php echo htmlspecialchars($order['city']); ?>\n📮 Kodi Postar: <?php echo htmlspecialchars($order['postal_code']); ?>\n💰 Totali: <?php echo number_format($order['total'], 2); ?>€\n💳 Pagesa: <?php echo $order['payment_method'] === 'cash' ? 'Cash' : 'Kartë'; ?>')">
                            <i class="fas fa-eye"></i>
                        </button>
                        <a href="?section=orders&delete_order=<?php echo $order['id']; ?>" 
                           class="btn btn-danger btn-sm" 
                           onclick="return confirm('Fshi porosinë #<?php echo $order['order_number']; ?>?')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
        
   <?php elseif ($section === 'users'): ?>
    <!-- ==================== PËRDORUESIT ==================== -->
    <h1 class="page-title"><i class="fas fa-users" style="color: #e7b42c;"></i> Përdoruesit</h1>
    
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Emri</th>
                    <th>Email</th>
                    <th>Telefoni</th>
                    <th>Roli</th>
                    <th>Regjistruar</th>
                    <th>Veprimet</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $users = $pdo->query("SELECT * FROM users ORDER BY id DESC")->fetchAll();
                foreach ($users as $user):
                ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo htmlspecialchars($user['phone'] ?? '-'); ?></td>
                    <td>
                        <?php if ($user['role'] === 'admin'): ?>
                             Admin
                        <?php else: ?>
                            🛒 Klient
                        <?php endif; ?>
                    </td>
                    <td><?php echo date('d/m/Y', strtotime($user['created_at'])); ?></td>
                    <td style="display: flex; gap: 6px;">
                        <?php if ($user['id'] != $_SESSION['user_id'] && $user['role'] !== 'admin'): ?>
                            <a href="?section=users&delete_user=<?php echo $user['id']; ?>" 
                               class="btn btn-danger btn-sm" 
                               onclick="return confirm('Fshi përdoruesin <?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?>?')">
                                <i class="fas fa-trash"></i>
                            </a>
                        <?php elseif ($user['role'] === 'admin'): ?>
                            <small style="color: #999;">Admin</small>
                        <?php else: ?>
                            <small style="color: #999;">Ju</small>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
        
    
        
    <?php elseif ($section === 'contacts'): ?>
        <!-- ==================== MESAZHET ==================== -->
        <h1 class="page-title"><i class="fas fa-envelope" style="color: #e7b42c;"></i> Mesazhet (<?php echo $unreadMessages; ?> të palexuara)</h1>
        
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Emri</th>
                        <th>Email</th>
                        <th>Subjekti</th>
                        <th>Mesazhi</th>
                        <th>Data</th>
                        <th>Statusi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $contacts = $pdo->query("SELECT * FROM contacts ORDER BY created_at DESC")->fetchAll();
                    foreach ($contacts as $contact):
                    ?>
                    <tr style="<?php echo !$contact['is_read'] ? 'font-weight: 600; background: #fef7ec;' : ''; ?>">
                        <td><?php echo $contact['id']; ?></td>
                        <td><?php echo $contact['first_name'] . ' ' . $contact['last_name']; ?></td>
                        <td><?php echo $contact['email']; ?></td>
                        <td><?php echo $contact['subject']; ?></td>
                        <td><?php echo substr(htmlspecialchars($contact['message']), 0, 50); ?>...</td>
                        <td><?php echo date('d/m/Y H:i', strtotime($contact['created_at'])); ?></td>
                        <td>
                            <?php if (!$contact['is_read']): ?>
                                <a href="?section=contacts&read_contact=<?php echo $contact['id']; ?>" class="btn btn-primary btn-sm">
                                    <i class="fas fa-check"></i> Lexo
                                </a>
                            <?php else: ?>
                                ✅ Lexuar
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
    <?php endif; ?>
    
</main>

</body>
</html>