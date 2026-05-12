<?php
require_once 'config.php';

// Merr produktet nga MySQL
$stmt = $pdo->query("SELECT p.*, c.name as category_name 
                     FROM products p 
                     LEFT JOIN categories c ON p.category_id = c.id 
                     WHERE p.is_active = 1 
                     ORDER BY p.id DESC");
$db_products = $stmt->fetchAll();
?>


<!DOCTYPE html>
<html lang="sq">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Express Market · Të gjitha produktet</title>
  <!-- Fonts & Icons -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

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

    /* Header */
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

    /* Page Header */
    .page-header {
      padding: 30px 0 20px;
    }

    .page-header h1 {
      font-family: 'Playfair Display', serif;
      font-size: 38px;
      color: #1e3a2e;
      border-left: 12px solid #e7b42c;
      padding-left: 24px;
    }

    /* Layout me Sidebar */
    .products-layout {
      display: grid;
      grid-template-columns: 280px 1fr;
      gap: 30px;
      margin: 20px 0 40px;
    }

    /* SIDEBAR - TABELA E KATEGORIVE */
    .category-sidebar {
      background: white;
      border-radius: 24px;
      padding: 24px 0;
      box-shadow: 0 8px 24px rgba(0,0,0,0.04);
      border: 1px solid #f0e4d5;
      height: fit-content;
      position: sticky;
      top: 100px;
    }

    .category-sidebar h3 {
      font-family: 'Playfair Display', serif;
      font-size: 22px;
      padding: 0 20px 16px;
      border-bottom: 2px solid #f0e4d5;
      margin-bottom: 16px;
      color: #1e3a2e;
    }

    .category-list {
      list-style: none;
    }

    .category-item {
      padding: 12px 20px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: space-between;
      transition: all 0.2s;
      border-left: 4px solid transparent;
      color: #3d4e3f;
      font-weight: 500;
    }

    .category-item i {
      color: #e7b42c;
      width: 24px;
      margin-right: 12px;
    }

    .category-item span {
      flex: 1;
    }

    .category-count {
      background: #f0e4d5;
      padding: 2px 10px;
      border-radius: 20px;
      font-size: 13px;
      color: #1e3a2e;
    }

    .category-item:hover {
      background: #fef7ec;
      border-left-color: #e7b42c;
    }

    .category-item.active {
      background: #fef7ec;
      border-left-color: #e7b42c;
      font-weight: 700;
      color: #1e3a2e;
    }

    .category-item.active .category-count {
      background: #e7b42c;
      color: #1e3a2e;
    }

    /* Main Content */
    .products-main {
      min-width: 0;
    }

    /* Search Bar */
    .search-bar {
      display: flex;
      align-items: center;
      background: white;
      border: 1px solid #ede5d8;
      border-radius: 50px;
      padding: 4px 4px 4px 24px;
      margin-bottom: 24px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.02);
    }

    .search-bar i {
      color: #999;
    }

    .search-bar input {
      border: none;
      outline: none;
      padding: 14px 0;
      font-size: 15px;
      flex: 1;
      margin-left: 12px;
    }

    .search-bar button {
      background: #1e3a2e;
      border: none;
      color: white;
      padding: 12px 28px;
      border-radius: 50px;
      cursor: pointer;
      font-weight: 600;
      transition: 0.2s;
    }

    .search-bar button:hover {
      background: #2c543e;
    }

    /* Results Info */
    .results-info {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    .results-info p {
      color: #5f6b5e;
    }

    .clear-filter-btn {
      background: none;
      border: 1px solid #d4b58c;
      padding: 8px 16px;
      border-radius: 30px;
      cursor: pointer;
      font-size: 13px;
      color: #6b4f2c;
      transition: 0.2s;
    }

    .clear-filter-btn:hover {
      background: #f3e7da;
    }

    /* Product Grid */
    .product-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 20px;
    }

    .product-card {
      background: white;
      border-radius: 20px;
      padding: 18px 14px 18px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.04);
      border: 1px solid #ede5d8;
      transition: transform 0.2s;
    }

    .product-card:hover {
      transform: translateY(-4px);
    }

    .product-img {
      width: 100%;
      aspect-ratio: 1 / 1;
      background: #fef7ec;
      border-radius: 16px;
      margin-bottom: 14px;
      overflow: hidden;
    }

    .product-img img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .product-category {
      font-size: 11px;
      color: #e7b42c;
      text-transform: uppercase;
      letter-spacing: 1px;
      margin-bottom: 4px;
    }

    .product-title {
      font-size: 16px;
      font-weight: 700;
      margin-bottom: 4px;
    }

    .product-desc {
      color: #5f6b5e;
      font-size: 12px;
      margin-bottom: 12px;
    }

    .price {
      font-weight: 800;
      font-size: 20px;
      color: #1e3a2e;
      margin-bottom: 12px;
    }

    .price small {
      font-size: 12px;
      font-weight: 400;
      color: #7f8b7e;
    }

    .add-btn {
      background: #1e3a2e;
      border: none;
      color: white;
      padding: 10px 0;
      border-radius: 40px;
      font-weight: 600;
      font-size: 13px;
      cursor: pointer;
      width: 100%;
      box-shadow: 0 3px 0 #0f231b;
      transition: all 0.1s;
    }

    .add-btn:hover {
      background: #2c543e;
    }

    

    /* Responsive */
    @media (max-width: 1000px) {
      .products-layout {
        grid-template-columns: 240px 1fr;
      }
      .product-grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (max-width: 768px) {
      .products-layout {
        grid-template-columns: 1fr;
      }
      .category-sidebar {
        position: static;
      }
    }

    @media (max-width: 800px) {
      .header-flex {
        flex-direction: column;
        gap: 16px;
      }
    }

    @media (max-width: 480px) {
      .product-grid {
        grid-template-columns: 1fr;
      }
    }


    /* Login & Signup Buttons */
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
  border-color: #b47c1c;
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
  box-shadow: 0 6px 0 #b47c1c;
}



