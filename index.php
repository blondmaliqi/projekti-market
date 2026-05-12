<?php
require_once 'config.php';

// Merr disa produkte për faqen kryesore
$stmt = $pdo->query("SELECT p.*, c.name as category_name 
                     FROM products p 
                     LEFT JOIN categories c ON p.category_id = c.id 
                     WHERE p.is_active = 1 
                     ORDER BY p.id DESC 
                     LIMIT 6");
$db_products = $stmt->fetchAll();
?>




<!DOCTYPE html>
<html lang="sq">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Express Market - Freski në çdo hap</title>
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
    }

    .logo-icon {
      background: #e7b42c;
      width: 48px;
      height: 48px;
      border-radius: 16px 4px 16px 4px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 6px 0 #b47c1c;
    }

    .logo-icon i {
      font-size: 28px;
      color: #1e3a2e;
    }

    .logo-text {
      font-family: 'Playfair Display', serif;
      font-size: 28px;
      font-weight: 700;
      color: #1e3a2e;
    }

    .logo-tagline {
      font-size: 12px;
      font-weight: 400;
      color: #6b4f2c;
      margin-top: -6px;
      letter-spacing: 2px;
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

    /* Hero */
    .hero {
      padding: 48px 0 32px;
      display: grid;
      grid-template-columns: 1.1fr 1fr;
      gap: 30px;
      align-items: center;
    }

    .hero h1 {
      font-family: 'Playfair Display', serif;
      font-size: 52px;
      line-height: 1.2;
      color: #1e3a2e;
      margin-bottom: 20px;
    }

    .highlight {
      background: #faeecb;
      display: inline-block;
      padding: 0 12px;
      border-radius: 40px;
      color: #8b5e2c;
    }

    .hero p {
      font-size: 18px;
      color: #3d4e3f;
      margin-bottom: 28px;
    }

   .hero-image {
  background: transparent;
  border-radius: 0;
  padding: 0;
  box-shadow: none;
}

    .hero-image i {
  display: none;
}

    .btn-primary {
      background: #e7b42c;
      border: none;
      padding: 16px 36px;
      border-radius: 60px;
      font-weight: 700;
      font-size: 18px;
      color: #1e3a2e;
      box-shadow: 0 8px 0 #b47c1c;
      cursor: pointer;
      transition: 0.1s;
    }

    .btn-primary:hover {
      transform: translateY(-3px);
      box-shadow: 0 11px 0 #b47c1c;
    }

    /* Categories */
    .section-title {
      font-family: 'Playfair Display', serif;
      font-size: 34px;
      margin: 48px 0 24px;
      color: #1e3a2e;
      border-left: 12px solid #e7b42c;
      padding-left: 24px;
    }

    .category-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 24px;
    }

    .cat-card {
      background: white;
      padding: 24px 12px;
      border-radius: 32px;
      text-align: center;
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.03);
      border: 1px solid #f3ede5;
      transition: all 0.25s;
    }

    .cat-card:hover {
      border-color: #e7b42c;
      transform: scale(1.02);
    }

    .cat-card i {
      font-size: 44px;
      background: #fcf3e0;
      padding: 18px;
      border-radius: 30px;
      color: #1e3a2e;
      margin-bottom: 16px;
    }

    .cat-card h3 {
      font-weight: 700;
      margin-bottom: 8px;
    }

    /* Products */
    .product-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 30px;
      margin: 30px 0 40px;
    }

    .product-card {
      background: white;
      border-radius: 28px;
      padding: 24px 20px 20px;
      box-shadow: 0 12px 28px -8px rgba(0,0,0,0.06);
      border: 1px solid #ede5d8;
    }

    .product-img {
  width: 100%;
  aspect-ratio: 1 / 1;
  background: #fef7ec;
  border-radius: 40px;
  margin-bottom: 18px;
  overflow: hidden;
  display: flex;
  align-items: center;
  justify-content: center;
}

