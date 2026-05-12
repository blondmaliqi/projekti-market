<?php
// signup.php - Regjistrimi me MySQL
require_once 'config.php';

// Nëse përdoruesi është i kyçur, ridrejtoje
if (isset($_SESSION['user_id'])) {
    header('Location: ' . ($_SESSION['user_role'] === 'admin' ? 'admin.php' : 'index.php'));
    exit();
}

$error_message = '';
$success_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = trim($_POST['first_name'] ?? '');
    $last_name = trim($_POST['last_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    
    // Validimi
    if (!$first_name || !$last_name || !$email || !$password || !$confirm_password) {
        $error_message = '❌ Ju lutemi plotësoni të gjitha fushat e kërkuara!';
    } elseif ($password !== $confirm_password) {
        $error_message = '❌ Fjalëkalimet nuk përputhen!';
    } elseif (strlen($password) < 6) {
        $error_message = '❌ Fjalëkalimi duhet të ketë të paktën 6 karaktere!';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = '❌ Ju lutemi shkruani një email të vlefshëm!';
    } else {
        // Kontrollo nëse email-i ekziston
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        
        if ($stmt->fetch()) {
            $error_message = '❌ Ky email është i regjistruar tashmë!';
        } else {
            // Regjistro përdoruesin (plain text password për testim)
            $result = registerUser($pdo, $first_name, $last_name, $email, $password, $phone);
            
            if ($result) {
                $success_message = "✅ Llogaria u krijua me sukses! Mirë se vini $first_name!";
                
                // Hyr automatikisht pas regjistrimit
                $user = loginUser($pdo, $email, $password);
                if ($user) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_name'] = $user['first_name'] . ' ' . $user['last_name'];
                    $_SESSION['user_email'] = $user['email'];
                    $_SESSION['user_role'] = $user['role'];
                    
                    header('Refresh: 2; URL=index.php');
                }
            } else {
                $error_message = '❌ Ndodhi një gabim gjatë regjistrimit!';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="sq">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Express Market · Regjistrohu</title>
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
      padding: 40px;
      max-width: 500px;
      width: 100%;
      box-shadow: 0 30px 60px rgba(0, 0, 0, 0.08);
      border: 1px solid #f0e4d5;
    }

    .logo-wrapper {
      text-align: center;
      margin-bottom: 32px;
    }

    .logo-img {
      height: 100px;
      width: auto;
      max-width: 200px;
      object-fit: contain;
    }

    .auth-title {
      font-family: 'Playfair Display', serif;
      font-size: 34px;
      color: #1e3a2e;
      margin-bottom: 8px;
      text-align: center;
    }

    .auth-subtitle {
      text-align: center;
      color: #6b4f2c;
      margin-bottom: 32px;
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

    .success-message {
      background: #d4edda;
      color: #155724;
      padding: 12px 16px;
      border-radius: 14px;
      margin-bottom: 20px;
      text-align: center;
      font-size: 14px;
      border: 1px solid #c3e6cb;
    }

    .form-row {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 16px;
    }

    .form-group {
      margin-bottom: 20px;
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
      padding: 14px 16px;
      border: 2px solid #ede5d8;
      border-radius: 18px;
      font-size: 15px;
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
      right: 16px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      color: #999;
    }

    .password-hint {
      font-size: 12px;
      color: #7f8b7e;
      margin-top: 6px;
    }

    .terms {
      display: flex;
      align-items: center;
      gap: 12px;
      margin: 24px 0;
    }

    .terms input {
      width: 20px;
      height: 20px;
      accent-color: #e7b42c;
    }

    .terms label {
      font-size: 14px;
      color: #3d4e3f;
    }

    .terms a {
      color: #e7b42c;
      text-decoration: none;
      font-weight: 500;
    }

    .signup-btn {
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

    .signup-btn:hover {
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

    .social-signup {
      display: flex;
      gap: 16px;
      justify-content: center;
    }

    .social-btn {
      background: white;
      border: 2px solid #ede5d8;
      width: 55px;
      height: 55px;
      border-radius: 18px;
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

  <h1 class="auth-title">Regjistrohu</h1>
  <p class="auth-subtitle">Krijoni llogarinë tuaj për të filluar blerjet</p>

  <?php if ($error_message): ?>
    <div class="error-message"><?php echo $error_message; ?></div>
  <?php endif; ?>

  <?php if ($success_message): ?>
    <div class="success-message"><?php echo $success_message; ?></div>
  <?php endif; ?>

  <!-- Signup Form -->
  <form method="POST" action="">
    <div class="form-row">
      <div class="form-group">
        <label><i class="fas fa-user"></i> Emri</label>
        <input type="text" name="first_name" placeholder="Emri" value="<?php echo htmlspecialchars($_POST['first_name'] ?? ''); ?>" required>
      </div>
      <div class="form-group">
        <label><i class="fas fa-user"></i> Mbiemri</label>
        <input type="text" name="last_name" placeholder="Mbiemri" value="<?php echo htmlspecialchars($_POST['last_name'] ?? ''); ?>" required>
      </div>
    </div>

    <div class="form-group">
      <label><i class="fas fa-envelope"></i> Email</label>
      <input type="email" name="email" placeholder="emri@example.com" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>
    </div>

    <div class="form-group">
      <label><i class="fas fa-phone"></i> Telefoni</label>
      <input type="tel" name="phone" placeholder="+383 69 123 4567" value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>">
    </div>

    <div class="form-group">
      <label><i class="fas fa-lock"></i> Fjalëkalimi</label>
      <div class="password-wrapper">
        <input type="password" name="password" id="password" placeholder="••••••••" required>
        <i class="fas fa-eye toggle-password" onclick="togglePassword()"></i>
      </div>
      <p class="password-hint">Minimum 6 karaktere</p>
    </div>

    <div class="form-group">
      <label><i class="fas fa-lock"></i> Konfirmo Fjalëkalimin</label>
      <div class="password-wrapper">
        <input type="password" name="confirm_password" id="confirmPassword" placeholder="••••••••" required>
      </div>
    </div>

    <div class="terms">
      <input type="checkbox" id="terms" name="terms" required>
      <label for="terms">Jam dakord me <a href="termet.php">Termat dhe Kushtet</a> dhe <a href="privacy.php">Politikën e Privatësisë</a></label>
    </div>

    <button type="submit" class="signup-btn">
      <i class="fas fa-user-plus"></i> Regjistrohu
    </button>
  </form>

  

  <div class="auth-footer">
    Keni tashmë një llogari? <a href="login.php">Hyni këtu</a>
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

  function socialSignup(provider) {
    alert(`🔐 Regjistrimi me ${provider} (Demonstrim - nuk funksionon realisht)`);
  }
</script>

</body>
</html>