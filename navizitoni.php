<?php
require_once 'config.php';
?>




<!DOCTYPE html>
<html lang="sq">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Express Market · Na Vizitoni</title>
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
      align-items: center;
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
      padding: 40px 0 20px;
    }

    .page-header h1 {
      font-family: 'Playfair Display', serif;
      font-size: 42px;
      color: #1e3a2e;
      border-left: 12px solid #e7b42c;
      padding-left: 24px;
    }

    .page-header p {
      color: #5f6b5e;
      margin-top: 12px;
      margin-left: 36px;
      font-size: 18px;
    }

    /* Visit Layout */
    .visit-layout {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 40px;
      margin: 30px 0 50px;
    }

    /* Map Section */
    .map-section {
      background: white;
      border-radius: 32px;
      padding: 24px;
      box-shadow: 0 12px 28px -8px rgba(0,0,0,0.06);
      border: 1px solid #ede5d8;
    }

    .map-section h2 {
      font-family: 'Playfair Display', serif;
      font-size: 26px;
      margin-bottom: 20px;
      color: #1e3a2e;
    }

    .map-container {
      border-radius: 20px;
      overflow: hidden;
      margin-bottom: 20px;
      border: 2px solid #f0e4d5;
    }

    .map-container iframe {
      width: 100%;
      height: 300px;
      border: none;
      display: block;
    }

    .map-address {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 16px;
      background: #fef7ec;
      border-radius: 16px;
    }

    .map-address i {
      font-size: 28px;
      color: #e7b42c;
    }

    .map-address p {
      font-weight: 500;
    }

    .map-address small {
      color: #6b4f2c;
      font-size: 14px;
    }

    /* Info Cards */
    .info-section {
      display: flex;
      flex-direction: column;
      gap: 24px;
    }

    .info-card {
      background: white;
      border-radius: 28px;
      padding: 28px;
      box-shadow: 0 12px 28px -8px rgba(0,0,0,0.04);
      border: 1px solid #ede5d8;
    }

    .info-card h3 {
      font-family: 'Playfair Display', serif;
      font-size: 22px;
      margin-bottom: 20px;
      color: #1e3a2e;
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .info-card h3 i {
      color: #e7b42c;
      background: #fef7ec;
      padding: 10px;
      border-radius: 14px;
    }

    .hours-list {
      list-style: none;
    }

    .hours-list li {
      display: flex;
      justify-content: space-between;
      padding: 12px 0;
      border-bottom: 1px dashed #ede5d8;
    }

    .hours-list li:last-child {
      border-bottom: none;
    }

    .hours-list .day {
      font-weight: 600;
      color: #1e3a2e;
    }

    .hours-list .time {
      color: #5f6b5e;
    }

    .hours-list .highlight {
      color: #e7b42c;
      font-weight: 700;
    }

    .contact-list {
      list-style: none;
    }

    .contact-list li {
      display: flex;
      align-items: center;
      gap: 16px;
      padding: 14px 0;
      border-bottom: 1px dashed #ede5d8;
    }

    .contact-list li:last-child {
      border-bottom: none;
    }

    .contact-list i {
      width: 28px;
      color: #e7b42c;
      font-size: 20px;
    }

    .contact-list a {
      color: #1e3a2e;
      text-decoration: none;
      transition: color 0.2s;
    }

    .contact-list a:hover {
      color: #e7b42c;
    }

    .social-links {
      display: flex;
      gap: 16px;
      margin-top: 20px;
    }

    .social-link {
      background: #fef7ec;
      width: 50px;
      height: 50px;
      border-radius: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #1e3a2e;
      font-size: 22px;
      text-decoration: none;
      transition: all 0.2s;
    }

    .social-link:hover {
      background: #e7b42c;
      color: #1e3a2e;
      transform: translateY(-3px);
    }

    /* Features */
    .features-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 24px;
      margin: 40px 0 50px;
    }

    .feature-card {
      background: white;
      border-radius: 24px;
      padding: 28px 20px;
      text-align: center;
      box-shadow: 0 8px 20px rgba(0,0,0,0.03);
      border: 1px solid #ede5d8;
    }

    .feature-card i {
      font-size: 40px;
      color: #e7b42c;
      background: #fef7ec;
      padding: 18px;
      border-radius: 20px;
      margin-bottom: 20px;
    }

    .feature-card h4 {
      font-size: 18px;
      margin-bottom: 8px;
      color: #1e3a2e;
    }

    .feature-card p {
      color: #5f6b5e;
      font-size: 14px;
    }

 

    /* Responsive */
    @media (max-width: 900px) {
      .visit-layout {
        grid-template-columns: 1fr;
      }
      
      .features-grid {
        grid-template-columns: repeat(2, 1fr);
      }
      
      .header-actions {
        flex-wrap: wrap;
        justify-content: center;
      }
    }

    @media (max-width: 800px) {
      .header-flex {
        flex-direction: column;
        gap: 16px;
      }
    }

    @media (max-width: 480px) {
      .features-grid {
        grid-template-columns: 1fr;
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
  
  .page-header {
    padding: 25px 0 15px;
  }
  
  .page-header h1 {
    font-size: 28px;
    border-left: 8px solid #e7b42c;
    padding-left: 12px;
  }
  
  .page-header p {
    font-size: 14px;
    margin-left: 20px;
    margin-top: 8px;
  }
  
  .visit-layout {
    grid-template-columns: 1fr;
    gap: 20px;
    margin: 20px 0 30px;
  }
  
  .map-section {
    padding: 16px;
    border-radius: 20px;
  }
  
  .map-section h2 {
    font-size: 20px;
    margin-bottom: 14px;
  }
  
  .map-container {
    border-radius: 14px;
    margin-bottom: 14px;
  }
  
  .map-container iframe {
    height: 200px;
  }
  
  .map-address {
    padding: 12px;
    gap: 8px;
    border-radius: 12px;
  }
  
  .map-address i {
    font-size: 22px;
  }
  
  .map-address small {
    font-size: 12px;
  }
  
  .info-section {
    gap: 16px;
  }
  
  .info-card {
    padding: 18px 14px;
    border-radius: 20px;
  }
  
  .info-card h3 {
    font-size: 18px;
    margin-bottom: 14px;
    gap: 8px;
  }
  
  .info-card h3 i {
    padding: 8px;
    border-radius: 10px;
    font-size: 18px;
  }
  
  .hours-list li {
    padding: 10px 0;
    font-size: 14px;
  }
  
  .contact-list li {
    padding: 10px 0;
    gap: 10px;
    font-size: 14px;
  }
  
  .contact-list i {
    width: 22px;
    font-size: 16px;
  }
  
  .social-links {
    gap: 10px;
    margin-top: 14px;
    justify-content: center;
  }
  
  .social-link {
    width: 40px;
    height: 40px;
    border-radius: 12px;
    font-size: 18px;
  }
  
  .features-grid {
    grid-template-columns: 1fr;
    gap: 14px;
    margin: 25px 0 30px;
  }
  
  .feature-card {
    padding: 20px 16px;
    border-radius: 18px;
  }
  
  .feature-card i {
    font-size: 30px;
    padding: 14px;
    border-radius: 14px;
    margin-bottom: 14px;
  }
  
  .feature-card h4 {
    font-size: 16px;
  }
  
  .feature-card p {
    font-size: 12px;
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
  
  .page-header p {
    font-size: 15px;
    margin-left: 26px;
  }
  
  .visit-layout {
    grid-template-columns: 1fr;
    gap: 24px;
    margin: 22px 0 35px;
  }
  
  .map-section {
    padding: 18px;
    border-radius: 24px;
  }
  
  .map-section h2 {
    font-size: 22px;
  }
  
  .map-container iframe {
    height: 220px;
  }
  
  .info-card {
    padding: 20px 16px;
    border-radius: 22px;
  }
  
  .info-card h3 {
    font-size: 20px;
  }
  
  .hours-list li {
    font-size: 15px;
  }
  
  .contact-list li {
    font-size: 15px;
  }
  
  .social-links {
    gap: 12px;
    justify-content: center;
  }
  
  .social-link {
    width: 44px;
    height: 44px;
    font-size: 20px;
  }
  
  .features-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
    margin: 30px 0 35px;
  }
  
  .feature-card {
    padding: 22px 16px;
    border-radius: 20px;
  }
  
  .feature-card i {
    font-size: 34px;
    padding: 16px;
    border-radius: 16px;
    margin-bottom: 16px;
  }
  
  .feature-card h4 {
    font-size: 17px;
  }
  
  .feature-card p {
    font-size: 13px;
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
  
  .visit-layout {
    grid-template-columns: 1fr;
    gap: 28px;
  }
  
  .features-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 18px;
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
  
  .visit-layout {
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
  .visit-layout {
    grid-template-columns: 1fr;
    gap: 30px;
  }
  
  .features-grid {
    grid-template-columns: repeat(3, 1fr);
    gap: 18px;
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
  
  .features-grid {
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
  }
  
  .footer-top {
    grid-template-columns: repeat(4, 1fr);
  }
}

/* Orientimi peizazh në telefon */
@media (max-height: 500px) and (orientation: landscape) {
  .visit-layout {
    grid-template-columns: 1fr 1fr;
    gap: 20px;
  }
  
  .map-container iframe {
    height: 180px;
  }
  
  .info-section {
    gap: 14px;
  }
  
  .info-card {
    padding: 14px;
  }
  
  .info-card h3 {
    font-size: 16px;
    margin-bottom: 10px;
  }
  
  .hours-list li, .contact-list li {
    padding: 6px 0;
    font-size: 12px;
  }
  
  .social-links {
    gap: 8px;
    margin-top: 10px;
  }
  
  .social-link {
    width: 35px;
    height: 35px;
    font-size: 16px;
  }
  
  .features-grid {
    grid-template-columns: repeat(4, 1fr);
    gap: 10px;
    margin: 20px 0 25px;
  }
  
  .feature-card {
    padding: 14px 10px;
  }
  
  .feature-card i {
    font-size: 24px;
    padding: 10px;
    border-radius: 10px;
    margin-bottom: 10px;
  }
  
  .feature-card h4 {
    font-size: 13px;
  }
  
  .feature-card p {
    font-size: 11px;
  }
}

/* Retina dhe ekrane me densitet të lartë */
@media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
  .logo-img {
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
      <a href="navizitoni.php" style="color: #e7b42c; font-weight: 700;"><i class="fas fa-map-pin"></i> Na Vizitoni</a>
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
    <h1><i class="fas fa-map-pin" style="color: #e7b42c; margin-right: 12px;"></i> Na Vizitoni</h1>
    <p>Ejani të na vizitoni në dyqanin tonë - Ju mirëpresim me kënaqësi!</p>
  </div>

  <div class="visit-layout">
    <!-- Left Column - Map -->
    <div class="map-section">
      <h2><i class="fas fa-location-dot"></i> Vendndodhja Jonë</h2>
      <div class="map-container">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2944.785123456789!2d21.463456!3d42.465432!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1354d123456789ab%3A0x123456789abcdef!2sGjilan!5e0!3m2!1sen!2s!4v1620000000000!5m2!1sen!2s" 
                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
        </iframe>
      </div>
      <div class="map-address">
        <i class="fas fa-store"></i>
        <div>
          <p>Express Market - Dyqani Kryesor</p>
          <small>Rruga Adem Jashari 12, Gjilan, Kosovë</small>
        </div>
      </div>
      <p style="margin-top: 16px; color: #5f6b5e;">
        <i class="fas fa-parking" style="margin-right: 8px; color: #e7b42c;"></i>
        Parkim falas për klientët tanë
      </p>
    </div>

    <!-- Right Column - Info Cards -->
    <div class="info-section">
      <!-- Hours Card -->
      <div class="info-card">
        <h3><i class="fas fa-clock"></i> Orari i Punës</h3>
        <ul class="hours-list">
          <li><span class="day">E Hënë - E Premte</span> <span class="time">08:00 - 22:00</span></li>
          <li><span class="day">E Shtunë</span> <span class="time">08:00 - 23:00</span></li>
          <li><span class="day">E Dielë</span> <span class="time highlight">09:00 - 20:00</span></li>
        </ul>
        <p style="margin-top: 16px; font-size: 13px; color: #6b4f2c;">
          <i class="fas fa-info-circle"></i> Të hapur edhe gjatë festave zyrtare
        </p>
      </div>

      <!-- Contact Card -->
      <div class="info-card">
        <h3><i class="fas fa-phone"></i> Na Kontaktoni</h3>
        <ul class="contact-list">
          <li>
            <i class="fas fa-phone-alt"></i>
            <a href="tel:+383691234567">+383 69 123 4567</a>
          </li>
          <li>
            <i class="fas fa-phone-alt"></i>
            <a href="tel:+383691234568">+383 69 123 4568</a>
          </li>
          <li>
            <i class="fas fa-envelope"></i>
            <a href="mailto:info@expressmarket.com">info@expressmarket.com</a>
          </li>
          <li>
            <i class="fas fa-envelope"></i>
            <a href="mailto:porosi@expressmarket.com">porosi@expressmarket.com</a>
          </li>
        </ul>
        <div class="social-links">
          <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
          <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
          <a href="#" class="social-link"><i class="fab fa-whatsapp"></i></a>
          <a href="#" class="social-link"><i class="fab fa-tiktok"></i></a>
        </div>
      </div>
    </div>
  </div>

  <!-- Features Section -->
  <div class="features-grid">
    <div class="feature-card">
      <i class="fas fa-truck"></i>
      <h4>Transport Falas</h4>
      <p>Për porosi mbi 35€ brenda qytetit</p>
    </div>
    <div class="feature-card">
      <i class="fas fa-credit-card"></i>
      <h4>Pagesë e Sigurt</h4>
      <p>Pranohen të gjitha kartat kryesore</p>
    </div>
    <div class="feature-card">
      <i class="fas fa-undo-alt"></i>
      <h4>Kthim i Lehtë</h4>
      <p>30 ditë garanci për kthim</p>
    </div>
    <div class="feature-card">
      <i class="fas fa-headset"></i>
      <h4>Mbështetje 24/7</h4>
      <p>Ekipi ynë gjithmonë në dispozicion</p>
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