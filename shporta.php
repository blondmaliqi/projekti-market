<?php
require_once 'config.php';
?>



<!DOCTYPE html>
<html lang="sq">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Express Market · Shporta</title>
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
      background: #e7b42c;
      color: #1e3a2e;
      border: none;
      padding: 10px 20px;
      border-radius: 40px;
      font-weight: 600;
      font-size: 14px;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 8px;
      box-shadow: 0 4px 0 #b47c1c;
      text-decoration: none;
    }

    .cart-count {
      background: #1e3a2e;
      color: white;
      border-radius: 30px;
      padding: 2px 8px;
      font-size: 13px;
      font-weight: 700;
    }

    /* Page Header */
    .page-header {
      padding: 40px 0 20px;
    }

    .page-header h1 {
      font-family: 'Playfair Display', serif;
      font-size: 42px;
      color: #1e3a2e;
      border-left: 12px solid #e7b42c;
      padding-left: 24px;
    }

    /* Empty Cart */
    .empty-cart {
      text-align: center;
      padding: 80px 20px;
      background: white;
      border-radius: 36px;
      margin: 30px 0;
    }

    .empty-cart i {
      font-size: 80px;
      color: #d4b58c;
      margin-bottom: 24px;
    }

    .empty-cart h2 {
      font-family: 'Playfair Display', serif;
      font-size: 32px;
      margin-bottom: 16px;
      color: #1e3a2e;
    }

    .empty-cart p {
      color: #666;
      margin-bottom: 30px;
    }

    .continue-shopping {
      background: #e7b42c;
      color: #1e3a2e;
      padding: 16px 36px;
      border-radius: 60px;
      text-decoration: none;
      font-weight: 700;
      display: inline-block;
      box-shadow: 0 6px 0 #b47c1c;
    }

    /* Cart Content */
    .cart-content {
      background: white;
      border-radius: 36px;
      padding: 32px;
      margin: 30px 0;
    }

    .cart-items {
      list-style: none;
      margin-bottom: 30px;
    }

    .cart-item {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 20px 0;
      border-bottom: 1px solid #efe2d4;
    }

    .cart-item-info {
      display: flex;
      align-items: center;
      gap: 20px;
    }

    .cart-item-details h3 {
      font-size: 18px;
      margin-bottom: 6px;
    }

    .cart-item-price {
      color: #5f6b5e;
      font-size: 14px;
    }

    .item-controls {
      display: flex;
      align-items: center;
      gap: 16px;
    }

    .item-controls button {
      background: #f1ebe4;
      border: none;
      width: 40px;
      height: 40px;
      border-radius: 12px;
      font-weight: bold;
      font-size: 22px;
      cursor: pointer;
    }

    .item-total {
      font-weight: 700;
      font-size: 18px;
      min-width: 80px;
      text-align: right;
    }

    .remove-btn {
      background: none;
      border: none;
      color: #b85c5c;
      cursor: pointer;
      font-size: 18px;
      margin-left: 10px;
    }

    /* Cart Summary */
    .cart-summary {
      border-top: 2px dashed #dcc9b2;
      padding-top: 24px;
    }

    .summary-row {
      display: flex;
      justify-content: space-between;
      margin-bottom: 12px;
      font-size: 16px;
    }

    .summary-total {
      display: flex;
      justify-content: space-between;
      margin-top: 16px;
      padding-top: 16px;
      border-top: 1px solid #efe2d4;
      font-weight: 800;
      font-size: 24px;
    }

    .checkout-btn {
      background: #e7b42c;
      border: none;
      padding: 18px;
      border-radius: 60px;
      font-weight: 700;
      font-size: 18px;
      color: #1e3a2e;
      width: 100%;
      cursor: pointer;
      box-shadow: 0 6px 0 #b47c1c;
      margin-top: 24px;
    }

    .clear-cart-btn {
      background: none;
      border: 1px solid #d4b58c;
      padding: 12px 24px;
      border-radius: 40px;
      cursor: pointer;
      margin-top: 16px;
      width: 100%;
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

    /* Footer */
    .footer {
      background: #1e2b24;
      color: #e4d9cd;
      padding: 40px 0;
      margin-top: 60px;
      border-radius: 48px 48px 0 0;
    }

    .footer-content {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .footer .logo-text {
      color: #e7b42c;
      font-size: 26px;
    }

    @media (max-width: 800px) {
      .header-flex { flex-direction: column; gap: 16px; }
      .cart-item { flex-direction: column; align-items: flex-start; gap: 16px; }
      .item-controls { width: 100%; justify-content: space-between; }
      .form-row { grid-template-columns: 1fr; }
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


    .cart-item-img {
  width: 60px;
  height: 60px;
  border-radius: 16px;
  object-fit: cover;
  background: #fef7ec;
}

.cart-item-info {
  display: flex;
  align-items: center;
  gap: 20px;
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
  
  .page-header {
    padding: 25px 0 15px;
  }
  
  .page-header h1 {
    font-size: 28px;
    border-left: 8px solid #e7b42c;
    padding-left: 12px;
  }
  
  /* Empty Cart */
  .empty-cart {
    padding: 50px 16px;
    border-radius: 24px;
    margin: 20px 0;
  }
  
  .empty-cart i {
    font-size: 55px;
    margin-bottom: 16px;
  }
  
  .empty-cart h2 {
    font-size: 24px;
    margin-bottom: 10px;
  }
  
  .empty-cart p {
    font-size: 14px;
    margin-bottom: 22px;
  }
  
  .continue-shopping {
    padding: 14px 28px;
    font-size: 15px;
    border-radius: 50px;
  }
  
  /* Cart Content */
  .cart-content {
    padding: 18px 14px;
    border-radius: 24px;
    margin: 20px 0;
  }
  
  .cart-items {
    margin-bottom: 20px;
  }
  
  .cart-item {
    flex-direction: column;
    align-items: flex-start;
    gap: 12px;
    padding: 14px 0;
  }
  
  .cart-item-info {
    gap: 12px;
    width: 100%;
  }
  
  .cart-item-img {
    width: 50px;
    height: 50px;
    border-radius: 12px;
  }
  
  .cart-item-details h3 {
    font-size: 15px;
    margin-bottom: 4px;
  }
  
  .cart-item-price {
    font-size: 12px;
  }
  
  .item-controls {
    width: 100%;
    justify-content: space-between;
    gap: 8px;
  }
  
  .item-controls button {
    width: 34px;
    height: 34px;
    border-radius: 10px;
    font-size: 18px;
  }
  
  .item-total {
    font-size: 15px;
    min-width: 60px;
  }
  
  .remove-btn {
    font-size: 15px;
    margin-left: 4px;
  }
  
  /* Cart Summary */
  .cart-summary {
    padding-top: 18px;
  }
  
  .summary-row {
    font-size: 14px;
    margin-bottom: 8px;
  }
  
  .summary-total {
    font-size: 20px;
    margin-top: 12px;
    padding-top: 12px;
  }
  
  .checkout-btn {
    padding: 14px;
    font-size: 16px;
    border-radius: 50px;
    margin-top: 18px;
  }
  
  .clear-cart-btn {
    padding: 10px 18px;
    font-size: 14px;
    margin-top: 10px;
  }
  
  /* Checkout Modal */
  .checkout-modal {
    padding: 24px 16px;
    border-radius: 28px;
    max-width: 100%;
  }
  
  .modal-header {
    margin-bottom: 20px;
  }
  
  .modal-header h2 {
    font-size: 24px;
  }
  
  .close-modal {
    font-size: 22px;
    width: 32px;
    height: 32px;
  }
  
  .checkout-steps {
    margin-bottom: 20px;
  }
  
  .step-number {
    width: 32px;
    height: 32px;
    border-radius: 16px;
    font-size: 12px;
  }
  
  .step-label {
    font-size: 11px;
  }
  
  .checkout-form {
    margin-top: 20px;
  }
  
  .form-group {
    margin-bottom: 14px;
  }
  
  .form-group label {
    font-size: 13px;
    margin-bottom: 6px;
  }
  
  .form-group input {
    padding: 11px 14px;
    border-radius: 14px;
    font-size: 14px;
  }
  
  .form-row {
    grid-template-columns: 1fr;
    gap: 0;
  }
  
  .order-summary {
    padding: 16px;
    border-radius: 16px;
    margin: 20px 0;
  }
  
  .order-summary h3 {
    font-size: 16px;
    margin-bottom: 14px;
  }
  
  .summary-item {
    font-size: 13px;
    margin-bottom: 8px;
  }
  
  .summary-total {
    font-size: 16px;
    margin-top: 14px;
    padding-top: 14px;
  }
  
  .place-order-btn {
    padding: 14px;
    font-size: 15px;
    border-radius: 30px;
    margin-top: 14px;
  }
  
  /* Success Message */
  .success-message {
    padding: 25px 15px;
  }
  
  .success-message i {
    font-size: 55px;
    padding: 20px;
    border-radius: 40px;
    margin-bottom: 16px;
  }
  
  .success-message h3 {
    font-size: 24px;
    margin-bottom: 10px;
  }
  
  .success-message p {
    font-size: 14px;
    margin-bottom: 16px;
  }
  
  .order-number {
    padding: 12px;
    border-radius: 14px;
    font-size: 18px;
    margin: 14px 0;
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
    font-size: 32px;
    border-left: 10px solid #e7b42c;
    padding-left: 16px;
  }
  
  .empty-cart {
    padding: 60px 18px;
    border-radius: 28px;
  }
  
  .empty-cart i {
    font-size: 65px;
  }
  
  .empty-cart h2 {
    font-size: 26px;
  }
  
  .continue-shopping {
    padding: 15px 30px;
    font-size: 16px;
  }
  
  .cart-content {
    padding: 22px 16px;
    border-radius: 28px;
  }
  
  .cart-item {
    flex-direction: column;
    align-items: flex-start;
    gap: 14px;
    padding: 16px 0;
  }
  
  .cart-item-info {
    gap: 14px;
    width: 100%;
  }
  
  .cart-item-img {
    width: 55px;
    height: 55px;
    border-radius: 14px;
  }
  
  .cart-item-details h3 {
    font-size: 16px;
  }
  
  .cart-item-price {
    font-size: 13px;
  }
  
  .item-controls {
    width: 100%;
    justify-content: space-between;
    gap: 10px;
  }
  
  .item-controls button {
    width: 38px;
    height: 38px;
    font-size: 20px;
  }
  
  .item-total {
    font-size: 16px;
    min-width: 70px;
  }
  
  .checkout-modal {
    padding: 30px 20px;
    border-radius: 32px;
  }
  
  .modal-header h2 {
    font-size: 26px;
  }
  
  .summary-row {
    font-size: 15px;
  }
  
  .summary-total {
    font-size: 22px;
  }
  
  .place-order-btn {
    padding: 16px;
    font-size: 16px;
  }
  
  .success-message i {
    font-size: 65px;
    padding: 24px;
  }
  
  .success-message h3 {
    font-size: 26px;
  }
  
  .order-number {
    font-size: 20px;
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
  
  .cart-item {
    flex-direction: row;
    align-items: center;
  }
  
  .item-controls {
    width: auto;
  }
  
  .checkout-modal {
    padding: 32px 24px;
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
  
  .cart-item {
    flex-direction: column;
    align-items: flex-start;
    gap: 14px;
  }
  
  .item-controls {
    width: 100%;
    justify-content: space-between;
  }
  
  .form-row {
    grid-template-columns: 1fr;
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
  .cart-item {
    flex-direction: row;
    align-items: center;
  }
  
  .item-controls {
    width: auto;
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
    grid-template-columns: repeat(4, 1fr);
  }
}

/* Orientimi peizazh në telefon */
@media (max-height: 500px) and (orientation: landscape) {
  .empty-cart {
    padding: 30px 20px;
  }
  
  .empty-cart i {
    font-size: 40px;
    margin-bottom: 10px;
  }
  
  .cart-item {
    flex-direction: row;
    padding: 12px 0;
  }
  
  .checkout-modal {
    padding: 20px;
    max-height: 95vh;
    border-radius: 24px;
  }
  
  .checkout-steps {
    margin-bottom: 14px;
  }
  
  .checkout-form {
    margin-top: 14px;
  }
  
  .form-group {
    margin-bottom: 10px;
  }
  
  .form-group input {
    padding: 10px 14px;
    font-size: 13px;
  }
  
  .order-summary {
    padding: 14px;
    margin: 14px 0;
  }
  
  .order-summary h3 {
    font-size: 14px;
    margin-bottom: 10px;
  }
  
  .summary-item {
    font-size: 12px;
    margin-bottom: 6px;
  }
  
  .success-message {
    padding: 20px 15px;
  }
  
  .success-message i {
    font-size: 40px;
    padding: 14px;
    margin-bottom: 10px;
  }
  
  .success-message h3 {
    font-size: 20px;
  }
  
  .order-number {
    font-size: 16px;
    padding: 10px;
  }
}

/* Retina dhe ekrane me densitet të lartë */
@media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
  .logo-img, .cart-item-img {
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
  <div class="page-header">
    <h1><i class="fas fa-shopping-basket" style="color: #e7b42c; margin-right: 12px;"></i> Shporta juaj</h1>
  </div>

  <div id="cartContainer"></div>
</main>

<footer class="footer">
  <div class="container">
    <!-- Footer Top -->
    <div class="footer-top">
      <div class="footer-column">
        <div class="logo-text" style="font-size: 32px; margin-bottom: 16px;">Express Market</div>
        <p><i class="fas fa-map-marker-alt"></i> Rruga Adem Jashari 12, Gjilan</p>
        <p><i class="fas fa-phone"></i> +383 69 123 4567</p>
        <p><i class="fas fa-envelope"></i> info@expressmarket.com</p>
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
    <div id="modalContent"></div>
  </div>
</div>

<script>
  (function(){
    let cart = [];
    let currentStep = 1;
    let orderData = {};

    // Kontrollo nëse përdoruesi është i kyçur
const isLoggedIn = <?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>;
const userId = <?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'null'; ?>;

async function loadCart() {
  if (isLoggedIn) {
    // Ngarko nga MySQL
    try {
      const response = await fetch('cart_api.php');
      const data = await response.json();
      cart = data.cart.map(item => ({
        id: item.product_id,
        name: item.name,
        price: parseFloat(item.price),
        quantity: item.quantity,
        image: item.image,
        emoji: '📦'
      }));
    } catch(e) {
      // Nëse ka gabim, përdor localStorage
      const stored = localStorage.getItem('marketBlondiCart');
      if (stored) {
        try { cart = JSON.parse(stored); } catch(e) { cart = []; }
      }
    }
  } else {
    // Ngarko nga localStorage
    const stored = localStorage.getItem('marketBlondiCart');
    if (stored) {
      try { cart = JSON.parse(stored); } catch(e) { cart = []; }
    }
  }
}

async function saveCart() {
  if (isLoggedIn) {
    // Ruaj në MySQL (tashmë bëhet përmes cart_api.php)
    // Vetëm për përditësim, ruaj edhe në localStorage si backup
    localStorage.setItem('marketBlondiCart', JSON.stringify(cart));
  } else {
    // Ruaj në localStorage
    localStorage.setItem('marketBlondiCart', JSON.stringify(cart));
  }
}

    function calcTotal() {
      return cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    }

    function updateCartUI() {
      const container = document.getElementById('cartContainer');
      const counter = document.getElementById('cartCounter');
      
      // Imazh fallback nëse fotoja nuk gjendet
      const FALLBACK_IMAGE = 'data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'200\' height=\'200\' viewBox=\'0 0 200 200\'%3E%3Crect width=\'200\' height=\'200\' fill=\'%23fef7ec\'/%3E%3Ctext x=\'50%25\' y=\'50%25\' dominant-baseline=\'middle\' text-anchor=\'middle\' font-size=\'40\' fill=\'%23d4b58c\'%3E📦%3C/text%3E%3C/svg%3E';
      
      const totalItems = cart.reduce((t, i) => t + i.quantity, 0);
      if (counter) counter.textContent = totalItems;

      if (cart.length === 0) {
        container.innerHTML = `
          <div class="empty-cart">
            <i class="fas fa-shopping-basket"></i>
            <h2>Shporta juaj është bosh</h2>
            <p>Shtoni disa produkte të shijshme në shportën tuaj!</p>
            <a href="produktet.php" class="continue-shopping">
              <i class="fas fa-arrow-left"></i> Vazhdo Blerjet
            </a>
          </div>
        `;
        return;
      }

      let itemsHtml = '';
      let subtotal = 0;
      
      cart.forEach(item => {
        const itemTotal = item.price * item.quantity;
        subtotal += itemTotal;
        
        itemsHtml += `
          <li class="cart-item">
            <div class="cart-item-info">
              <img src="${item.image || FALLBACK_IMAGE}" alt="${item.name}" class="cart-item-img" onerror="this.src='${FALLBACK_IMAGE}'">
              <div class="cart-item-details">
                <h3>${item.name}</h3>
                <div class="cart-item-price">${item.price.toFixed(2)}€ / copë</div>
              </div>
            </div>
            <div class="item-controls">
              <button onclick="updateQuantity(${item.id}, -1)">−</button>
              <span style="font-weight: 600; min-width: 30px; text-align: center;">${item.quantity}</span>
              <button onclick="updateQuantity(${item.id}, 1)">+</button>
              <span class="item-total">${itemTotal.toFixed(2)}€</span>
              <button class="remove-btn" onclick="removeItem(${item.id})">
                <i class="fas fa-trash"></i>
              </button>
            </div>
          </li>
        `;
      });

      const shipping = subtotal >= 35 ? 0 : 5;
      const total = subtotal + shipping;

      container.innerHTML = `
        <div class="cart-content">
          <ul class="cart-items">${itemsHtml}</ul>
          
          <div class="cart-summary">
            <div class="summary-row"><span>Nëntotali:</span><span>${subtotal.toFixed(2)}€</span></div>
            <div class="summary-row"><span>Transporti:</span><span>${shipping === 0 ? 'FALAS' : shipping.toFixed(2) + '€'}</span></div>
            <div class="summary-total"><span>Totali:</span><span>${total.toFixed(2)}€</span></div>
            
            <button class="checkout-btn" onclick="openCheckoutModal()">
              <i class="fas fa-lock"></i> Vazhdo te Pagesa
            </button>
            <button class="clear-cart-btn" onclick="clearCart()">
              <i class="fas fa-trash-alt"></i> Zbraz Shportën
            </button>
          </div>
        </div>
      `;
    }

   window.updateQuantity = async function(id, delta) {
  const item = cart.find(i => i.id === id);
  if (!item) return;
  const newQty = item.quantity + delta;
  
  if (newQty <= 0) {
    cart = cart.filter(i => i.id !== id);
    if (isLoggedIn) {
      await fetch('cart_api.php', {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ product_id: id, quantity: 0 })
      });
    }
  } else {
    item.quantity = newQty;
    if (isLoggedIn) {
      await fetch('cart_api.php', {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ product_id: id, quantity: newQty })
      });
    }
  }
  saveCart();
  updateCartUI();
};

window.removeItem = async function(id) {
  cart = cart.filter(i => i.id !== id);
  if (isLoggedIn) {
    await fetch('cart_api.php', {
      method: 'DELETE',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ product_id: id })
    });
  }
  saveCart();
  updateCartUI();
};

window.clearCart = async function() {
  if (confirm('Jeni të sigurt që doni të zbrazni shportën?')) {
    cart = [];
    if (isLoggedIn) {
      await fetch('cart_api.php', { method: 'PATCH' });
    }
    saveCart();
    updateCartUI();
  }
};

    // ========== CHECKOUT MODAL ==========
    function openCheckoutModal() {
      if (cart.length === 0) {
        alert('🛒 Shporta juaj është bosh.');
        return;
      }
      currentStep = 1;
      renderCheckoutStep();
      document.getElementById('checkoutModal').classList.add('active');
    }

    function closeCheckoutModal() {
      document.getElementById('checkoutModal').classList.remove('active');
      currentStep = 1;
    }

    // Funksioni për të ndërruar fushat e pagesës
    window.togglePaymentMethod = function() {
      const cashMethod = document.querySelector('input[value="cash"]');
      const cardFields = document.getElementById('cardPaymentFields');
      const cashFields = document.getElementById('cashPaymentFields');
      
      if (cashMethod && cashMethod.checked) {
        if (cardFields) cardFields.style.display = 'none';
        if (cashFields) cashFields.style.display = 'block';
        // Heq required nga fushat e kartës
        const cardNumber = document.getElementById('cardNumber');
        const expiry = document.getElementById('expiry');
        const cvv = document.getElementById('cvv');
        const cardName = document.getElementById('cardName');
        if (cardNumber) cardNumber.required = false;
        if (expiry) expiry.required = false;
        if (cvv) cvv.required = false;
        if (cardName) cardName.required = false;
      } else {
        if (cardFields) cardFields.style.display = 'block';
        if (cashFields) cashFields.style.display = 'none';
        // Shton required për fushat e kartës
        const cardNumber = document.getElementById('cardNumber');
        const expiry = document.getElementById('expiry');
        const cvv = document.getElementById('cvv');
        const cardName = document.getElementById('cardName');
        if (cardNumber) cardNumber.required = true;
        if (expiry) expiry.required = true;
        if (cvv) cvv.required = true;
        if (cardName) cardName.required = true;
      }
    };

    function renderCheckoutStep() {
      const modalContent = document.getElementById('modalContent');
      const modalTitle = document.getElementById('modalTitle');
      const subtotal = calcTotal();
      const shipping = subtotal >= 35 ? 0 : 5;
      
      if (currentStep === 1) {
        modalTitle.textContent = 'Informacioni i Transportit';
        modalContent.innerHTML = `
          <div class="checkout-steps">
            <div class="step active"><div class="step-number">1</div><div class="step-label">Transporti</div></div>
            <div class="step"><div class="step-number">2</div><div class="step-label">Pagesa</div></div>
            <div class="step"><div class="step-number">3</div><div class="step-label">Konfirmo</div></div>
          </div>
          
          <form class="checkout-form" onsubmit="event.preventDefault(); nextStep();">
            <div class="form-group"><label><i class="fas fa-user"></i> Emri i Plotë</label><input type="text" id="fullName" placeholder="Emri Mbiemri" required></div>
            <div class="form-group"><label><i class="fas fa-envelope"></i> Email</label><input type="email" id="email" placeholder="emri@example.com" required></div>
            <div class="form-group"><label><i class="fas fa-map-marker-alt"></i> Adresa e Dorëzimit</label><input type="text" id="address" placeholder="Rruga, numri" required></div>
            <div class="form-row">
              <div class="form-group"><label>Qyteti</label><input type="text" id="city" placeholder="Qyteti" required></div>
              <div class="form-group"><label>Kodi Postar</label><input type="text" id="postal" placeholder="1001" required></div>
            </div>
            <div class="form-group"><label><i class="fas fa-phone"></i> Telefoni</label><input type="tel" id="phone" placeholder="+383 69 123 4567" required></div>
            
            <div class="order-summary">
              <h3>Përmbledhja e Porosisë</h3>
              ${cart.map(item => `<div class="summary-item"><span>${item.name} x${item.quantity}</span><span>${(item.price * item.quantity).toFixed(2)}€</span></div>`).join('')}
              <div class="summary-total"><span>Totali</span><span>${(subtotal + shipping).toFixed(2)}€</span></div>
            </div>
            
            <button type="submit" class="place-order-btn">Vazhdo te Pagesa <i class="fas fa-arrow-right"></i></button>
          </form>
        `;
      } else if (currentStep === 2) {
        modalTitle.textContent = 'Detajet e Pagesës';
        modalContent.innerHTML = `
          <div class="checkout-steps">
            <div class="step completed"><div class="step-number"><i class="fas fa-check"></i></div><div class="step-label">Transporti</div></div>
            <div class="step active"><div class="step-number">2</div><div class="step-label">Pagesa</div></div>
            <div class="step"><div class="step-number">3</div><div class="step-label">Konfirmo</div></div>
          </div>
          
          <form class="checkout-form" onsubmit="event.preventDefault(); nextStep();">
            
            <!-- Zgjedhja e metodës së pagesës -->
            <div class="form-group">
              <label><i class="fas fa-credit-card"></i> Metoda e Pagesës</label>
              <div style="display: flex; gap: 20px; margin-top: 12px;">
                <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                  <input type="radio" name="paymentMethod" value="card" checked onchange="togglePaymentMethod()">
                  <i class="far fa-credit-card" style="color: #e7b42c;"></i> Kartë Bankare
                </label>
                <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                  <input type="radio" name="paymentMethod" value="cash" onchange="togglePaymentMethod()">
                  <i class="fas fa-money-bill-wave" style="color: #e7b42c;"></i> Cash (Para në Dorë)
                </label>
              </div>
            </div>
            
            <!-- Forma për Kartë Bankare -->
            <div id="cardPaymentFields">
              <div class="form-group">
                <label><i class="far fa-credit-card"></i> Numri i Kartës</label>
                <input type="text" id="cardNumber" placeholder="1234 5678 9012 3456" maxlength="19" required>
              </div>
              <div class="form-row">
                <div class="form-group">
                  <label>Data e Skadencës</label>
                  <input type="text" id="expiry" placeholder="MM/VV" maxlength="5" required>
                </div>
                <div class="form-group">
                  <label>CVV</label>
                  <input type="text" id="cvv" placeholder="123" maxlength="3" required>
                </div>
              </div>
              <div class="form-group">
                <label><i class="fas fa-user"></i> Emri në Kartë</label>
                <input type="text" id="cardName" placeholder="Emri si në kartë" required>
              </div>
              <p style="color: #666; font-size: 14px; margin: 20px 0;">
                <i class="fas fa-lock"></i> Ky është një demonstrim - asnjë pagesë reale nuk do të përpunohet
              </p>
            </div>
            
            <!-- Mesazh për Cash -->
            <div id="cashPaymentFields" style="display: none;">
              <div style="background: #fef7ec; border-left: 4px solid #e7b42c; padding: 20px 24px; border-radius: 16px; margin: 20px 0;">
                <p style="margin-bottom: 0;">
                  <i class="fas fa-hand-holding-usd" style="color: #e7b42c; margin-right: 10px;"></i>
                  <strong>Pagesa me Cash (Para në Dorë)</strong><br>
                  Ju do të paguani në momentin e dorëzimit të porosisë.
                </p>
              </div>
            </div>
            
            <button type="submit" class="place-order-btn">Shqyrto Porosinë <i class="fas fa-arrow-right"></i></button>
            <button type="button" class="clear-cart-btn" style="width:100%; margin-top:12px;" onclick="previousStep()">
              <i class="fas fa-arrow-left"></i> Kthehu te Transporti
            </button>
          </form>
        `;
      } else if (currentStep === 3) {
        modalTitle.textContent = 'Konfirmo Porosinë';
        // Kontrollo metodën e zgjedhur të pagesës
        const cashMethod = document.querySelector('input[value="cash"]');
        const paymentMethod = (cashMethod && cashMethod.checked) ? 'Cash (Para në Dorë)' : 'Kartë Bankare';
        
        modalContent.innerHTML = `
          <div class="checkout-steps">
            <div class="step completed"><div class="step-number"><i class="fas fa-check"></i></div><div class="step-label">Transporti</div></div>
            <div class="step completed"><div class="step-number"><i class="fas fa-check"></i></div><div class="step-label">Pagesa</div></div>
            <div class="step active"><div class="step-number">3</div><div class="step-label">Konfirmo</div></div>
          </div>
          
          <div class="order-summary">
            <h3>Përmbledhja Përfundimtare</h3>
            ${cart.map(item => `<div class="summary-item"><span>${item.name} x${item.quantity}</span><span>${(item.price * item.quantity).toFixed(2)}€</span></div>`).join('')}
            <div class="summary-item"><span>Tarifa e Transportit</span><span>${shipping === 0 ? 'FALAS' : shipping.toFixed(2) + '€'}</span></div>
            <div class="summary-item"><span>Metoda e Pagesës</span><span><i class="fas ${(cashMethod && cashMethod.checked) ? 'fa-money-bill-wave' : 'fa-credit-card'}" style="color: #e7b42c; margin-right: 6px;"></i>${paymentMethod}</span></div>
            <div class="summary-total"><span>Shuma Totale</span><span>${(subtotal + shipping).toFixed(2)}€</span></div>
          </div>
          
          <p style="text-align: center; margin: 20px 0;"><i class="fas fa-check-circle" style="color: #1e3a2e;"></i> Duke vendosur këtë porosi, ju pranoni termat dhe kushtet tona.</p>
          
          <button class="place-order-btn" onclick="placeOrder()"><i class="fas fa-check"></i> Vendos Porosinë</button>
          <button class="clear-cart-btn" style="width:100%; margin-top:12px;" onclick="previousStep()"><i class="fas fa-arrow-left"></i> Kthehu te Pagesa</button>
        `;
      }
    }

    function nextStep() {
  if (currentStep === 1) {
    const name = document.getElementById('fullName')?.value;
    const email = document.getElementById('email')?.value;
    const address = document.getElementById('address')?.value;
    const city = document.getElementById('city')?.value;
    const postal = document.getElementById('postal')?.value;
    const phone = document.getElementById('phone')?.value;
    
    if (!name || !email || !address) {
      alert('Ju lutemi plotësoni të gjitha fushat e kërkuara');
      return;
    }
    
    orderData = {
      fullName: name,
      email: email,
      address: address,
      city: city,
      postal: postal,
      phone: phone
    };
  } else if (currentStep === 2) {
    // ✅ RUAJ METODËN E PAGESËS KËTU
    const cashMethod = document.querySelector('input[value="cash"]');
    const paymentMethod = (cashMethod && cashMethod.checked) ? 'cash' : 'card';
    orderData.paymentMethod = paymentMethod;
    
    if (paymentMethod === 'card') {
      const cardNumber = document.getElementById('cardNumber')?.value;
      const expiry = document.getElementById('expiry')?.value;
      const cvv = document.getElementById('cvv')?.value;
      const cardName = document.getElementById('cardName')?.value;
      
      if (!cardNumber || !expiry || !cvv || !cardName) {
        alert('Ju lutemi plotësoni të gjitha detajet e kartës');
        return;
      }
    }
  }
  currentStep++;
  renderCheckoutStep();
}

    function previousStep() {
      if (currentStep > 1) {
        currentStep--;
        renderCheckoutStep();
      }
    }

   async function placeOrder() {
  // ✅ Përdor metodën e ruajtur në orderData, jo radio button-in
  const paymentMethod = orderData.paymentMethod || 'cash';
  
  const { fullName, email, address, city, postal, phone } = orderData;
  
  console.log('Të dhënat e porosisë:', orderData);
  
  if (!fullName || !email || !address || !city) {
    alert('❌ Ju lutemi kthehuni te hapi 1 dhe plotësoni të dhënat!');
    return;
  }
  
  try {
    const response = await fetch('checkout_api.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        fullName, email, phone, address, city,
        postal_code: postal,
        paymentMethod,
        cartItems: cart.map(item => ({
          id: item.id,
          name: item.name,
          price: item.price,
          quantity: item.quantity,
          image: item.image
        }))
      })
    });
    
    const data = await response.json();
    
    if (data.success) {
      const modalContent = document.getElementById('modalContent');
      const modalTitle = document.getElementById('modalTitle');
      
      modalTitle.textContent = 'Porosia u Konfirmua!';
      modalContent.innerHTML = `
        <div class="success-message">
          <i class="fas fa-check-circle"></i>
          <h3>Faleminderit për Porosinë Tuaj!</h3>
          <p>Porosia juaj u vendos me sukses.</p>
          <div class="order-number">Porosia #${data.orderNumber}</div>
          <p style="margin: 20px 0;"><i class="fas fa-envelope"></i> Një email konfirmimi u dërgua.<br><i class="fas fa-clock"></i> Dorëzimi: 30-45 minuta</p>
          <p style="color: #666; font-size: 14px;">Ky është një demonstrim</p>
          <button class="place-order-btn" onclick="finishCheckout()"><i class="fas fa-shopping-bag"></i> Vazhdo Blerjet</button>
        </div>
      `;
      
      cart = [];
      saveCart();
      updateCartUI();
    } else {
      alert('❌ Gabim: ' + (data.message || 'Provoni përsëri'));
    }
  } catch(e) {
    console.error('Gabim:', e);
    alert('❌ Gabim në lidhje.');
  }
}

function finishCheckout() {
  closeCheckoutModal();
  updateCartUI();
}

    function finishCheckout() {
      closeCheckoutModal();
      cart = [];
      saveCart();
      updateCartUI();
    }

    // Global functions
    window.openCheckoutModal = openCheckoutModal;
    window.closeCheckoutModal = closeCheckoutModal;
    window.nextStep = nextStep;
    window.previousStep = previousStep;
    window.placeOrder = placeOrder;
    window.finishCheckout = finishCheckout;

    // Close modal on overlay click
    document.getElementById('checkoutModal').addEventListener('click', (e) => {
      if (e.target.classList.contains('modal-overlay')) closeCheckoutModal();
    });

      async function init() {
      await loadCart();
      updateCartUI();
    }
    
    init();
  })();
</script>
</body>
</html>