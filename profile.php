<?php 
session_start(); 

// Security: Redirect to login page if user is not logged in
if (!isset($_SESSION['user_id'])) {
  header("Location: customer/signup_login.php?error=not_logged_in");
  exit;
}

// Fetch user data from database
require_once 'config.php';
$userId = $_SESSION['user_id'];
$error = '';

// Prevent CSRF attacks by implementing token validation
if (!isset($_SESSION['csrf_token'])) {
  $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];

// Check for error message in session
if (isset($_SESSION['profile_error'])) {
  $error = $_SESSION['profile_error'];
  unset($_SESSION['profile_error']); // Clear the error after using it
}
// Check for error in URL parameter
elseif (isset($_GET['error'])) {
  $error = "An error occurred while updating your profile.";
}

try {
  $stmt = $pdo->prepare("SELECT * FROM customer WHERE customer_id = ?");
  $stmt->execute([$userId]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);
  
  if (!$user) {
    // User not found in database - security issue
    session_destroy();
    header("Location: customer/signup_login.php?error=invalid_user");
    exit;
  }
} catch (PDOException $e) {
  $error = "Database error: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Profile - Crust Pizza</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'partials/navbar.php'; ?>

<main class="container">
  <h2>My Profile</h2>
  
  <?php if (isset($error)): ?>
    <div class="error-message">
      <?php echo htmlspecialchars($error); ?>
    </div>
  <?php endif; ?>
  
  <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
    <div class="success-message">
      Profile updated successfully!
    </div>
  <?php endif; ?>
  <form action="update_profile.php" method="POST" class="form-box">
    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
    <div class="form-group">
      <label for="fullname">Full Name</label>
      <input type="text" id="fullname" name="fullname" value="<?php echo htmlspecialchars($user['name']); ?>" required>
    </div>
      <div class="form-group">
      <label for="email">Email</label>
      <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
    </div>
    
    <div class="form-group">
      <label for="phone">Phone</label>
      <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" required>
    </div>
    
    <div class="form-group">
      <label for="address">Address</label>
      <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($user['address']); ?>" required>
    </div>
    
    <div class="form-group">
      <label for="password">New Password (leave blank to keep current)</label>
      <input type="password" id="password" name="password" placeholder="New Password">
    </div>
    
    <button type="submit" class="btn">Update Profile</button>
  </form>
</main>

<?php include 'partials/footer.php'; ?>

</body>
</html>
