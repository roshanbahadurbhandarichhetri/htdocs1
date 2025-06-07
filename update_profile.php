<?php
session_start();

// Security: Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
  header("Location: customer/signup_login.php?error=not_logged_in");
  exit;
}

require_once 'config.php';

$userId = $_SESSION['user_id'];
$error = '';
$success = false;

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Verify CSRF token
  if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    $_SESSION['profile_error'] = "Security validation failed. Please try again.";
    header("Location: profile.php?error=csrf");
    exit;
  }
  
  // Validate and sanitize input
  $fullname = trim(filter_input(INPUT_POST, 'fullname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
  $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
  $phone = trim(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
  $address = trim(filter_input(INPUT_POST, 'address', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
  $password = $_POST['password'] ?? '';
  
  // Validate inputs
  if (empty($fullname) || empty($email) || empty($phone) || empty($address)) {
    $error = "Name, email, phone and address are required.";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = "Please enter a valid email address.";
  } else {
    try {
      // Begin transaction
      $pdo->beginTransaction();
      
      // Check if email exists for another user
      $stmt = $pdo->prepare("SELECT customer_id FROM customer WHERE email = ? AND customer_id != ?");
      $stmt->execute([$email, $userId]);
      if ($stmt->fetch()) {
        $error = "This email is already used by another account.";
        $pdo->rollBack();
      } else {
        // Update profile
        if (!empty($password)) {
          // Update with password
          if (strlen($password) < 6) {
            $error = "Password must be at least 6 characters long.";
            $pdo->rollBack();
          } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("UPDATE customer SET name = ?, email = ?, phone = ?, address = ?, password = ? WHERE customer_id = ?");
            $stmt->execute([$fullname, $email, $phone, $address, $hashed_password, $userId]);
          }
        } else {
          // Update without changing password
          $stmt = $pdo->prepare("UPDATE customer SET name = ?, email = ?, phone = ?, address = ? WHERE customer_id = ?");
          $stmt->execute([$fullname, $email, $phone, $address, $userId]);
        }
        
        if (!$error) {
          // Update session data
          $_SESSION['name'] = $fullname;
          
          // Commit transaction
          $pdo->commit();
          
          // Redirect to profile with success message
          header("Location: profile.php?success=1");
          exit;
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

// If there was an error, redirect back to profile with error
if ($error) {
  $_SESSION['profile_error'] = $error;
  header("Location: profile.php?error=1");
  exit;
}
?>