.product-img img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

    .product-title {
      font-size: 22px;
      font-weight: 700;
    }

    .product-desc {
      color: #5f6b5e;
      margin: 10px 0 16px;
      font-size: 14px;
    }

    .price {
      font-weight: 800;
      font-size: 26px;
      color: #1e3a2e;
    }

    .price small {
      font-size: 14px;
      font-weight: 400;
      color: #7f8b7e;
    }

    .add-btn {
      background: #1e3a2e;
      border: none;
      color: white;
      padding: 14px 0;
      border-radius: 40px;
      font-weight: 600;
      font-size: 16px;
      margin-top: 16px;
      cursor: pointer;
      width: 100%;
      box-shadow: 0 4px 0 #0f231b;
    }

    .add-btn:hover {
      background: #2c543e;
    }

    /* Cart Panel */
    .cart-panel {
      background: white;
      border-radius: 36px;
      padding: 28px 24px;
      margin: 32px 0 48px;
      box-shadow: 0 20px 40px rgba(0,0,0,0.04);
      border: 1px solid #f0e4d5;
    }

    .cart-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      border-bottom: 2px dashed #dcc9b2;
      padding-bottom: 16px;
      margin-bottom: 20px;
    }

    .cart-header h2 {
      font-family: 'Playfair Display', serif;
      font-size: 28px;
    }

    .clear-cart {
      background: none;
      border: 1px solid #d4b58c;
      padding: 8px 18px;
      border-radius: 30px;
      cursor: pointer;
      font-weight: 500;
    }

    .clear-cart:hover {
      background: #f3e7da;
    }

    .cart-items {
      list-style: none;
      margin-bottom: 20px;
      max-height: 400px;
      overflow-y: auto;
    }

    .cart-item {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 14px 8px;
      border-bottom: 1px solid #efe2d4;
    }

    .cart-item-info {
      display: flex;
      align-items: center;
      gap: 16px;
    }

    .cart-item-info i {
      font-size: 26px;
      color: #e7b42c;
    }

    .item-controls {
      display: flex;
      align-items: center;
      gap: 14px;
    }

    .item-controls button {
      background: #f1ebe4;
      border: none;
      width: 34px;
      height: 34px;
      border-radius: 12px;
      font-weight: bold;
      font-size: 20px;
      cursor: pointer;
    }

    .cart-total {
      text-align: right;
      font-size: 24px;
      font-weight: 700;
      padding-top: 12px;
    }

    .checkout-btn {
      background: #e7b42c;
      border: none;
      padding: 16px 28px;
      border-radius: 60px;
      font-weight: 700;
      font-size: 18px;
      margin-top: 16px;
      width: 100%;
      cursor: pointer;
      box-shadow: 0 6px 0 #b47c1c;
    }

    /* Checkout Modal */
    .modal-overlay {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(0, 0, 0, 0.5);
      backdrop-filter: blur(4px);
      display: none;
      justify-content: center;
      align-items: center;
      z-index: 1000;
      animation: fadeIn 0.2s ease;
    }

    .modal-overlay.active {
      display: flex;
    }

    .checkout-modal {
      background: white;
      border-radius: 48px;
      padding: 40px;
      max-width: 600px;
      width: 90%;
      max-height: 90vh;
      overflow-y: auto;
      box-shadow: 0 30px 60px rgba(0,0,0,0.2);
      animation: slideUp 0.3s ease;
    }

    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    @keyframes slideUp {
      from { transform: translateY(30px); opacity: 0; }
      to { transform: translateY(0); opacity: 1; }
    }

    .modal-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 30px;
    }

    .modal-header h2 {
      font-family: 'Playfair Display', serif;
      font-size: 32px;
      color: #1e3a2e;
    }

    .close-modal {
      background: none;
      border: none;
      font-size: 28px;
      cursor: pointer;
      color: #999;
      width: 40px;
      height: 40px;
      border-radius: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .close-modal:hover {
      background: #f0f0f0;
    }

    /* Checkout Steps */
    .checkout-steps {
      display: flex;
      justify-content: space-between;
      margin-bottom: 30px;
    }

    .step {
      text-align: center;
      flex: 1;
      position: relative;
    }

    .step-number {
      width: 40px;
      height: 40px;
      background: #f0e4d5;
      border-radius: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 10px;
      font-weight: 700;
      color: #666;
    }

    .step.active .step-number {
      background: #e7b42c;
      color: #1e3a2e;
    }

    .step.completed .step-number {
      background: #1e3a2e;
      color: white;
    }

    .step-label {
      font-size: 14px;
      font-weight: 500;
    }

    /* Checkout Form */
    .checkout-form {
      margin-top: 30px;
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

    .form-group input {
      width: 100%;
      padding: 14px 18px;
      border: 2px solid #ede5d8;
      border-radius: 20px;
      font-size: 16px;
      font-family: 'Inter', sans-serif;
    }

    .form-group input:focus {
      outline: none;
      border-color: #e7b42c;
    }

    .form-row {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 15px;
    }

    .order-summary {
      background: #fef7ec;
      border-radius: 24px;
      padding: 24px;
      margin: 30px 0;
    }

    .order-summary h3 {
      margin-bottom: 20px;
      color: #1e3a2e;
    }

    .summary-item {
      display: flex;
      justify-content: space-between;
      margin-bottom: 12px;
    }

    .summary-total {
      display: flex;
      justify-content: space-between;
      margin-top: 20px;
      padding-top: 20px;
      border-top: 2px dashed #dcc9b2;
      font-weight: 700;
      font-size: 20px;
    }

    .place-order-btn {
      background: #e7b42c;
      border: none;
      padding: 18px;
      border-radius: 40px;
      font-weight: 700;
      font-size: 18px;
      color: #1e3a2e;
      width: 100%;
      cursor: pointer;
      box-shadow: 0 6px 0 #b47c1c;
      margin-top: 20px;
    }

    .place-order-btn:disabled {
      opacity: 0.5;
      cursor: not-allowed;
      transform: none;
    }

    /* Success Message */
    .success-message {
      text-align: center;
      padding: 40px 20px;
    }

    .success-message i {
      font-size: 80px;
      color: #1e3a2e;
      background: #e7b42c;
      padding: 30px;
      border-radius: 60px;
      margin-bottom: 24px;
    }

    .success-message h3 {
      font-family: 'Playfair Display', serif;
      font-size: 32px;
      margin-bottom: 16px;
      color: #1e3a2e;
    }

    .success-message p {
      color: #666;
      margin-bottom: 24px;
    }

    .order-number {
      background: #fef7ec;
      padding: 16px;
      border-radius: 20px;
      font-size: 24px;
      font-weight: 700;
      color: #e7b42c;
      margin: 20px 0;
    }




    @media (max-width: 800px) {
      .hero { grid-template-columns: 1fr; }
      .category-grid { grid-template-columns: repeat(2,1fr); }
      .product-grid { grid-template-columns: 1fr; }
      .header-flex { flex-direction: column; gap: 16px; }
      .form-row { grid-template-columns: 1fr; }
    }


    .logo-img {
  height: 100px;
  width: auto;
  max-width: 200px;
  object-fit: contain;
}


.logo-area {
  text-decoration: none;
  color: inherit;
  transition: 0.2s;
}

.logo-area:hover {
  transform: scale(1.03);
}

.hero-img {
  width: 100%;
  max-width: 430px;
  height: auto;
  border-radius: 0;
  object-fit: contain;
}


.hero-image {
  display: flex;
  justify-content: flex-end;
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
  
  .hero {
    padding: 24px 0 20px;
  }
  
  .hero h1 {
    font-size: 28px;
  }
  
  .hero p {
    font-size: 14px;
    margin-bottom: 20px;
  }
  
  .btn-primary {
    padding: 12px 24px;
    font-size: 14px;
  }
  
  .hero-img {
    max-width: 100%;
  }
  
  .section-title {
    font-size: 22px;
    margin: 30px 0 16px;
    border-left: 8px solid #e7b42c;
    padding-left: 12px;
  }
  
  .category-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 10px;
  }
  
  .cat-card {
    padding: 16px 8px;
    border-radius: 20px;
  }
  
  .cat-card i {
    font-size: 28px;
    padding: 12px;
    border-radius: 16px;
    margin-bottom: 10px;
  }
  
  .cat-card h3 {
    font-size: 14px;
  }
  
  .cat-card p {
    font-size: 11px;
  }
  
  .product-grid {
    grid-template-columns: 1fr;
    gap: 16px;
    margin: 20px 0 30px;
  }
  
  .product-card {
    padding: 16px 12px 16px;
    border-radius: 20px;
  }
  
  .product-title {
    font-size: 18px;
  }
  
  .product-desc {
    font-size: 12px;
    margin: 6px 0 10px;
  }
  
  .price {
    font-size: 20px;
  }
  
  .add-btn {
    padding: 10px 0;
    font-size: 13px;
    margin-top: 10px;
  }
  
  .footer {
    padding: 30px 0 15px;
    border-radius: 30px 30px 0 0;
  }
  
  .footer-top {
    grid-template-columns: 1fr;
    gap: 20px;
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
  
  .hero {
    padding: 30px 0 24px;
  }
  
  .hero h1 {
    font-size: 32px;
  }
  
  .hero p {
    font-size: 15px;
    margin-bottom: 22px;
  }
  
  .btn-primary {
    padding: 14px 28px;
    font-size: 15px;
  }
  
  .hero-img {
    max-width: 100%;
  }
  
  .section-title {
    font-size: 26px;
    margin: 35px 0 18px;
  }
  
  .category-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 14px;
  }
  
  .cat-card {
    padding: 18px 10px;
    border-radius: 24px;
  }
  
  .cat-card i {
    font-size: 34px;
    padding: 14px;
    border-radius: 20px;
    margin-bottom: 12px;
  }
  
  .cat-card h3 {
    font-size: 16px;
  }
  
  .product-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
    margin: 24px 0 32px;
  }
  
  .product-card {
    padding: 16px 12px 16px;
    border-radius: 20px;
  }
  
  .product-title {
    font-size: 16px;
  }
  
  .product-desc {
    font-size: 12px;
    margin: 6px 0 10px;
  }
  
  .price {
    font-size: 18px;
  }
  
  .price small {
    font-size: 11px;
  }
  
  .add-btn {
    padding: 10px 0;
    font-size: 13px;
    margin-top: 8px;
  }
  
  .footer {
    padding: 35px 0 15px;
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
  
  .hero h1 {
    font-size: 36px;
  }
  
  .hero p {
    font-size: 16px;
  }
  
  .hero-img {
    max-width: 90%;
  }
  
  .category-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
  }
  
  .product-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
  }
  
  .footer-top {
    grid-template-columns: repeat(2, 1fr);
    gap: 24px;
  }
}