/* Age Verification Modal */
.age-modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.7);
  backdrop-filter: blur(6px);
  display: none;
  justify-content: center;
  align-items: center;
  z-index: 1000;
}

.age-modal-overlay.active {
  display: flex;
}

.age-modal {
  background: white;
  border-radius: 40px;
  padding: 40px;
  max-width: 480px;
  width: 90%;
  text-align: center;
  box-shadow: 0 30px 60px rgba(0,0,0,0.3);
  animation: slideUp 0.3s ease;
}

.age-modal i {
  font-size: 70px;
  color: #e7b42c;
  background: #fef7ec;
  padding: 24px;
  border-radius: 30px;
  margin-bottom: 24px;
}

.age-modal h2 {
  font-family: 'Playfair Display', serif;
  font-size: 32px;
  color: #1e3a2e;
  margin-bottom: 16px;
}

.age-modal p {
  color: #5f6b5e;
  margin-bottom: 32px;
  font-size: 16px;
}

.age-modal-buttons {
  display: flex;
  gap: 16px;
  justify-content: center;
}

.age-btn {
  padding: 14px 32px;
  border-radius: 40px;
  font-weight: 700;
  font-size: 16px;
  cursor: pointer;
  transition: all 0.15s;
  border: none;
}

.age-btn-yes {
  background: #1e3a2e;
  color: white;
  box-shadow: 0 4px 0 #0f231b;
}

.age-btn-yes:hover {
  background: #2c543e;
  transform: translateY(-2px);
}

.age-btn-no {
  background: transparent;
  color: #1e3a2e;
  border: 2px solid #e7b42c;
}

.age-btn-no:hover {
  background: #fef7ec;
}

/* Alkool warning në sidebar */
.alkool-warning {
  display: flex;
  align-items: center;
  gap: 8px;
  padding: 12px 20px;
  margin: 16px 20px 0;
  background: #fff3e0;
  border-radius: 16px;
  color: #b45f06;
  font-size: 12px;
  border-left: 4px solid #e7b42c;
}

.alkool-warning i {
  font-size: 16px;
  color: #e7b42c;
}


@media (max-width: 480px) {
  .age-modal {
    padding: 30px 20px;
  }
  
  .age-modal-buttons {
    flex-direction: column;
  }
  
  .age-btn {
    width: 100%;
  }
}

