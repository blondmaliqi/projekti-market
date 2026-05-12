<?php
require_once 'config.php';
?>



<!DOCTYPE html>
<html lang="sq">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Express Market · Rreth Nesh</title>
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
      gap: 28px;
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
      gap: 12px;
      align-items: center;
    }

    .login-btn, .signup-btn {
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

    .login-btn {
      background: transparent;
      color: #1e3a2e;
      border: 2px solid #e7b42c;
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
      text-align: center;
    }

    .page-header h1 {
      font-family: 'Playfair Display', serif;
      font-size: 48px;
      color: #1e3a2e;
      margin-bottom: 16px;
    }

    .page-header p {
      color: #5f6b5e;
      font-size: 18px;
      max-width: 700px;
      margin: 0 auto;
    }

    /* Hero Section */
    .about-hero {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 50px;
      align-items: center;
      margin: 40px 0 60px;
    }

    .about-hero-content h2 {
      font-family: 'Playfair Display', serif;
      font-size: 36px;
      color: #1e3a2e;
      margin-bottom: 20px;
    }

    .about-hero-content h2 i {
      color: #e7b42c;
      margin-right: 12px;
    }

    .about-hero-content p {
      color: #3d4e3f;
      margin-bottom: 20px;
      font-size: 16px;
    }

    .about-hero-image {
      background: linear-gradient(135deg, #fef7ec 0%, #fdf3e2 100%);
      border-radius: 40px;
      padding: 40px;
      text-align: center;
      border: 2px dashed #e7b42c;
    }

    .about-hero-image i {
      font-size: 120px;
      color: #e7b42c;
      margin-bottom: 20px;
    }

    .about-hero-image h3 {
      font-family: 'Playfair Display', serif;
      font-size: 28px;
      color: #1e3a2e;
      margin-bottom: 10px;
    }

    /* Stats */
    .stats-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 24px;
      margin: 60px 0;
    }

    .stat-card {
      background: white;
      border-radius: 28px;
      padding: 32px 20px;
      text-align: center;
      box-shadow: 0 12px 28px -8px rgba(0,0,0,0.06);
      border: 1px solid #ede5d8;
    }

    .stat-card i {
      font-size: 48px;
      color: #e7b42c;
      background: #fef7ec;
      padding: 20px;
      border-radius: 24px;
      margin-bottom: 20px;
    }

    .stat-number {
      font-family: 'Playfair Display', serif;
      font-size: 42px;
      font-weight: 700;
      color: #1e3a2e;
      margin-bottom: 8px;
    }

    .stat-label {
      color: #5f6b5e;
      font-size: 16px;
    }

    /* Mission & Values */
    .mission-section {
      background: white;
      border-radius: 40px;
      padding: 48px;
      margin: 60px 0;
      box-shadow: 0 12px 28px -8px rgba(0,0,0,0.04);
      border: 1px solid #ede5d8;
    }

    .mission-title {
      font-family: 'Playfair Display', serif;
      font-size: 32px;
      color: #1e3a2e;
      text-align: center;
      margin-bottom: 40px;
    }

    .values-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 30px;
    }

    .value-card {
      text-align: center;
      padding: 24px;
    }

    .value-card i {
      font-size: 40px;
      color: #e7b42c;
      background: #fef7ec;
      padding: 18px;
      border-radius: 20px;
      margin-bottom: 20px;
    }

    .value-card h4 {
      font-size: 20px;
      margin-bottom: 12px;
      color: #1e3a2e;
    }

    .value-card p {
      color: #5f6b5e;
      font-size: 14px;
    }

    /* Team Section */
    .team-section {
      margin: 60px 0;
    }

    .team-title {
      font-family: 'Playfair Display', serif;
      font-size: 32px;
      color: #1e3a2e;
      text-align: center;
      margin-bottom: 40px;
    }

    .team-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 30px;
    }

    .team-card {
      background: white;
      border-radius: 28px;
      padding: 30px 20px;
      text-align: center;
      box-shadow: 0 12px 28px -8px rgba(0,0,0,0.04);
      border: 1px solid #ede5d8;
      transition: transform 0.2s;
    }

    .team-card:hover {
      transform: translateY(-6px);
    }

    .team-avatar {
      width: 120px;
      height: 120px;
      margin: 0 auto 20px;
      background: #fef7ec;
      border-radius: 60px;
      display: flex;
      align-items: center;
      justify-content: center;
      border: 4px solid #e7b42c;
    }

    .team-avatar i {
      font-size: 60px;
      color: #1e3a2e;
    }

    .team-card h4 {
      font-size: 22px;
      margin-bottom: 6px;
      color: #1e3a2e;
    }

    .team-role {
      color: #e7b42c;
      font-weight: 600;
      margin-bottom: 12px;
    }

    .team-card p {
      color: #5f6b5e;
      font-size: 14px;
    }

  

    /* Responsive */
    @media (max-width: 950px) {
      .nav-links {
        gap: 20px;
        flex-wrap: wrap;
        justify-content: center;
      }
      
      .nav-links a {
        font-size: 14px;
      }
    }

    @media (max-width: 900px) {
      .about-hero {
        grid-template-columns: 1fr;
        gap: 30px;
      }
      
      .stats-grid {
        grid-template-columns: repeat(2, 1fr);
      }
      
      .values-grid {
        grid-template-columns: 1fr;
      }
      
      .team-grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (max-width: 800px) {
      .header-flex {
        flex-direction: column;
        gap: 16px;
      }
      
      .header-actions {
        flex-wrap: wrap;
        justify-content: center;
      }
    }

    @media (max-width: 600px) {
      .stats-grid {
        grid-template-columns: 1fr;
      }
      
      .team-grid {
        grid-template-columns: 1fr;
      }
      
      .mission-section {
        padding: 30px 20px;
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
    font-size: 30px;
  }
  
  .page-header p {
    font-size: 14px;
    max-width: 100%;
  }
  
  .about-hero {
    grid-template-columns: 1fr;
    gap: 20px;
    margin: 25px 0 35px;
  }
  
  .about-hero-content h2 {
    font-size: 24px;
    margin-bottom: 14px;
  }
  
  .about-hero-content p {
    font-size: 14px;
    margin-bottom: 14px;
  }
  
  .about-hero-image {
    padding: 25px 15px;
    border-radius: 28px;
  }
  
  .about-hero-image i {
    font-size: 70px;
    margin-bottom: 14px;
  }
  
  .about-hero-image h3 {
    font-size: 22px;
  }
  
  .about-hero-image p {
    font-size: 14px;
  }
  
  .stats-grid {
    grid-template-columns: 1fr;
    gap: 12px;
    margin: 30px 0;
  }
  
  .stat-card {
    padding: 22px 16px;
    border-radius: 20px;
  }
  
  .stat-card i {
    font-size: 34px;
    padding: 14px;
    border-radius: 16px;
    margin-bottom: 14px;
  }
  
  .stat-number {
    font-size: 30px;
    margin-bottom: 6px;
  }
  
  .stat-label {
    font-size: 14px;
  }
  
  .mission-section {
    padding: 22px 16px;
    border-radius: 28px;
    margin: 35px 0;
  }
  
  .mission-title {
    font-size: 24px;
    margin-bottom: 25px;
  }
  
  .values-grid {
    grid-template-columns: 1fr;
    gap: 16px;
  }
  
  .value-card {
    padding: 16px;
  }
  
  .value-card i {
    font-size: 30px;
    padding: 14px;
    border-radius: 14px;
    margin-bottom: 14px;
  }
  
  .value-card h4 {
    font-size: 17px;
    margin-bottom: 8px;
  }
  
  .value-card p {
    font-size: 12px;
  }
  
  .team-section {
    margin: 35px 0;
  }
  
  .team-title {
    font-size: 24px;
    margin-bottom: 25px;
  }
  
  .team-grid {
    grid-template-columns: 1fr;
    gap: 16px;
  }
  
  .team-card {
    padding: 22px 16px;
    border-radius: 22px;
  }
  
  .team-avatar {
    width: 90px;
    height: 90px;
    border-radius: 45px;
    margin-bottom: 14px;
  }
  
  .team-avatar i {
    font-size: 44px;
  }
  
  .team-card h4 {
    font-size: 18px;
  }
  
  .team-role {
    font-size: 14px;
    margin-bottom: 8px;
  }
  
  .team-card p {
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
    font-size: 34px;
  }
  
  .page-header p {
    font-size: 15px;
  }
  
  .about-hero {
    grid-template-columns: 1fr;
    gap: 24px;
    margin: 30px 0 40px;
  }
  
  .about-hero-content h2 {
    font-size: 28px;
  }
  
  .about-hero-content p {
    font-size: 15px;
  }
  
  .about-hero-image {
    padding: 30px 20px;
    border-radius: 32px;
  }
  
  .about-hero-image i {
    font-size: 85px;
  }
  
  .about-hero-image h3 {
    font-size: 24px;
  }
  
  .stats-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 14px;
    margin: 35px 0;
  }
  
  .stat-card {
    padding: 24px 14px;
    border-radius: 22px;
  }
  
  .stat-card i {
    font-size: 36px;
    padding: 16px;
    border-radius: 18px;
    margin-bottom: 16px;
  }
  
  .stat-number {
    font-size: 34px;
  }
  
  .stat-label {
    font-size: 14px;
  }
  
  .mission-section {
    padding: 28px 18px;
    border-radius: 32px;
    margin: 40px 0;
  }
  
  .mission-title {
    font-size: 26px;
    margin-bottom: 30px;
  }
  
  .values-grid {
    grid-template-columns: 1fr;
    gap: 20px;
  }
  
  .value-card i {
    font-size: 34px;
    padding: 16px;
    border-radius: 16px;
  }
  
  .value-card h4 {
    font-size: 18px;
  }
  
  .team-section {
    margin: 40px 0;
  }
  
  .team-title {
    font-size: 26px;
    margin-bottom: 30px;
  }
  
  .team-grid {
    grid-template-columns: 1fr;
    gap: 18px;
  }
  
  .team-card {
    padding: 24px 18px;
  }
  
  .team-avatar {
    width: 100px;
    height: 100px;
    border-radius: 50px;
    margin-bottom: 16px;
  }
  
  .team-avatar i {
    font-size: 50px;
  }
  
  .team-card h4 {
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
  
  .page-header h1 {
    font-size: 38px;
  }
  
  .about-hero {
    grid-template-columns: 1fr;
    gap: 30px;
  }
  
  .stats-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
  }
  
  .values-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
  }
  
  .team-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
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
  .about-hero {
    grid-template-columns: 1fr;
    gap: 30px;
  }
  
  .stats-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 18px;
  }
  
  .values-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 22px;
  }
  
  .team-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 22px;
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
  
  .stats-grid {
    gap: 18px;
  }
  
  .values-grid {
    gap: 22px;
  }
  
  .team-grid {
    gap: 22px;
  }
  
  .footer-top {
    grid-template-columns: repeat(4, 1fr);
  }
}