/* Të gjithë telefonat - navigim hamburger menu */
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
  
  .hero {
    grid-template-columns: 1fr;
    gap: 20px;
    text-align: center;
  }
  
  .hero-image {
    justify-content: center;
    order: -1;
  }
  
  .hero-img {
    max-width: 60%;
    margin: 0 auto;
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
  .category-grid {
    grid-template-columns: repeat(3, 1fr);
  }
  
  .product-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
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
  
  .product-grid {
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
  }
  
  .footer-top {
    grid-template-columns: repeat(3, 1fr);
  }
}

/* Orientimi peizazh në telefon */
@media (max-height: 500px) and (orientation: landscape) {
  .hero {
    padding: 20px 0;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
  }
  
  .hero h1 {
    font-size: 24px;
  }
  
  .hero p {
    font-size: 13px;
    margin-bottom: 16px;
  }
  
  .hero-img {
    max-width: 70%;
  }
  
  .hero-image {
    display: none;
  }
}

/* Retina dhe ekrane me densitet të lartë */
@media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
  .logo-img, .hero-img, .product-img img {
    image-rendering: -webkit-optimize-contrast;
    image-rendering: crisp-edges;
  }
}
    

  </style>
</head>
<body>

<header class="site-header">
  <div class="container header-flex">

    <!-- Logo -->
    <a href="index.php" class="logo-area">  
  <img src="expressmarketlogo.png" alt="Express Market" class="logo-img">
