<?php
session_start();
require_once '../config.php';

// Redirect to home if already logged in
if (isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit;
}

$error = '';
$success = '';

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {    // LOGIN PROCESS
    if (isset($_POST['login'])) {
        $email = trim($_POST['email']);
        $password = $_POST['password'];
        
        // Validate input
        if (empty($email) || empty($password)) {
            $error = "Please enter both email and password.";
        } else {            try {
                // Get user from DB
                $stmt = $pdo->prepare("SELECT * FROM customer WHERE email = ?");
                $stmt->execute([$email]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if ($user && password_verify($password, $user['password'])) {
                    // Password correct, set session
                    $_SESSION['user_id'] = $user['customer_id'];
                    $_SESSION['name'] = $user['name'];
                    
                    // Add custom admin check if needed
                    if ($email === 'admin@crustpizza.com.au') {
                        $_SESSION['role'] = 'admin';
                        header("Location: ../admin/dashboard.php");
                    } else {
                        $_SESSION['role'] = 'customer';
                        header("Location: ../index.php");
                    }
                    exit;
                } else {
                    $error = "Invalid email or password.";
                }
            } catch (PDOException $e) {
                $error = "Database error: " . $e->getMessage();
            }
        }
    } 
    // SIGNUP PROCESS    elseif (isset($_POST['signup'])) {
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $phone = trim($_POST['phone'] ?? '');
        $address = trim($_POST['address'] ?? '');
        $password = $_POST['password'];
        $passwordConfirm = $_POST['password_confirm'] ?? '';
        
        // Validate input
        if (empty($name) || empty($email) || empty($password) || empty($passwordConfirm)) {
            $error = "Please fill all required fields.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Please enter a valid email address.";
        } elseif (strlen($password) < 6) {
            $error = "Password must be at least 6 characters long.";
        } elseif ($password !== $passwordConfirm) {
            $error = "Passwords do not match.";
        } elseif (empty($phone)) {
            $error = "Phone number is required.";
        } elseif (empty($address)) {
            $error = "Address is required.";
        } else {
            try {
                // Check if email already exists
                $stmt = $pdo->prepare("SELECT customer_id FROM customer WHERE email = ?");
                $stmt->execute([$email]);
                if ($stmt->fetch()) {
                    $error = "Email already registered. Please login.";
                } else {
                    // Hash password
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    
                    // Begin transaction
                    $pdo->beginTransaction();
                    
                    // Insert new user
                    $stmt = $pdo->prepare("INSERT INTO customer (name, email, phone, address, password) VALUES (?, ?, ?, ?, ?)");
                    $result = $stmt->execute([$name, $email, $phone, $address, $hashed_password]);
                      if ($result) {
                        // Commit transaction
                        $pdo->commit();
                        
                        // Auto-login after signup
                        $user_id = $pdo->lastInsertId();
                        $_SESSION['user_id'] = $user_id;
                        $_SESSION['name'] = $name;
                        $_SESSION['role'] = 'customer';
                        
                        header("Location: ../index.php");
                        exit;
                    } else {
                        // Rollback transaction
                        $pdo->rollBack();
                        $error = "Signup failed. Please try again.";
                    }
                }
            } catch (PDOException $e) {
                // Rollback transaction on error
                if ($pdo->inTransaction()) {
                    $pdo->rollBack();
                }
                $error = "Database error: " . $e->getMessage();
            }
        }
    }
}

