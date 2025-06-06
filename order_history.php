<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header('Location: customer/signup_login.php');
  exit();
}

require 'include/db_connection.php'; // Adjust based on your database connection file
$userId = $_SESSION['user_id'];

// Fetch orders
$orderQuery = $conn->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC");
$orderQuery->bind_param("i", $userId);
$orderQuery->execute();
$orderResult = $orderQuery->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Orders - Crust Pizza</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/order_history.css">
</head>
<body>

<?php include 'partials/navbar.php'; ?>

<main class="orders-container">
  <h1>My Orders</h1>

  <?php if ($orderResult->num_rows > 0): ?>
    <?php while ($order = $orderResult->fetch_assoc()): ?>
      <div class="order-card">
        <h2>Order #<?= $order['id'] ?> <span class="order-date"><?= date("d M Y, h:i A", strtotime($order['created_at'])) ?></span></h2>

        <table class="order-table">
          <thead>
            <tr>
              <th>Pizza</th>
              <th>Base</th>
              <th>Sauce</th>
              <th>Toppings</th>
              <th>Quantity</th>
              <th>Subtotal</th>
            </tr>
          </thead>
          <tbody>
          <?php
            $itemsQuery = $conn->prepare("SELECT * FROM order_items WHERE order_id = ?");
            $itemsQuery->bind_param("i", $order['id']);
            $itemsQuery->execute();
            $itemsResult = $itemsQuery->get_result();
            while ($item = $itemsResult->fetch_assoc()):
          ?>
            <tr>
              <td><?= htmlspecialchars($item['pizza_name']) ?></td>
              <td><?= htmlspecialchars($item['base']) ?></td>
              <td><?= htmlspecialchars($item['sauce']) ?></td>
              <td><?= htmlspecialchars($item['toppings']) ?: 'None' ?></td>
              <td><?= (int)$item['quantity'] ?></td>
              <td>$<?= number_format($item['price'], 2) ?></td>
            </tr>
          <?php endwhile; ?>
          </tbody>
        </table>

        <div class="order-total">
          <strong>Total:</strong> $<?= number_format($order['total_amount'], 2) ?>
        </div>
      </div>
    <?php endwhile; ?>
  <?php else: ?>
    <p class="no-orders">You haven’t placed any orders yet. <a href="customer/menu.php" class="btn-order">Order Now</a></p>
  <?php endif; ?>

</main>

<?php include 'partials/footer.php'; ?>
</body>
</html>