</a>

    <!-- Navigation -->
    <nav class="nav-links">
      <a href="index.php" style="color: #e7b42c; font-weight: 700;"><i class="fas fa-home"></i> Kryefaqja</a>
      <a href="produktet.php"><i class="fas fa-box"></i> Produktet</a>
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
  <section class="hero">
    <div>
      <h1>Express <span class="highlight">Market</span><br>ku freskia takon shijen</h1>
      <p><i class="fas fa-carrot" style="color:#e07c2c; margin-right: 8px;"></i> Zbuloni produkte të përzgjedhura dhe gjithçka që ju nevojitet për përditshmërinë tuaj – Freski në çdo hap.</p>
      <button class="btn-primary" onclick="document.getElementById('products').scrollIntoView({behavior:'smooth'})">
        <i class="fas fa-arrow-down"></i> Blini tani
      </button>
    </div>
    <div class="hero-image">
  <img src="photoo.png" alt="Hero image" class="hero-img">
</div>
  </section>

  <h2 class="section-title">Shfletoni sipas kategorisë</h2>
  <div class="category-grid">
    <div class="cat-card"><i class="fas fa-apple-alt"></i><h3>Pemë dhe Perime</h3><p>Zgjedhje e gjerë e pemëve dhe perimeve natyrale, për ushqim të shëndetshëm dhe të freskët.</p></div>
    <div class="cat-card"><i class="fas fa-egg"></i><h3>Bulmet & Vezë  </h3><p>Bulmet dhe vezë të freskëta, të pasura me vlera ushqyese për çdo ditë.</p></div>
    <div class="cat-card"><i class="fas fa-bread-slice"></i><h3>Bukë & Pjekurina</h3><p>Bukë dhe pjekurina të freskëta, me shije të ngrohtë dhe cilësi të përditshme.</p></div>
    <div class="cat-card"><i class="fas fa-drumstick-bite"></i><h3>Ushqime të konzervuara</h3><p>Ushqime të konservuara praktike, me shije të ruajtur dhe cilësi të qëndrueshme.</p></div>
    <div class="cat-card"><i class="fas fa-shopping-basket"></i><h3>Produkte Bazë</h3><p>Produkte bazë të përditshme, të domosdoshme për çdo kuzhinë.</p></div>
    <div class="cat-card"><i class="fas fa-bacon"></i><h3>Të njelmëta</h3><p>Produkte të njelmëta me shije të pasur, ideale për çdo tryezë.</p></div>
    <div class="cat-card"><i class="fas fa-candy-cane"></i><h3>Të ëmbla</h3><p>Produkte të ëmbla me shije të këndshme, për çdo moment kënaqësie.</p></div>
    <div class="cat-card"><i class="fas fa-glass-whiskey"></i><h3>Pijet</h3><p>Pije të freskëta dhe të shumëllojshme, për çdo shije dhe moment.</p></div>
    <div class="cat-card"><i class="fas fa-mug-hot"></i><h3>Kafe, Qaj & Kakao</h3><p>Kafe, çaj dhe kakao me aromë të veçantë, për çdo moment relaksi.</p></div>
    <div class="cat-card"><i class="fas fa-wine-bottle"></i><h3>Alkool</h3><p>Pije alkoolike të përzgjedhura, për raste dhe shije të ndryshme.</p></div>
  </div>

  <h2 class="section-title" id="products">⭐ Zgjedhjet e ditës</h2>
  <div class="product-grid" id="productGrid"></div>


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