// Get error from URL if present
if (isset($_GET['error'])) {
    switch ($_GET['error']) {
        case 'invalid_user':
            $error = "Invalid user account. Please login again.";
            break;
        case 'not_logged_in':
            $error = "Please login to access that page.";
            break;        default:
            $error = "An error occurred. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Crust Pizza - Sign Up / Login</title>
  <link rel="stylesheet" href="../css/style.css" />
</head>
<body>

<nav class="navbar">
  <div class="container">
    <h1 class="logo">🍕 Crust Pizza</h1>
    <ul>
      <li><a href="../index.php">Home</a></li>
      <li><a href="../customer/menu.php">Menu</a></li>
      <?php if (!isset($_SESSION['user_id'])): ?>
        <li><a href="signup_login.php">SignUp/Login</a></li>
      <?php else: ?>
        <li><a href="../logout.php">Logout</a></li>
        <?php if ($_SESSION['role'] === 'admin'): ?>
          <li><a href="../admin/dashboard.php">Admin Panel</a></li>
        <?php endif; ?>
      <?php endif; ?>
    </ul>
  </div>
</nav>

<section class="auth-container container">  <div class="auth-form">

    <?php if ($error): ?>
      <div class="error-message">
        <?= htmlspecialchars($error) ?>
      </div>
    <?php endif; ?>

    <?php if ($success): ?>
      <div class="success-message">
        <?= htmlspecialchars($success) ?>
      </div>
    <?php endif; ?>

    <!-- LOGIN FORM -->
    <div id="login-form">
      <h3>Login</h3>
      <form action="" method="POST" autocomplete="off">
        <div class="form-group">
          <label for="login-email">Email</label>
          <input type="email" id="login-email" name="email" placeholder="Your Email" required />
        </div>
        <div class="form-group">
          <label for="login-password">Password</label>
          <input type="password" id="login-password" name="password" placeholder="Your Password" required />
        </div>
        <button type="submit" name="login" class="btn">Login</button>
      </form>
      <p>Don't have an account?</p>
      <button class="toggle-button" id="toggle-signup">Sign Up</button>
    </div>    <!-- SIGNUP FORM -->
    <div id="signup-form" class="hidden">
      <h3>Sign Up</h3>
      <form action="" method="POST" autocomplete="off">
        <div class="form-group">
          <label for="signup-name">Full Name</label>
          <input type="text" id="signup-name" name="name" placeholder="Your Full Name" required />
        </div>        <div class="form-group">
          <label for="signup-email">Email</label>
          <input type="email" id="signup-email" name="email" placeholder="Your Email" required />
        </div>
        <div class="form-group">
          <label for="signup-phone">Phone</label>
          <input type="tel" id="signup-phone" name="phone" placeholder="Your Phone Number" required />
        </div>
        <div class="form-group">
          <label for="signup-address">Address</label>
          <input type="text" id="signup-address" name="address" placeholder="Your Address" required />
        </div>
        <div class="form-group">
          <label for="signup-password">Password</label>
          <input type="password" id="signup-password" name="password" placeholder="Password (minimum 6 characters)" required minlength="6" />
        </div>
        <div class="form-group">
          <label for="signup-password-confirm">Confirm Password</label>
          <input type="password" id="signup-password-confirm" name="password_confirm" placeholder="Confirm Password" required />
        </div>
        <button type="submit" name="signup" class="btn">Sign Up</button>
      </form>
      <p>Already have an account?</p>
      <button class="toggle-button active" id="toggle-login">Login</button>
    </div>
  </div>
</section>

<footer class="footer">
  <p>&copy; <?= date('Y') ?> Crust Pizza | Built for DWIN309 | Kent Institute Australia</p>
</footer>

<script>
  const loginForm = document.getElementById('login-form');
  const signupForm = document.getElementById('signup-form');
  const toggleLoginButton = document.getElementById('toggle-login');
  const toggleSignupButton = document.getElementById('toggle-signup');
  
  // Password validation
  const password = document.getElementById('signup-password');
  const confirmPassword = document.getElementById('signup-password-confirm');
  
  // Show login form initially
  signupForm.classList.add('hidden');
  loginForm.classList.remove('hidden');

  toggleLoginButton.addEventListener('click', () => {
    loginForm.classList.remove('hidden');
    signupForm.classList.add('hidden');
    toggleLoginButton.classList.add('active');
    toggleSignupButton.classList.remove('active');
  });

  toggleSignupButton.addEventListener('click', () => {
    signupForm.classList.remove('hidden');
    loginForm.classList.add('hidden');
    toggleSignupButton.classList.add('active');
    toggleLoginButton.classList.remove('active');
  });
  
  // Check if passwords match
  function validatePassword() {
    if(password.value != confirmPassword.value) {
      confirmPassword.setCustomValidity("Passwords don't match");
    } else {
      confirmPassword.setCustomValidity('');
    }
  }
  
  password.onchange = validatePassword;
  confirmPassword.onkeyup = validatePassword;
</script>

<style>
  .hidden { display: none; }
  .active { font-weight: bold; }
  
  .auth-container {
    max-width: 500px;
    margin: 50px auto;
    padding: 30px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 20px rgba(0,0,0,0.1);
  }
  
  .auth-form {
    padding: 20px;
  }
  
  .form-group {
    margin-bottom: 15px;
  }
  
  .form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    color: #333;
  }
  
  .auth-form input {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 16px;
  }
  
  .btn {
    background-color: #d84315;
    color: white;
    border: none;
    padding: 12px 20px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    width: 100%;
    margin-top: 10px;
  }
  
  .btn:hover {
    background-color: #bf360c;
  }
  
  .toggle-button {
    background: none;
    border: none;
    color: #d84315;
    cursor: pointer;
    font-size: 16px;
    padding: 5px;
    margin-top: 10px;
  }
  
  .toggle-button:hover {
    text-decoration: underline;
  }
  
  .error-message {
    background-color: #f8d7da;
    color: #721c24;
    padding: 10px 15px;
    margin-bottom: 20px;
    border-radius: 4px;
    border: 1px solid #f5c6cb;
  }
  
  .success-message {
    background-color: #d4edda;
    color: #155724;
    padding: 10px 15px;
    margin-bottom: 20px;
    border-radius: 4px;
    border: 1px solid #c3e6cb;
  }
</style>

</body>
</html>