/* Footer i Përditësuar */
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
  transition: color 0.2s;
  display: flex;
  align-items: center;
}

.footer-links a i {
  font-size: 12px;
  margin-right: 10px;
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
  transition: all 0.2s;
}

.footer-social a:hover {
  background: #e7b42c;
  color: #1e2b24;
  transform: translateY(-3px);
}

.payment-icons {
  display: flex;
  gap: 12px;
  font-size: 28px;
  color: #b8c4b8;
}

.payment-icons i {
  transition: color 0.2s;
}

.payment-icons i:hover {
  color: #e7b42c;
}

.footer-bottom {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding-top: 30px;
  border-top: 1px solid #3a4a3e;
  font-size: 14px;
  color: #9aab9a;
  flex-wrap: wrap;
  gap: 16px;
}

.footer-bottom-links {
  display: flex;
  gap: 16px;
  align-items: center;
}

.footer-bottom-links a {
  color: #9aab9a;
  text-decoration: none;
  transition: color 0.2s;
}

.footer-bottom-links a:hover {
  color: #e7b42c;
}

.footer-bottom-links span {
  color: #4a5a4e;
}

/* Responsive Footer */
@media (max-width: 1000px) {
  .footer-top {
    grid-template-columns: repeat(2, 1fr);
    gap: 30px;
  }
}

@media (max-width: 600px) {
  .footer-top {
    grid-template-columns: 1fr;
  }
  
  .footer-bottom {
    flex-direction: column;
    text-align: center;
  }
  
  .footer-bottom-links {
    justify-content: center;
  }
}