<!-- Checkout Modal -->
<div class="modal-overlay" id="checkoutModal">
  <div class="checkout-modal">
    <div class="modal-header">
      <h2 id="modalTitle">Arka</h2>
      <button class="close-modal" onclick="closeCheckoutModal()">&times;</button>
    </div>
    <div id="modalContent">
      <!-- Dynamic content will be loaded here -->
    </div>
  </div>
</div>

<script>
  (function(){
    "use strict";

    // Produktet nga PHP
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

    const isLoggedIn = <?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>;
    let cart = [];

    const productGrid = document.getElementById('productGrid');
    const cartCounter = document.getElementById('cartCounter');

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

    function renderProducts() {
      let html = '';
      products.forEach(p => {
        html += `
          <div class="product-card">
            <div class="product-img">
              <img src="${p.image}" alt="${p.name}" onerror="this.src='${FALLBACK_IMAGE}'">
            </div>
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
        btn.addEventListener('click', async (e) => {
          const id = Number(btn.dataset.id);
          const name = btn.dataset.name;
          const price = parseFloat(btn.dataset.price);
          const image = btn.dataset.image;
          const emoji = btn.dataset.emoji;
          
          await addToCart(id, name, price, image, emoji);
          
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
      if (isLoggedIn) {
        // Përdor MySQL për përdoruesit e kyçur
        try {
          const response = await fetch('cart_api.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ product_id: id, quantity: 1 })
          });
          const result = await response.json();
          console.log('Shtuar në shportë (server):', result);
        } catch(e) {
          console.error('Gabim:', e);
          alert('Ndodhi një gabim. Provoni përsëri.');
        }
      } else {
        // Përdor localStorage për përdoruesit jo të kyçur
        const existing = cart.find(item => item.id === id);
        if (existing) {
          existing.quantity += 1;
        } else {
          cart.push({ id, name, price, quantity: 1, image, emoji });
        }
        saveCart();
        console.log('Shtuar në shportë (local):', cart);
      }
      await updateCartCounter();
    }

    // Event listener për shportën
    document.getElementById('cartCounter')?.addEventListener('click', () => {
      window.location.href = 'shporta.php';
    });

    // Inicializo
    loadCart();
    renderProducts();
    updateCartCounter();
  })();
</script>
</body>
</html>