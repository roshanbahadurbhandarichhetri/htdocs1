<?php 
session_start();
require_once 'include/db.php';

// Initialize variables
$name = $email = $message = "";
$nameErr = $emailErr = $messageErr = "";
$success = false;
$error = false;

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Validate name
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = filter_var($_POST["name"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  }
  
  // Validate email
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }
  
  // Validate message
  if (empty($_POST["message"])) {
    $messageErr = "Message is required";
  } else {
    $message = filter_var($_POST["message"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  }
  
  // If no errors, proceed with storing the contact message
  if (empty($nameErr) && empty($emailErr) && empty($messageErr)) {
    // Check if contacts table exists, if not create it
    $checkTable = "SHOW TABLES LIKE 'contacts'";
    $tableExists = $conn->query($checkTable);
    
    if ($tableExists->num_rows == 0) {
      // Create the contacts table
      $createTable = "CREATE TABLE contacts (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        message TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
      )";
      
      $conn->query($createTable);
    }
    
    // Insert message into database
    $stmt = $conn->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);
    
    if ($stmt->execute()) {
      $success = true;
      // Reset form fields after successful submission
      $name = $email = $message = "";
    } else {
      $error = "Sorry, there was an error sending your message. Please try again.";
    }
    
    $stmt->close();
  } else {
    $error = "Please fix the errors in the form.";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Contact Us - Crust Pizza</title>
  <!-- Link only global CSS and contact-specific CSS -->
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/contact.css" />
  <style>
    .error-text { color: #dc3545; font-size: 0.9em; margin-top: -10px; margin-bottom: 10px; }
    .success-message { background: #d4edda; color: #155724; padding: 10px; border-radius: 4px; margin-bottom: 20px; }
    .error-message { background: #f8d7da; color: #721c24; padding: 10px; border-radius: 4px; margin-bottom: 20px; }
  </style>
</head>
<body>

<?php include 'partials/navbar.php'; ?>

<main class="contact-container" role="main">
  <h2>Contact Us</h2>
  <p>We'd love to hear from you! Reach out using the form below or via phone/email.</p>

  <?php if ($success): ?>
  <div class="success-message">
    <p>Thank you for your message! We'll get back to you as soon as possible.</p>
  </div>
  <?php endif; ?>
  
  <?php if ($error): ?>
  <div class="error-message">
    <p><?php echo $error; ?></p>
  </div>
  <?php endif; ?>

  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="form-box" aria-label="Contact form">
    <label for="name">Your Name</label>
    <input type="text" id="name" name="name" placeholder="Your Name" value="<?php echo htmlspecialchars($name); ?>" required>
    <?php if (!empty($nameErr)): ?><p class="error-text"><?php echo $nameErr; ?></p><?php endif; ?>

    <label for="email">Your Email</label>
    <input type="email" id="email" name="email" placeholder="Your Email" value="<?php echo htmlspecialchars($email); ?>" required>
    <?php if (!empty($emailErr)): ?><p class="error-text"><?php echo $emailErr; ?></p><?php endif; ?>

    <label for="message">Your Message</label>
    <textarea id="message" name="message" placeholder="Your Message" rows="5" required><?php echo htmlspecialchars($message); ?></textarea>
    <?php if (!empty($messageErr)): ?><p class="error-text"><?php echo $messageErr; ?></p><?php endif; ?>

    <button type="submit" class="btn send-btn">Send Message</button>
  </form>

  <section class="contact-info" aria-labelledby="contact-details-title">
    <h3 id="contact-details-title">Our Contact Details</h3>
    <p>📞 <a href="tel:1300123456">1300 123 456</a></p>
    <p>📍 123 Pizza Street, Sydney NSW</p>
    <p>📧 <a href="mailto:support@crustpizza.com.au">support@crustpizza.com.au</a></p>
  </section>
</main>

<?php include 'partials/footer.php'; ?>

</body>
</html>
