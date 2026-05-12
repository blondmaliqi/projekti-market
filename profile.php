<?php
// profile.php - Profili i Përdoruesit
require_once 'config.php';

// Kontrollo nëse përdoruesi është i kyçur
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$success_message = '';
$error_message = '';

// Përditëso profilin
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $first_name = trim($_POST['first_name'] ?? '');
    $last_name = trim($_POST['last_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $city = trim($_POST['city'] ?? '');
    $postal_code = trim($_POST['postal_code'] ?? '');
    
    $stmt = $pdo->prepare("UPDATE users SET first_name=?, last_name=?, email=?, phone=?, address=?, city=?, postal_code=? WHERE id=?");
    if ($stmt->execute([$first_name, $last_name, $email, $phone, $address, $city, $postal_code, $user_id])) {
        $_SESSION['user_name'] = $first_name . ' ' . $last_name;
        $_SESSION['user_email'] = $email;
        $success_message = "✅ Profili u përditësua me sukses!";
    }
}

// Ndrysho fjalëkalimin
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_password'])) {
    $current_password = $_POST['current_password'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    
    if ($new_password !== $confirm_password) {
        $error_message = "❌ Fjalëkalimet e reja nuk përputhen!";
    } elseif (strlen($new_password) < 6) {
        $error_message = "❌ Fjalëkalimi i ri duhet të ketë të paktën 6 karaktere!";
    } else {
        $stmt = $pdo->prepare("SELECT password FROM users WHERE id = ?");
        $stmt->execute([$user_id]);
        $user_pw = $stmt->fetch();
        
        if ($user_pw['password'] !== $current_password) {
            $error_message = "❌ Fjalëkalimi aktual është i pasaktë!";
        } else {
            $stmt = $pdo->prepare("UPDATE users SET password=? WHERE id=?");
            $stmt->execute([$new_password, $user_id]);
            $success_message = "✅ Fjalëkalimi u ndryshua me sukses!";
        }
    }
}

// Fshi llogarinë
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_account'])) {
    $delete_password = $_POST['delete_password'] ?? '';
    
    // Kontrollo fjalëkalimin
    $stmt = $pdo->prepare("SELECT password FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $user_pw = $stmt->fetch();
    
    if ($user_pw['password'] !== $delete_password) {
        $error_message = "❌ Fjalëkalimi është i pasaktë!";
    } else {
        // Fshi të dhënat e përdoruesit
        $pdo->beginTransaction();
        try {
            // Fshi artikujt e shportës
            $pdo->prepare("DELETE FROM cart WHERE user_id = ?")->execute([$user_id]);
            // Fshi porositë (ose mbaji me user_id NULL)
            $pdo->prepare("UPDATE orders SET user_id = NULL WHERE user_id = ?")->execute([$user_id]);
            // Fshi përdoruesin
            $pdo->prepare("DELETE FROM users WHERE id = ?")->execute([$user_id]);
            $pdo->commit();
            
            // Shkatërro sesionin dhe ridrejto
            session_destroy();
            header('Location: index.php?deleted=1');
            exit();
        } catch(Exception $e) {
            $pdo->rollBack();
            $error_message = "❌ Ndodhi një gabim gjatë fshirjes së llogarisë.";
        }
    }
}


// Merr të dhënat e përdoruesit
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

// Merr porositë e përdoruesit
$stmt = $pdo->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC LIMIT 10");
$stmt->execute([$user_id]);
$orders = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="sq">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Express Market · Profili</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    
    body {
      font-family: 'Inter', sans-serif;
      background: #fefcf5;
      color: #1e1e1e;
      line-height: 1.5;
    }

    .container {
      max-width: 1280px;
      margin: 0 auto;
      padding: 0 24px;
    }

    /* Header - IDENTIK ME index.php */
    .site-header {
      background: white;
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.03);
      padding: 6px 0;
      position: sticky;
      top: 0;
      z-index: 50;
      border-bottom: 1px solid #f0e9de;
    }

    .header-flex {
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
    }

    .logo-area {
      display: flex;
      align-items: center;
      gap: 14px;
      text-decoration: none;
      color: inherit;
      transition: 0.2s;
    }

    .logo-area:hover {
      transform: scale(1.03);
    }

    .logo-img {
      height: 100px;
      width: auto;
      max-width: 200px;
      object-fit: contain;
    }

    .nav-links {
      display: flex;
      gap: 36px;
      font-weight: 500;
    }

    .nav-links a {
      text-decoration: none;
      color: #2e3f34;
      font-size: 16px;
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .nav-links a i {
      color: #e7b42c;
    }

    .nav-links a:hover {
      color: #b47c1c;
    }

    .header-actions {
      display: flex;
      gap: 18px;
    }

    .cart-btn {
      background: #1e3a2e;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 40px;
      font-weight: 600;
      font-size: 14px;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 8px;
      box-shadow: 0 4px 0 #0f231b;
      transition: all 0.15s;
      text-decoration: none;
    }

    .cart-btn:hover {
      background: #2c543e;
      transform: translateY(-2px);
    }

    .cart-count {
      background: #e7b42c;
      color: #1e3a2e;
      border-radius: 30px;
      padding: 2px 8px;
      font-size: 13px;
      font-weight: 700;
    }

    .login-btn, .signup-btn {
      background: transparent;
      color: #1e3a2e;
      border: 2px solid #e7b42c;
      padding: 10px 20px;
      border-radius: 40px;
      font-weight: 600;
      font-size: 14px;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 8px;
      transition: all 0.15s;
      text-decoration: none;
    }

    .login-btn:hover {
      background: #fef7ec;
    }

    .signup-btn {
      background: #e7b42c;
      color: #1e3a2e;
      border: none;
      box-shadow: 0 4px 0 #b47c1c;
    }

    .signup-btn:hover {
      background: #f0c040;
      transform: translateY(-2px);
    }

    /* Page Header */
    .page-header {
      padding: 30px 0 20px;
      text-align: center;
    }

    .page-header h1 {
      font-family: 'Playfair Display', serif;
      font-size: 36px;
      color: #1e3a2e;
    }

    .page-header p {
      color: #6b4f2c;
    }

    .user-avatar {
      width: 100px;
      height: 100px;
      background: #fef7ec;
      border-radius: 50px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 16px;
      border: 4px solid #e7b42c;
    }

    .user-avatar i {
      font-size: 48px;
      color: #1e3a2e;
    }

    .user-role-badge {
      display: inline-block;
      background: <?php echo $user['role'] === 'admin' ? '#e7b42c' : '#1e3a2e'; ?>;
      color: <?php echo $user['role'] === 'admin' ? '#1e3a2e' : 'white'; ?>;
      padding: 4px 16px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 600;
      margin-top: 8px;
    }

    /* Layout */
    .profile-layout {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 30px;
      margin: 30px 0 50px;
    }

    .card {
      background: white;
      border-radius: 28px;
      padding: 28px;
      box-shadow: 0 12px 28px -8px rgba(0,0,0,0.04);
      border: 1px solid #ede5d8;
    }

    .card h3 {
      font-family: 'Playfair Display', serif;
      font-size: 22px;
      margin-bottom: 20px;
      color: #1e3a2e;
      display: flex;
      align-items: center;
      gap: 10px;
      border-bottom: 2px solid #f0e4d5;
      padding-bottom: 12px;
    }

    .card h3 i {
      color: #e7b42c;
    }

    .form-group {
      margin-bottom: 16px;
    }

    .form-group label {
      display: block;
      margin-bottom: 6px;
      font-weight: 600;
      color: #1e3a2e;
      font-size: 13px;
    }

    .form-group input {
      width: 100%;
      padding: 11px 14px;
      border: 2px solid #ede5d8;
      border-radius: 14px;
      font-size: 14px;
      font-family: 'Inter', sans-serif;
    }

    .form-group input:focus {
      outline: none;
      border-color: #e7b42c;
    }

    .form-row {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 14px;
    }

    .alert {
      padding: 12px 16px;
      border-radius: 14px;
      margin-bottom: 16px;
      font-size: 14px;
    }

    .alert-success {
      background: #d4edda;
      color: #155724;
    }

    .alert-error {
      background: #fce4e4;
      color: #c0392b;
    }

    /* Orders Table */
    .orders-table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 16px;
      font-size: 13px;
    }

    .orders-table th {
      background: #1e3a2e;
      color: white;
      padding: 10px 12px;
      text-align: left;
    }

    .orders-table td {
      padding: 10px 12px;
      border-bottom: 1px solid #ede5d8;
    }

    .orders-table tr:hover {
      background: #fef7ec;
    }

    .status-badge {
      padding: 4px 10px;
      border-radius: 15px;
      font-size: 11px;
      font-weight: 600;
    }

    .status-pending { background: #fff3cd; color: #856404; }
    .status-confirmed { background: #d1ecf1; color: #0c5460; }
    .status-shipped { background: #d4edda; color: #155724; }
    .status-delivered { background: #d4edda; color: #155724; }
    .status-cancelled { background: #fce4e4; color: #c0392b; }

    /* Footer */
    .footer {
      background: #1e2b24;
      color: #e4d9cd;
      padding: 50px 0 20px;
      margin-top: 60px;
      border-radius: 48px 48px 0 0;
    }

    .footer-top {
      display: grid;
      grid-template-columns: 1.5fr 1fr 1fr 1.2fr;
      gap: 40px;
      margin-bottom: 40px;
    }

    .footer-column h4 {
      color: white;
      font-size: 18px;
      margin-bottom: 20px;
      font-weight: 600;
    }

    .footer-column p {
      margin-bottom: 10px;
      color: #b8c4b8;
    }

    .footer-column i {
      color: #e7b42c;
      width: 20px;
      margin-right: 8px;
    }

    .footer-links {
      list-style: none;
    }

    .footer-links li {
      margin-bottom: 12px;
    }

    .footer-links a {
      color: #b8c4b8;
      text-decoration: none;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .footer-links a:hover {
      color: #e7b42c;
    }

    .footer-social {
      display: flex;
      gap: 12px;
      margin-bottom: 20px;
    }

    .footer-social a {
      background: #2a3a30;
      width: 45px;
      height: 45px;
      border-radius: 14px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #e4d9cd;
      font-size: 20px;
      text-decoration: none;
    }

    .footer-social a:hover {
      background: #e7b42c;
      color: #1e2b24;
    }

    .payment-icons {
      display: flex;
      gap: 12px;
      font-size: 28px;
      color: #b8c4b8;
    }

    .footer-bottom {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding-top: 30px;
      border-top: 1px solid #3a4a3e;
      font-size: 14px;
      color: #9aab9a;
    }

    .footer-bottom-links {
      display: flex;
      gap: 16px;
    }

    .footer-bottom-links a {
      color: #9aab9a;
      text-decoration: none;
    }

    .footer-bottom-links a:hover {
      color: #e7b42c;
    }
    

    @media (max-width: 768px) {
      .profile-layout {
        grid-template-columns: 1fr;
      }
      .form-row {
        grid-template-columns: 1fr;
      }
      .header-flex {
        flex-direction: column;
        gap: 12px;
      }
    }

    .footer .logo-text {
      color: #e7b42c;
      font-size: 26px;
    }


    .btn {
  padding: 12px 24px;
  border-radius: 40px;
  font-weight: 600;
  font-size: 15px;
  cursor: pointer;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  transition: all 0.15s;
  border: none;
  width: 100%;
}

.btn-save {
  background: #e7b42c;
  color: #1e3a2e;
  box-shadow: 0 4px 0 #b47c1c;
}

.btn-save:hover {
  background: #f0c040;
  transform: translateY(-2px);
  box-shadow: 0 6px 0 #b47c1c;
}

.btn-password {
  background: #1e3a2e;
  color: white;
  box-shadow: 0 4px 0 #0f231b;
}

.btn-password:hover {
  background: #2c543e;
  transform: translateY(-2px);
  box-shadow: 0 6px 0 #0f231b;
}

.btn-delete {
  background: #c0392b;
  color: white;
  box-shadow: 0 4px 0 #8b1a1a;
}

.btn-delete:hover {
  background: #e74c3c;
  transform: translateY(-2px);
  box-shadow: 0 6px 0 #8b1a1a;
}


/* ============================================= */
/* RESPONSIVE PËR TË GJITHA LLOJET E TELEFONAVE */
/* ============================================= */

/* Telefona të vegjël (iPhone SE, Galaxy S5, etj.) - deri 375px */
@media (max-width: 375px) {
  .container {
    padding: 0 12px;
  }
  
  .logo-img {
    height: 60px;
    max-width: 140px;
  }
  
  .nav-links {
    gap: 10px;
    flex-wrap: wrap;
    justify-content: center;
  }
  
  .nav-links a {
    font-size: 12px;
    gap: 4px;
  }
  
  .header-actions {
    gap: 6px;
    flex-wrap: wrap;
    justify-content: center;
  }
  
  .login-btn, .signup-btn {
    padding: 6px 10px;
    font-size: 11px;
    gap: 4px;
  }
  
  .cart-btn {
    padding: 6px 10px;
    font-size: 11px;
    gap: 4px;
  }
  
  .page-header h1 {
    font-size: 24px;
  }
  
  .page-header p {
    font-size: 13px;
  }
  
  .user-avatar {
    width: 70px;
    height: 70px;
  }
  
  .user-avatar i {
    font-size: 32px;
  }
  
  .profile-layout {
    grid-template-columns: 1fr;
    gap: 16px;
    margin: 20px 0 30px;
  }
  
  .card {
    padding: 18px 14px;
    border-radius: 20px;
  }
  
  .card h3 {
    font-size: 18px;
    margin-bottom: 14px;
    gap: 8px;
  }
  
  .form-group {
    margin-bottom: 12px;
  }
  
  .form-group label {
    font-size: 12px;
    margin-bottom: 4px;
  }
  
  .form-group input {
    padding: 9px 12px;
    border-radius: 10px;
    font-size: 13px;
  }
  
  .form-row {
    grid-template-columns: 1fr;
    gap: 10px;
  }
  
  .btn {
    padding: 10px 16px;
    font-size: 13px;
    gap: 6px;
  }
  
  .orders-table {
    font-size: 11px;
  }
  
  .orders-table th,
  .orders-table td {
    padding: 7px 8px;
  }
  
  .status-badge {
    padding: 3px 6px;
    font-size: 9px;
  }
  
  .footer {
    padding: 30px 0 15px;
    margin-top: 40px;
    border-radius: 30px 30px 0 0;
  }
  
  .footer-top {
    grid-template-columns: 1fr;
    gap: 20px;
    margin-bottom: 25px;
  }
  
  .footer-column h4 {
    font-size: 16px;
    margin-bottom: 12px;
  }
  
  .footer-social {
    justify-content: center;
  }
  
  .payment-icons {
    justify-content: center;
    font-size: 22px;
  }
}

/* Telefona të mesëm (iPhone 12/13/14, Pixel, etj.) - 376px deri 430px */
@media (min-width: 376px) and (max-width: 430px) {
  .container {
    padding: 0 16px;
  }
  
  .logo-img {
    height: 70px;
    max-width: 160px;
  }
  
  .nav-links {
    gap: 14px;
    flex-wrap: wrap;
    justify-content: center;
  }
  
  .nav-links a {
    font-size: 13px;
    gap: 4px;
  }
  
  .header-actions {
    gap: 8px;
    flex-wrap: wrap;
    justify-content: center;
  }
  
  .login-btn, .signup-btn {
    padding: 7px 14px;
    font-size: 12px;
    gap: 5px;
  }
  
  .cart-btn {
    padding: 7px 14px;
    font-size: 12px;
    gap: 5px;
  }
  
  .page-header h1 {
    font-size: 28px;
  }
  
  .user-avatar {
    width: 80px;
    height: 80px;
  }
  
  .user-avatar i {
    font-size: 38px;
  }
  
  .profile-layout {
    grid-template-columns: 1fr;
    gap: 20px;
    margin: 22px 0 35px;
  }
  
  .card {
    padding: 22px 16px;
    border-radius: 24px;
  }
  
  .card h3 {
    font-size: 20px;
  }
  
  .form-group input {
    padding: 10px 13px;
    font-size: 14px;
  }
  
  .btn {
    padding: 11px 20px;
    font-size: 14px;
  }
  
  .orders-table {
    font-size: 12px;
  }
  
  .footer {
    padding: 35px 0 15px;
    margin-top: 45px;
    border-radius: 35px 35px 0 0;
  }
  
  .footer-top {
    grid-template-columns: 1fr;
    gap: 24px;
  }
  
  .footer-social {
    justify-content: center;
  }
  
  .payment-icons {
    justify-content: center;
  }
}

/* Telefona të mëdhenj (iPhone 14 Pro Max, Galaxy S23 Ultra, etj.) - 431px deri 540px */
@media (min-width: 431px) and (max-width: 540px) {
  .logo-img {
    height: 80px;
    max-width: 180px;
  }
  
  .nav-links {
    gap: 18px;
    flex-wrap: wrap;
    justify-content: center;
  }
  
  .nav-links a {
    font-size: 14px;
  }
  
  .header-actions {
    gap: 10px;
    flex-wrap: wrap;
    justify-content: center;
  }
  
  .login-btn, .signup-btn, .cart-btn {
    padding: 8px 16px;
    font-size: 13px;
  }
  
  .profile-layout {
    grid-template-columns: 1fr;
    gap: 22px;
  }
  
  .footer-top {
    grid-template-columns: repeat(2, 1fr);
    gap: 24px;
  }
}

/* Të gjithë telefonat - navigim dhe layout i përbashkët */
@media (max-width: 768px) {
  .header-flex {
    flex-direction: column;
    gap: 12px;
    padding: 8px 0;
  }
  
  .logo-area {
    justify-content: center;
    width: 100%;
  }
  
  .nav-links {
    width: 100%;
    justify-content: center;
    gap: 16px;
  }
  
  .header-actions {
    width: 100%;
    justify-content: center;
    gap: 10px;
  }
  
  .profile-layout {
    grid-template-columns: 1fr;
  }
  
  .form-row {
    grid-template-columns: 1fr;
  }
  
  .orders-table {
    display: block;
    overflow-x: auto;
  }
  
  .footer-bottom {
    flex-direction: column;
    text-align: center;
    gap: 10px;
  }
  
  .footer-bottom-links {
    justify-content: center;
    flex-wrap: wrap;
  }
}

/* Tableta të vogla - 541px deri 800px */
@media (min-width: 541px) and (max-width: 800px) {
  .profile-layout {
    grid-template-columns: 1fr;
    gap: 24px;
  }
  
  .footer-top {
    grid-template-columns: repeat(2, 1fr);
  }
}

/* Tableta - 801px deri 1024px */
@media (min-width: 801px) and (max-width: 1024px) {
  .nav-links {
    gap: 24px;
  }
  
  .nav-links a {
    font-size: 15px;
  }
  
  .footer-top {
    grid-template-columns: repeat(3, 1fr);
  }
}

/* Orientimi peizazh në telefon */
@media (max-height: 500px) and (orientation: landscape) {
  .profile-layout {
    grid-template-columns: 1fr 1fr;
    gap: 16px;
  }
  
  .card {
    padding: 14px;
  }
  
  .card h3 {
    font-size: 16px;
    margin-bottom: 10px;
  }
  
  .form-group {
    margin-bottom: 8px;
  }
  
  .form-group input {
    padding: 7px 10px;
    font-size: 12px;
  }
  
  .btn {
    padding: 8px 14px;
    font-size: 12px;
  }
  
  .orders-table {
    font-size: 10px;
  }
  
  .orders-table th,
  .orders-table td {
    padding: 5px 6px;
  }
}
  </style>
</head>
<body>

<header class="site-header">
  <div class="container header-flex">
    <a href="index.php" class="logo-area">  
      <img src="expressmarketlogo.png" alt="Express Market" class="logo-img">
    </a>

    <nav class="nav-links">
      <a href="index.php"><i class="fas fa-home"></i> Kryefaqja</a>
      <a href="produktet.php"><i class="fas fa-box"></i> Produktet</a>
      <a href="navizitoni.php"><i class="fas fa-map-pin"></i> Na Vizitoni</a>
      <a href="rrethnesh.php"><i class="fas fa-info-circle"></i> Rreth Nesh</a>
    </nav>

    <div class="header-actions">
      <a href="profile.php" class="login-btn" style="background: #fef7ec; border-color: #e7b42c; font-weight: 700;">
        <i class="fas fa-user"></i> <?php echo $_SESSION['user_name']; ?>
      </a>
      <?php if ($user['role'] === 'admin'): ?>
        <a href="admin.php" class="signup-btn">
          <i class="fas fa-cog"></i> Admin
        </a>
      <?php endif; ?>
      <a href="logout.php" class="cart-btn">
        <i class="fas fa-sign-out-alt"></i> Dil
      </a>
      <a href="shporta.php" class="cart-btn">
        <i class="fas fa-shopping-basket"></i> Shporta
        <span class="cart-count" id="cartCounter">0</span>
      </a>
    </div>
  </div>
</header>

<main class="container">
  <div class="page-header">
    <div class="user-avatar">
      <i class="fas fa-user"></i>
    </div>
    <h1><?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?></h1>
    <p><?php echo htmlspecialchars($user['email']); ?></p>
    <span class="user-role-badge"><?php echo $user['role'] === 'admin' ? '👑 Admin' : '🛒 Klient'; ?></span>
  </div>

  <?php if ($success_message): ?>
    <div class="alert alert-success"><?php echo $success_message; ?></div>
  <?php endif; ?>

  <?php if ($error_message): ?>
    <div class="alert alert-error"><?php echo $error_message; ?></div>
  <?php endif; ?>

  <div class="profile-layout">
    <div class="card">
      <h3><i class="fas fa-user-edit"></i> Përditëso Profilin</h3>
      <form method="POST">
        <div class="form-row">
          <div class="form-group">
            <label>Emri</label>
            <input type="text" name="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>" required>
          </div>
          <div class="form-group">
            <label>Mbiemri</label>
            <input type="text" name="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>" required>
          </div>
        </div>
        <div class="form-group">
          <label>Email</label>
          <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        </div>
        <div class="form-group">
          <label>Telefoni</label>
          <input type="tel" name="phone" value="<?php echo htmlspecialchars($user['phone'] ?? ''); ?>">
        </div>
        <div class="form-group">
          <label>Adresa</label>
          <input type="text" name="address" value="<?php echo htmlspecialchars($user['address'] ?? ''); ?>">
        </div>
        <div class="form-row">
          <div class="form-group">
            <label>Qyteti</label>
            <input type="text" name="city" value="<?php echo htmlspecialchars($user['city'] ?? ''); ?>">
          </div>
          <div class="form-group">
            <label>Kodi Postar</label>
            <input type="text" name="postal_code" value="<?php echo htmlspecialchars($user['postal_code'] ?? ''); ?>">
          </div>
        </div>
        <button type="submit" name="update_profile" class="btn btn-save">
  <i class="fas fa-save"></i> Ruaj Ndryshimet
</button>
      </form>
    </div>

    <div>
      <div class="card" style="margin-bottom: 24px;">
        <h3><i class="fas fa-lock"></i> Ndrysho Fjalëkalimin</h3>
        <form method="POST">
          <div class="form-group">
            <label>Fjalëkalimi Aktual</label>
            <input type="password" name="current_password" required>
          </div>
          <div class="form-group">
            <label>Fjalëkalimi i Ri</label>
            <input type="password" name="new_password" required>
          </div>
          <div class="form-group">
            <label>Konfirmo Fjalëkalimin e Ri</label>
            <input type="password" name="confirm_password" required>
          </div>
          <button type="submit" name="change_password" class="btn btn-password">
  <i class="fas fa-key"></i> Ndrysho Fjalëkalimin
</button>
        </form>
      </div>


      <div class="card" style="margin-bottom: 24px; border: 2px solid #e74c3c;">
  <h3 style="color: #c0392b;"><i class="fas fa-exclamation-triangle"></i> Fshi Llogarinë</h3>
  <p style="color: #666; font-size: 13px; margin-bottom: 16px;">
    Ky veprim është i pakthyeshëm. Të gjitha të dhënat tuaja do të fshihen përgjithmonë.
  </p>
  <form method="POST" onsubmit="return confirm('Jeni plotësisht të sigurt që doni të fshini llogarinë? Ky veprim nuk kthehet pas!')">
    <div class="form-group">
      <label>Shkruani fjalëkalimin për të konfirmuar</label>
      <input type="password" name="delete_password" placeholder="Fjalëkalimi juaj" required>
    </div>
    <button type="submit" name="delete_account" class="btn" style="background: #c0392b; color: white; width: 100%; box-shadow: 0 4px 0 #8b1a1a;">
      <i class="fas fa-trash-alt"></i> Fshi Llogarinë Përgjithmonë
    </button>
  </form>
</div>

      <div class="card">
  <h3><i class="fas fa-history"></i> Porositë e Fundit</h3>
  <?php if (count($orders) > 0): ?>
    <table class="orders-table">
      <thead>
        <tr>
          <th>#</th>
          <th>Data</th>
          <th>Totali</th>
          <th>Statusi</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($orders as $order): 
          // Përkthe statusin në shqip
          $statusShqip = [
            'pending' => '⏳ Në Pritje',
            'confirmed' => '✅ Konfirmuar',
            'shipped' => '🚚 Transportuar',
            'delivered' => '📦 Dorëzuar',
            'cancelled' => '❌ Anuluar'
          ];
          $statusi = $statusShqip[$order['status']] ?? $order['status'];
        ?>
        <tr>
          <td>#<?php echo $order['order_number']; ?></td>
          <td><?php echo date('d/m/Y', strtotime($order['created_at'])); ?></td>
          <td><?php echo number_format($order['total'], 2); ?>€</td>
          <td><span class="status-badge status-<?php echo $order['status']; ?>"><?php echo $statusi; ?></span></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php else: ?>
    <p style="color: #999; text-align: center;">Nuk keni porosi të fundit.</p>
  <?php endif; ?>
</div>
    </div>
  </div>
</main>


<footer class="footer">
  <div class="container">
    <!-- Footer Top -->
    <div class="footer-top">
      <div class="footer-column">
        <div class="logo-text" style="font-size: 32px; margin-bottom: 16px;">Express Market</div>
        <p><i class="fas fa-map-marker-alt"></i> Rruga Adem Jashari 12, Gjilan</p>
        <p><i class="fas fa-phone"></i> +383 44 522 777</p>
        <p><i class="fas fa-envelope"></i> expressmarket@gmail.com</p>
      </div>
      
      <div class="footer-column">
        <h4>Lidhje të Shpejta</h4>
        <ul class="footer-links">
          <li><a href="index.php"><i class="fas fa-chevron-right"></i> Kryefaqja</a></li>
          <li><a href="produktet.php"><i class="fas fa-chevron-right"></i> Produktet</a></li>
          <li><a href="navizitoni.php"><i class="fas fa-chevron-right"></i> Na Vizitoni</a></li>
          <li><a href="rrethnesh.php"><i class="fas fa-chevron-right"></i> Rreth Nesh</a></li>
        </ul>
      </div>
      
      <div class="footer-column">
        <h4>Informacion Ligjor</h4>
        <ul class="footer-links">
          <li><a href="termet.php"><i class="fas fa-shield-alt"></i> Termat dhe Kushtet</a></li>
          <li><a href="privacy.php"><i class="fas fa-lock"></i> Politika e Privatësisë</a></li>
          
        </ul>
      </div>
      
      <div class="footer-column">
        <h4>Na Ndiqni</h4>
        <div class="footer-social">
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-whatsapp"></i></a>
          <a href="#"><i class="fab fa-tiktok"></i></a>
        </div>
        <h4 style="margin-top: 24px;">Pagesa të Sigurta</h4>
        <div class="payment-icons">
          <i class="fab fa-cc-visa"></i>
          <i class="fab fa-cc-mastercard"></i>
          <i class="fas fa-money-bill-wave"></i>
        </div>
      </div>
    </div>
    
    <!-- Footer Bottom -->
    <div class="footer-bottom">
      <p>© 2026 Express Market — Të gjitha të drejtat e rezervuara</p>
      <div class="footer-bottom-links">
        <a href="termet.php">Termat dhe Kushtet</a>
        <span>|</span>
        <a href="privacy.php">Politika e Privatësisë</a>
        <span>|</span>
        
      </div>
    </div>
  </div>
</footer>

<script>
  (function(){
    const isLoggedIn = <?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>;
    const cartCounter = document.getElementById('cartCounter');
    
    async function updateCartCounter() {
      if (isLoggedIn) {
        try {
          const response = await fetch('cart_api.php');
          const data = await response.json();
          const totalItems = data.cart.reduce((t, i) => t + parseInt(i.quantity), 0);
          if (cartCounter) cartCounter.textContent = totalItems;
        } catch(e) {
          if (cartCounter) cartCounter.textContent = '0';
        }
      } else {
        const stored = localStorage.getItem('marketBlondiCart');
        if (stored && cartCounter) {
          try {
            const cart = JSON.parse(stored);
            const totalItems = cart.reduce((t, i) => t + i.quantity, 0);
            cartCounter.textContent = totalItems;
          } catch(e) {
            cartCounter.textContent = '0';
          }
        }
      }
    }
    
    updateCartCounter();
  })();
</script>
</body>
</html>