/* Orientimi peizazh në telefon */
@media (max-height: 500px) and (orientation: landscape) {
  .about-hero {
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin: 15px 0 20px;
  }
  
  .about-hero-image {
    padding: 15px;
  }
  
  .about-hero-image i {
    font-size: 50px;
    margin-bottom: 10px;
  }
  
  .about-hero-image h3 {
    font-size: 18px;
  }
  
  .stats-grid {
    grid-template-columns: repeat(4, 1fr);
    gap: 10px;
    margin: 20px 0;
  }
  
  .stat-card {
    padding: 14px 10px;
    border-radius: 16px;
  }
  
  .stat-card i {
    font-size: 24px;
    padding: 10px;
    border-radius: 10px;
    margin-bottom: 10px;
  }
  
  .stat-number {
    font-size: 22px;
  }
  
  .stat-label {
    font-size: 11px;
  }
  
  .values-grid {
    grid-template-columns: repeat(3, 1fr);
    gap: 14px;
  }
  
  .team-grid {
    grid-template-columns: repeat(3, 1fr);
    gap: 14px;
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
      <a href="navizitoni.php"><i class="fas fa-map-pin"></i> Na Vizitoni</a>
      <a href="rrethnesh.php" style="color: #e7b42c; font-weight: 700;"><i class="fas fa-info-circle"></i> Rreth Nesh</a>
      
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
    <h1>Rreth Nesh</h1>
    <p>Njihuni me historinë, misionin dhe ekipin tonë të përkushtuar</p>
  </div>

  <!-- Hero Section -->
  <div class="about-hero">
    <div class="about-hero-content">
      <h2><i class="fas fa-store"></i> Historia Jonë</h2>
      <p>Express Market lindi në vitin 2020 me një vizion të thjeshtë: të sjellim freskinë dhe cilësinë më të mirë në tryezën tuaj. Filluam si një dyqan i vogël familjar në zemër të Gjilanit dhe sot jemi krenarë të shërbejmë mijëra familje çdo ditë.</p>
      <p>Ne besojmë se ushqimi i mirë fillon me përbërës të freskët dhe të pastër. Për këtë arsye, punojmë drejtpërdrejt me fermerët dhe prodhuesit vendorë për të garantuar cilësinë më të lartë në çdo produkt që ofrojmë.</p>
      <p>Çdo ditë, ekipi ynë zgjedh me kujdes frutat, perimet dhe produktet e tjera për t'u siguruar që ju merrni vetëm më të mirën. Freskia është premtimi ynë - dhe ne e mbajmë atë çdo ditë.</p>
    </div>
    <div class="about-hero-image">
      <i class="fas fa-store-alt"></i>
      <h3>Express Market</h3>
      <p>Freski në çdo hap që nga 2020</p>
    </div>
  </div>

  <!-- Stats Section -->
  <div class="stats-grid">
    <div class="stat-card">
      <i class="fas fa-calendar-check"></i>
      <div class="stat-number">5+</div>
      <div class="stat-label">Vite Eksperiencë</div>
    </div>
    <div class="stat-card">
      <i class="fas fa-users"></i>
      <div class="stat-number">10k+</div>
      <div class="stat-label">Klientë të Kënaqur</div>
    </div>
    <div class="stat-card">
      <i class="fas fa-box"></i>
      <div class="stat-number">500+</div>
      <div class="stat-label">Produkte Cilësore</div>
    </div>
    <div class="stat-card">
      <i class="fas fa-truck"></i>
      <div class="stat-number">24/7</div>
      <div class="stat-label">Shërbim i Shpejtë</div>
    </div>
  </div>

  <!-- Mission & Values -->
  <div class="mission-section">
    <h2 class="mission-title">Misioni & Vlerat Tona</h2>
    <div class="values-grid">
      <div class="value-card">
        <i class="fas fa-heart"></i>
        <h4>Cilësi dhe Freski</h4>
        <p>Zgjedhim me kujdes çdo produkt për të garantuar freskinë dhe cilësinë më të lartë për ju dhe familjen tuaj.</p>
      </div>
      <div class="value-card">
        <i class="fas fa-hand-holding-heart"></i>
        <h4>Përkushtim ndaj Komunitetit</h4>
        <p>Mbështesim fermerët dhe prodhuesit vendorë, duke kontribuar në ekonominë lokale dhe zhvillimin e komunitetit tonë.</p>
      </div>
      <div class="value-card">
        <i class="fas fa-leaf"></i>
        <h4>Përgjegjësi Mjedisore</h4>
        <p>Përdorim paketime ekologjike dhe praktika të qëndrueshme për të mbrojtur mjedisin për brezat e ardhshëm.</p>
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