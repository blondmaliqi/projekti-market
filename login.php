<?php
// login.php - Hyrja me MySQL
require_once 'config.php';

// Nëse përdoruesi është i kyçur, ridrejtoje
if (isset($_SESSION['user_id'])) {
    header('Location: ' . ($_SESSION['user_role'] === 'admin' ? 'admin.php' : 'index.php'));
    exit();
}

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if ($email && $password) {
        $user = loginUser($pdo, $email, $password);
        
        if ($user) {
            // Krijo sesionin
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['first_name'] . ' ' . $user['last_name'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_role'] = $user['role'];
            
            // Ridrejto në admin.php ose index.php
            header('Location: ' . ($user['role'] === 'admin' ? 'admin.php' : 'index.php'));
            exit();
        } else {
            $error_message = '❌ Email ose fjalëkalim i pasaktë!';
        }
    } else {
        $error_message = '❌ Ju lutemi plotësoni të gjitha fushat!';
    }
}
?>

<!DOCTYPE html>
<html lang="sq">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Express Market · Hyr</title>
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
      background: linear-gradient(135deg, #fefcf5 0%, #fdf6e9 100%);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }

    .auth-container {
      background: white;
      border-radius: 48px;
      padding: 48px 40px;
      max-width: 460px;
      width: 100%;
      box-shadow: 0 30px 60px rgba(0, 0, 0, 0.08);
      border: 1px solid #f0e4d5;
    }

    .logo-wrapper {
      text-align: center;
      margin-bottom: 40px;
    }

    .logo-img {
      height: 100px;
      width: auto;
      max-width: 220px;
      object-fit: contain;
    }

    .auth-title {
      font-family: 'Playfair Display', serif;
      font-size: 36px;
      color: #1e3a2e;
      margin-bottom: 8px;
      text-align: center;
    }

    .auth-subtitle {
      text-align: center;
      color: #6b4f2c;
      margin-bottom: 36px;
      font-size: 14px;
    }

    .error-message {
      background: #fce4e4;
      color: #c0392b;
      padding: 12px 16px;
      border-radius: 14px;
      margin-bottom: 20px;
      text-align: center;
      font-size: 14px;
      border: 1px solid #f5c6c6;
    }

    .form-group {
      margin-bottom: 24px;
    }

    .form-group label {
      display: block;
      margin-bottom: 8px;
      font-weight: 600;
      color: #1e3a2e;
      font-size: 14px;
    }

    .form-group label i {
      color: #e7b42c;
      width: 20px;
    }

    .form-group input {
      width: 100%;
      padding: 16px 18px;
      border: 2px solid #ede5d8;
      border-radius: 20px;
      font-size: 16px;
      font-family: 'Inter', sans-serif;
      transition: border-color 0.2s;
    }

    .form-group input:focus {
      outline: none;
      border-color: #e7b42c;
    }

    .password-wrapper {
      position: relative;
    }

    .password-wrapper input {
      padding-right: 50px;
    }

    .toggle-password {
      position: absolute;
      right: 18px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      color: #999;
    }

    .forgot-password {
      text-align: right;
      margin-top: -8px;
      margin-bottom: 24px;
    }

    .forgot-password a {
      color: #e7b42c;
      text-decoration: none;
      font-size: 14px;
      font-weight: 500;
    }

    .forgot-password a:hover {
      text-decoration: underline;
    }

    .login-btn {
      background: #e7b42c;
      border: none;
      padding: 16px;
      border-radius: 40px;
      font-weight: 700;
      font-size: 18px;
      color: #1e3a2e;
      width: 100%;
      cursor: pointer;
      box-shadow: 0 6px 0 #b47c1c;
      transition: all 0.15s;
      margin-bottom: 24px;
    }

    .login-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 0 #b47c1c;
    }

    .auth-footer {
      text-align: center;
      color: #5f6b5e;
      font-size: 14px;
    }

    .auth-footer a {
      color: #e7b42c;
      text-decoration: none;
      font-weight: 600;
    }

    .auth-footer a:hover {
      text-decoration: underline;
    }

    .back-home {
      text-align: center;
      margin-top: 20px;
    }

    .back-home a {
      color: #1e3a2e;
      text-decoration: none;
      font-size: 14px;
      display: inline-flex;
      align-items: center;
      gap: 8px;
    }

    .back-home a:hover {
      color: #e7b42c;
    }

    .divider {
      display: flex;
      align-items: center;
      text-align: center;
      margin: 24px 0;
      color: #b4a08a;
    }

    .divider::before,
    .divider::after {
      content: '';
      flex: 1;
      border-bottom: 1px solid #ede5d8;
    }

    .divider span {
      padding: 0 16px;
      font-size: 13px;
    }

    .social-login {
      display: flex;
      gap: 16px;
      justify-content: center;
    }

    .social-btn {
      background: white;
      border: 2px solid #ede5d8;
      width: 60px;
      height: 60px;
      border-radius: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: all 0.2s;
      color: #3d4e3f;
      font-size: 22px;
    }

    .social-btn:hover {
      border-color: #e7b42c;
      background: #fef7ec;
    }
  </style>
</head>
<body>

<div class="auth-container">
  <!-- Logo -->
  <div class="logo-wrapper">
    <a href="index.php">
      <img src="expressmarketlogo.png" alt="Express Market" class="logo-img">
    </a>
  </div>

  <h1 class="auth-title">Mirë se vini!</h1>
  <p class="auth-subtitle">Hyni në llogarinë tuaj për të vazhduar</p>

  <?php if ($error_message): ?>
    <div class="error-message"><?php echo $error_message; ?></div>
  <?php endif; ?>

  <!-- Login Form -->
  <form method="POST" action="">
    <div class="form-group">
      <label><i class="fas fa-envelope"></i> Email</label>
      <input type="email" name="email" placeholder="emri@example.com" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>
    </div>

    <div class="form-group">
      <label><i class="fas fa-lock"></i> Fjalëkalimi</label>
      <div class="password-wrapper">
        <input type="password" name="password" id="password" placeholder="••••••••" required>
        <i class="fas fa-eye toggle-password" onclick="togglePassword()"></i>
      </div>
    </div>

    

    <button type="submit" class="login-btn">
      <i class="fas fa-sign-in-alt"></i> Hyr
    </button>
  </form>

  

  <div class="auth-footer">
    Nuk keni llogari? <a href="signup.php">Regjistrohu tani</a>
  </div>

  <div class="back-home">
    <a href="index.php">
      <i class="fas fa-arrow-left"></i> Kthehu në kryefaqe
    </a>
  </div>
</div>

<script>
  function togglePassword() {
    const passwordInput = document.getElementById('password');
    const icon = document.querySelector('.toggle-password');
    
    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
      icon.classList.remove('fa-eye');
      icon.classList.add('fa-eye-slash');
    } else {
      passwordInput.type = 'password';
      icon.classList.remove('fa-eye-slash');
      icon.classList.add('fa-eye');
    }
  }

  function socialLogin(provider) {
    alert(`🔐 Hyrja me ${provider} (Demonstrim - nuk funksionon realisht)`);
  }
</script>

</body>
</html>