.footer .logo-text {
      color: #e7b42c;
      font-size: 26px;
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
    font-size: 26px;
    border-left: 8px solid #e7b42c;
    padding-left: 12px;
  }
  
  .products-layout {
    grid-template-columns: 1fr;
    gap: 16px;
    margin: 15px 0 30px;
  }
  
  .category-sidebar {
    position: static;
    border-radius: 16px;
    padding: 16px 0;
  }
  
  .category-sidebar h3 {
    font-size: 18px;
    padding: 0 14px 12px;
    margin-bottom: 10px;
  }
  
  .category-item {
    padding: 10px 14px;
    font-size: 14px;
  }
  
  .category-count {
    padding: 2px 8px;
    font-size: 11px;
  }
  
  .alkool-warning {
    padding: 10px 14px;
    margin: 10px 14px 0;
    font-size: 11px;
  }
  
  .search-bar {
    padding: 3px 3px 3px 14px;
    margin-bottom: 16px;
  }
  
  .search-bar input {
    padding: 10px 0;
    font-size: 13px;
    margin-left: 8px;
  }
  
  .search-bar button {
    padding: 10px 16px;
    font-size: 13px;
  }
  
  .results-info {
    flex-direction: column;
    gap: 10px;
    align-items: flex-start;
    margin-bottom: 14px;
  }
  
  .results-info p {
    font-size: 13px;
  }
  
  .clear-filter-btn {
    padding: 6px 12px;
    font-size: 11px;
    width: 100%;
    text-align: center;
  }
  
  .product-grid {
    grid-template-columns: 1fr;
    gap: 12px;
  }
  
  .product-card {
    padding: 14px 10px 14px;
    border-radius: 16px;
  }
  
  .product-img {
    border-radius: 12px;
    margin-bottom: 10px;
  }
  
  .product-category {
    font-size: 9px;
  }
  
  .product-title {
    font-size: 14px;
  }
  
  .product-desc {
    font-size: 11px;
    margin-bottom: 8px;
  }
  
  .price {
    font-size: 17px;
    margin-bottom: 8px;
  }
  
  .price small {
    font-size: 10px;
  }
  
  .add-btn {
    padding: 8px 0;
    font-size: 11px;
    box-shadow: 0 2px 0 #0f231b;
  }
  
  .age-modal {
    padding: 25px 18px;
    border-radius: 28px;
  }
  
  .age-modal i {
    font-size: 50px;
    padding: 16px;
    border-radius: 20px;
    margin-bottom: 16px;
  }
  
  .age-modal h2 {
    font-size: 24px;
  }
  
  .age-modal p {
    font-size: 14px;
    margin-bottom: 24px;
  }
  
  .age-btn {
    padding: 12px 20px;
    font-size: 14px;
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
    font-size: 30px;
    border-left: 10px solid #e7b42c;
    padding-left: 16px;
  }
  
  .products-layout {
    grid-template-columns: 1fr;
    gap: 20px;
    margin: 18px 0 35px;
  }
  
  .category-sidebar {
    position: static;
    border-radius: 20px;
    padding: 20px 0;
  }
  
  .category-sidebar h3 {
    font-size: 20px;
    padding: 0 16px 14px;
  }
  
  .category-item {
    padding: 11px 16px;
    font-size: 15px;
  }
  
  .alkool-warning {
    padding: 10px 16px;
    margin: 12px 16px 0;
  }
  
  .search-bar {
    padding: 3px 3px 3px 16px;
    margin-bottom: 18px;
  }
  
  .search-bar input {
    padding: 12px 0;
    font-size: 14px;
    margin-left: 10px;
  }
  
  .search-bar button {
    padding: 11px 22px;
    font-size: 14px;
  }
  
  .results-info {
    margin-bottom: 16px;
  }
  
  .product-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 14px;
  }
  
  .product-card {
    padding: 14px 10px 14px;
    border-radius: 16px;
  }
  
  .product-img {
    border-radius: 12px;
    margin-bottom: 10px;
  }
  
  .product-title {
    font-size: 14px;
  }
  
  .product-desc {
    font-size: 11px;
    margin-bottom: 8px;
  }
  
  .price {
    font-size: 17px;
    margin-bottom: 8px;
  }
  
  .price small {
    font-size: 10px;
  }
  
  .add-btn {
    padding: 8px 0;
    font-size: 12px;
  }
  
  .age-modal {
    padding: 30px 22px;
  }
  
  .age-modal i {
    font-size: 55px;
    padding: 18px;
  }
  
  .age-modal h2 {
    font-size: 26px;
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
  
  .products-layout {
    grid-template-columns: 1fr;
    gap: 22px;
  }
  
  .category-sidebar {
    position: static;
  }
  
  .product-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
  }
  
  .product-card {
    padding: 16px 12px 16px;
    border-radius: 18px;
  }
  
  .product-title {
    font-size: 15px;
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
  
  .products-layout {
    grid-template-columns: 1fr;
  }
  
  .category-sidebar {
    position: static;
    margin-bottom: 10px;
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
  .products-layout {
    grid-template-columns: 220px 1fr;
    gap: 20px;
  }
  
  .product-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
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
  
  .products-layout {
    grid-template-columns: 250px 1fr;
    gap: 24px;
  }
  
  .product-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 18px;
  }
  
  .footer-top {
    grid-template-columns: repeat(3, 1fr);
  }
}

/* Orientimi peizazh në telefon */
@media (max-height: 500px) and (orientation: landscape) {
  .products-layout {
    grid-template-columns: 200px 1fr;
    gap: 14px;
  }
  
  .category-sidebar {
    max-height: 80vh;
    overflow-y: auto;
  }
  
  .category-item {
    padding: 8px 14px;
    font-size: 13px;
  }
  
  .product-grid {
    grid-template-columns: repeat(3, 1fr);
    gap: 10px;
  }
  
  .product-card {
    padding: 12px 8px 12px;
  }
  
  .product-title {
    font-size: 13px;
  }
  
  .price {
    font-size: 15px;
    margin-bottom: 6px;
  }
  
  .add-btn {
    padding: 6px 0;
    font-size: 11px;
    margin-top: 4px;
  }
}

/* Për sidebar-in sticky në desktop */
@media (min-width: 769px) {
  .category-sidebar {
    position: sticky;
    top: 100px;
    max-height: calc(100vh - 120px);
    overflow-y: auto;
  }
}

