<?php
session_start();

$deliveryOption = $_SESSION['deliveryOption'] ?? 'delivery'; // Default fallback
unset($_SESSION['deliveryOption']); // Clear after use
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Order Confirmation</title>
  <link rel="stylesheet" href="css/style.css">
  <style>
    .popup-overlay {
      position: fixed;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background: rgba(0,0,0,0.6);
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 1000;
    }

    .popup-box {
      background: #fff;
      padding: 30px;
      border-radius: 12px;
      max-width: 400px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.3);
      text-align: center;
    }

    .popup-box h2 {
      margin-bottom: 15px;
      color: #2e7d32;
    }

    .popup-box p {
      font-size: 1.1rem;
      margin-bottom: 20px;
    }

    .popup-box a {
      text-decoration: none;
      background-color: #2e7d32;
      color: #fff;
      padding: 10px 20px;
      border-radius: 8px;
      font-weight: bold;
    }

    .popup-box a:hover {
      background-color: #388e3c;
    }
  </style>
</head>
<body>

<?php include 'partials/navbar.php'; ?>

<div class="popup-overlay">
  <div class="popup-box">
    <h2>Order Placed Successfully!</h2>
    <?php if ($deliveryOption === 'pickup'): ?>
      <p>You selected <strong>Pickup</strong>. Please visit the store in the next 30 minutes.</p>
    <?php else: ?>
      <p>You selected <strong>Delivery</strong>. Your order will arrive in 45–60 minutes.</p>
    <?php endif; ?>
    <a href="index.php">Go to Home</a>
  </div>
</div>

<?php include 'partials/footer.php'; ?>

</body>
</html>
