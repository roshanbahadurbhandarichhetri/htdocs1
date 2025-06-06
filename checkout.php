<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Checkout - Crust Pizza</title>
  <link rel="stylesheet" href="css/style.css">
  <style>
    .notice-popup {
      display: none;
      position: fixed;
      top: 30%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: #fff8e1;
      border: 2px solid #ff9800;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.3);
      z-index: 1000;
      max-width: 400px;
      text-align: center;
    }

    .notice-popup p {
      margin-bottom: 20px;
      font-size: 1rem;
      color: #333;
    }

    .notice-popup button {
      background-color: #b71c1c;
      color: white;
      padding: 8px 16px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
    }

    .notice-popup button:hover {
      background-color: #d32f2f;
    }

    .pickup-delivery-options {
      margin-bottom: 20px;
    }

    .pickup-delivery-options label {
      margin-right: 20px;
      font-weight: 500;
    }
  </style>
</head>
<body>

<?php include 'partials/navbar.php'; ?>

<main class="container">
  <h2>Checkout</h2>

  <!-- Pickup/Delivery Option -->
  <div class="pickup-delivery-options">
    <label><input type="radio" name="deliveryOption" value="pickup" required> Pickup</label>
    <label><input type="radio" name="deliveryOption" value="delivery"> Delivery</label>
  </div>

  <!-- Popup Notice -->
  <div id="noticePopup" class="notice-popup">
    <p id="popupMessage"></p>
    <button id="confirmButton">OK</button>
  </div>

  <form id="checkoutForm" action="place_order.php" method="POST" class="form-box">
    <h3>Shipping Info</h3>
    <input type="text" name="fullname" placeholder="Full Name" required>
    <input type="text" name="address" placeholder="Delivery Address" required>
    <input type="text" name="phone" placeholder="Phone Number" required>

    <h3>Payment</h3>
    <input type="text" name="card" placeholder="Card Number" required>
    <input type="text" name="expiry" placeholder="Expiry (MM/YY)" required>
    <input type="text" name="cvv" placeholder="CVV" required>

    <button type="submit" class="btn">Place Order</button>
  </form>
</main>

<?php include 'partials/footer.php'; ?>

<script>
  const form = document.getElementById('checkoutForm');
  const popup = document.getElementById('noticePopup');
  const message = document.getElementById('popupMessage');
  const confirmButton = document.getElementById('confirmButton');

  let deliveryChoice = null;

  form.addEventListener('submit', function(e) {
    e.preventDefault(); // prevent actual submission

    // Check which radio is selected
    const selectedOption = document.querySelector('input[name="deliveryOption"]:checked');
    if (!selectedOption) {
      alert('Please select Pickup or Delivery.');
      return;
    }

    deliveryChoice = selectedOption.value;

    if (deliveryChoice === 'pickup') {
      message.textContent = 'You have selected Pickup. Please arrive at the store within 30 minutes after placing your order.';
    } else if (deliveryChoice === 'delivery') {
      message.textContent = 'You have selected Delivery. Your order will be delivered within 45–60 minutes.';
    }

    popup.style.display = 'block';
  });

  confirmButton.addEventListener('click', function() {
    popup.style.display = 'none';
    form.submit(); // Now submit for real
  });
</script>

</body>
</html>