/* Retina dhe ekrane me densitet të lartë */
@media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
  .logo-img, .product-img img {
    image-rendering: -webkit-optimize-contrast;
    image-rendering: crisp-edges;
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
      <a href="produktet.php" style="color: #e7b42c; font-weight: 700;"><i class="fas fa-box"></i> Produktet</a>
      <a href="navizitoni.php"><i class="fas fa-map-pin"></i> Na Vizitoni</a>
      <a href="rrethnesh.php"><i class="fas fa-info-circle"></i> Rreth Nesh</a>
    </nav>

    <!-- Cart & Auth -->
<div class="header-actions">
  <?php if (isset($_SESSION['user_id'])): ?>
    <a href="profile.php" class="login-btn">
      <i class="fas fa-user"></i> <?php echo $_SESSION['user_name']; ?>
    </a>
    <?php if ($_SESSION['user_role'] === 'admin'): ?>
      <a href="admin.php" class="signup-btn">
        <i class="fas fa-cog"></i> Admin
      </a>
    <?php endif; ?>
    <a href="logout.php" class="cart-btn">
      <i class="fas fa-sign-out-alt"></i> Dil
    </a>
  <?php else: ?>
    <a href="login.php" class="login-btn">
      <i class="fas fa-sign-in-alt"></i> Hyr
    </a>
    <a href="signup.php" class="signup-btn">
      <i class="fas fa-user-plus"></i> Regjistrohu
    </a>
  <?php endif; ?>
  <a href="shporta.php" class="cart-btn">
    <i class="fas fa-shopping-basket"></i> Shporta
    <span class="cart-count" id="cartCounter">0</span>
  </a>
</div>
</div>  
</header> 

<main class="container">
  <div class="page-header">
    <h1><i class="fas fa-box-open" style="color: #e7b42c; margin-right: 12px;"></i> Të gjitha produktet</h1>
  </div>

  <div class="products-layout">
    <!-- SIDEBAR ME TABELËN E KATEGORIVE -->
    <aside class="category-sidebar">
      <h3><i class="fas fa-list"></i> Kategoritë</h3>
      <ul class="category-list" id="categoryList"></ul>
    </aside>

    <!-- MAIN CONTENT -->
    <div class="products-main">
      <div class="search-bar">
        <i class="fas fa-search"></i>
        <input type="text" id="searchInput" placeholder="Kërko produktin...">
        <button id="searchBtn">Kërko</button>
      </div>

      <div class="results-info">
        <p id="resultsCount">Duke shfaqur të gjitha produktet</p>
        <button class="clear-filter-btn" id="clearFilterBtn"><i class="fas fa-times"></i> Pastro filtrat</button>
      </div>

      <div class="product-grid" id="productGrid"></div>
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


<!-- Age Verification Modal -->
<div class="age-modal-overlay" id="ageModal">
  <div class="age-modal">
    <i class="fas fa-wine-bottle"></i>
    <h2>Verifikimi i Moshës</h2>
    <p>Kjo kategori përmban produkte alkoolike. Ju lutemi konfirmoni që jeni mbi 18 vjeç për të vazhduar.</p>
    <div class="age-modal-buttons">
      <button class="age-btn age-btn-yes" onclick="confirmAge()">Jam mbi 18 vjeç</button>
      <button class="age-btn age-btn-no" onclick="denyAge()">Jam nën 18 vjeç</button>
    </div>
  </div>
</div>



<script>
  (function(){
    "use strict";

    const CATEGORIES = [
      "Pemë dhe Perime",
      "Bulmet & Vezë",
      "Bukë & Pjekurina",
      "Ushqime të konzervuara",
      "Produkte Bazë",
      "Të njelmëta",
      "Të ëmbla",
      "Pijet",
      "Kafe, Qaj & Kakao",
      "Alkool"
    ];

    // ✅ SHTO KËTË - Merr produktet nga PHP (MySQL)
const products = <?php echo json_encode($db_products); ?>.map(p => ({
  id: p.id,
  name: p.name,
  category: p.category_name || '',
  desc: p.description || '',
  price: parseFloat(p.price),
  image: p.image || '',
  emoji: '📦'
}));

   

    const FALLBACK_IMAGE = 'data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'200\' height=\'200\' viewBox=\'0 0 200 200\'%3E%3Crect width=\'200\' height=\'200\' fill=\'%23fef7ec\'/%3E%3Ctext x=\'50%25\' y=\'50%25\' dominant-baseline=\'middle\' text-anchor=\'middle\' font-size=\'40\' fill=\'%23d4b58c\'%3E📦%3C/text%3E%3C/svg%3E';

    let cart = [];
    let currentFilter = 'all';
    let searchTerm = '';
    let pendingFilter = null;

    const productGrid = document.getElementById('productGrid');
    const cartCounter = document.getElementById('cartCounter');
    const resultsCount = document.getElementById('resultsCount');
    const categoryList = document.getElementById('categoryList');

    function saveCart() {
      localStorage.setItem('marketBlondiCart', JSON.stringify(cart));
    }

    function loadCart() {
      const stored = localStorage.getItem('marketBlondiCart');
      if (stored) {
        try { cart = JSON.parse(stored); } catch(e) { cart = []; }
      }
      updateCartCounter();
    }

    async function updateCartCounter() {
  const isLoggedIn = <?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>;
  
  if (isLoggedIn) {
    // Merr numrin nga serveri
    try {
      const response = await fetch('cart_api.php');
      const data = await response.json();
      const totalItems = data.cart.reduce((t, i) => t + parseInt(i.quantity), 0);
      if (cartCounter) cartCounter.textContent = totalItems;
    } catch(e) {
      if (cartCounter) cartCounter.textContent = '0';
    }
  } else {
    const totalItems = cart.reduce((t, i) => t + i.quantity, 0);
    if (cartCounter) cartCounter.textContent = totalItems;
  }
}


function fixImagePath(image) {
  if (!image) return '';
  
  // Nese tashme ka images/ ne fillim, ktheje siç eshte
  if (image.indexOf('images/') === 0) return image;
  
  // Nese ka 'images' pa / (si images17785...), shto /
  if (image.indexOf('images') === 0) return 'images/' + image.substring(6);
  
  // Perndryshe (si domate.jpg), shto images/ ne fillim
  return 'images/' + image;
}

    function renderSidebar() {
      let html = `
        <li class="category-item ${currentFilter === 'all' ? 'active' : ''}" data-filter="all">
          <i class="fas fa-border-all"></i>
          <span>Të gjitha produktet</span>
          <span class="category-count">${products.length}</span>
        </li>
      `;
      
      CATEGORIES.forEach(cat => {
        const count = products.filter(p => p.category === cat).length;
        const isAlkool = cat === 'Alkool';
        html += `
          <li class="category-item ${currentFilter === cat ? 'active' : ''}" data-filter="${cat}">
            <i class="fas fa-tag"></i>
            <span>${cat}</span>
            <span class="category-count">${count}</span>
          </li>
          ${isAlkool ? `
            <div class="alkool-warning">
              <i class="fas fa-exclamation-triangle"></i>
              <span>+18 - Kërkohet verifikim moshe</span>
            </div>
          ` : ''}
        `;
      });
      
      categoryList.innerHTML = html;
      
      document.querySelectorAll('.category-item').forEach(item => {
        item.addEventListener('click', () => {
          const filter = item.dataset.filter;
          
          if (filter === 'Alkool') {
            const ageVerified = sessionStorage.getItem('ageVerified');
            if (!ageVerified) {
              showAgeModal(filter);
              return;
            }
          }
          
          currentFilter = filter;
          renderSidebar();
          renderProducts();
        });
      });
    }

    function filterProducts() {
      return products.filter(p => {
        const matchesCategory = currentFilter === 'all' || p.category === currentFilter;
        const matchesSearch = p.name.toLowerCase().includes(searchTerm.toLowerCase()) ||
                             p.desc.toLowerCase().includes(searchTerm.toLowerCase());
        return matchesCategory && matchesSearch;
      });
    }

    function renderProducts() {
  const filtered = filterProducts();
  
  resultsCount.textContent = `Duke shfaqur ${filtered.length} produkt${filtered.length === 1 ? '' : 'e'}`;
  
  if (filtered.length === 0) {
    productGrid.innerHTML = `
      <div class="no-results">
        <i class="fas fa-search" style="font-size: 48px; color: #d4b58c;"></i>
        <h3>Nuk u gjet asnjë produkt</h3>
        <p>Provoni një kërkim ose kategori tjetër</p>
      </div>
    `;
    return;
  }

  let html = '';
  filtered.forEach(p => {
    html += `
      <div class="product-card">
        <div class="product-img">
          <img src="${fixImagePath(p.image)}" alt="${p.name}" onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22200%22 height=%22200%22%3E%3Crect fill=%22%23fef7ec%22 width=%22200%22 height=%22200%22/%3E%3Ctext x=%2250%25%22 y=%2250%25%22 dominant-baseline=%22middle%22 text-anchor=%22middle%22 font-size=%2240%22 fill=%22%23d4b58c%22%3E📦%3C/text%3E%3C/svg%3E'">
        </div>
        <div class="product-category">${p.category}</div>
        <div class="product-title">${p.name}</div>
        <div class="product-desc">${p.desc}</div>
        <div class="price">${p.price.toFixed(2)}€<small> / copë</small></div>
        <button class="add-btn" data-id="${p.id}" data-name="${p.name}" data-price="${p.price}" data-image="${p.image}" data-emoji="${p.emoji}">
          <i class="fas fa-cart-plus"></i> Shto në shportë
        </button>
      </div>
    `;
  });
  productGrid.innerHTML = html;

  document.querySelectorAll('.add-btn').forEach(btn => {
    btn.addEventListener('click', (e) => {
      const id = Number(btn.dataset.id);
      const name = btn.dataset.name;
      const price = parseFloat(btn.dataset.price);
      const image = btn.dataset.image;      // ✅ Shto këtë
      const emoji = btn.dataset.emoji;
      addToCart(id, name, price, image, emoji);  // ✅ Kalo image
      
      const button = e.target.closest('.add-btn');
      button.style.background = '#e7b42c';
      button.innerHTML = '<i class="fas fa-check"></i> U shtua!';
      setTimeout(() => {
        button.style.background = '#1e3a2e';
        button.innerHTML = '<i class="fas fa-cart-plus"></i> Shto në shportë';
      }, 1000);
    });
  });
}

async function addToCart(id, name, price, image, emoji) {
  const isLoggedIn = <?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>;
  
  if (isLoggedIn) {
    await fetch('cart_api.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ product_id: id, quantity: 1 })
    });
  } else {
    const existing = cart.find(item => item.id === id);
    if (existing) {
      existing.quantity += 1;
    } else {
      cart.push({ id, name, price, quantity: 1, image, emoji });
    }
    saveCart();
  }
  updateCartCounter();
}

    // ========== AGE VERIFICATION ==========
    function showAgeModal(filter) {
      pendingFilter = filter;
      document.getElementById('ageModal').classList.add('active');
    }

    window.confirmAge = function() {
      sessionStorage.setItem('ageVerified', 'true');
      document.getElementById('ageModal').classList.remove('active');
      
      if (pendingFilter) {
        currentFilter = pendingFilter;
        renderSidebar();
        renderProducts();
        pendingFilter = null;
      }
    };

    window.denyAge = function() {
      document.getElementById('ageModal').classList.remove('active');
      pendingFilter = null;
      
      currentFilter = 'all';
      renderSidebar();
      renderProducts();
      
      alert('❌ Na vjen keq, produktet alkoolike janë vetëm për persona mbi 18 vjeç.');
    };

    // Event listeners
    document.getElementById('searchBtn').addEventListener('click', () => {
      searchTerm = document.getElementById('searchInput').value.trim();
      renderProducts();
    });
    
    document.getElementById('searchInput').addEventListener('keyup', (e) => {
      if (e.key === 'Enter') {
        searchTerm = e.target.value.trim();
        renderProducts();
      }
    });

    document.getElementById('clearFilterBtn').addEventListener('click', () => {
      currentFilter = 'all';
      searchTerm = '';
      document.getElementById('searchInput').value = '';
      sessionStorage.removeItem('ageVerified');
      renderSidebar();
      renderProducts();
    });

    document.getElementById('ageModal').addEventListener('click', (e) => {
      if (e.target.classList.contains('age-modal-overlay')) {
        window.denyAge();
      }
    });

    document.querySelector('.cart-btn')?.addEventListener('click', (e) => {
      window.location.href = 'shporta.php';
    });

    // Inicializo
    loadCart();
    renderSidebar();
    renderProducts();
  })();
</script>
</body>
</html>