<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />  <title>Your Cart - Crust Pizza</title>
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/cart.css" />
  <link rel="stylesheet" href="css/cart-extras.css" />
</head>
<body>

<?php include 'partials/navbar.php'; ?>

<main class="cart-container">
  <h1>Your Cart</h1>
  
  <?php if (isset($_SESSION['cart']) && is_array($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>

    <form method="POST" action="remove_from_cart.php">
    <table class="cart-table">      <thead>
        <tr>
          <th>Pizza</th>
          <th>Size</th>
          <th>Base</th>
          <th>Sauce</th>
          <th>Toppings</th>
          <th>Quantity</th>
          <th>Price</th>
          <th>Action</th>
        </tr>
      </thead>      <tbody>
        <?php 
          $grandTotal = 0;
          foreach ($_SESSION['cart'] as $index => $item): 
            if (!is_array($item)) continue;
            $itemTotal = floatval($item['price']) * intval($item['quantity']);
            $grandTotal += $itemTotal;
        ?>          <tr>            
            <td><?= htmlspecialchars($item['name']) ?></td>
            <td><?= htmlspecialchars($item['size'] ?? 'Medium') ?></td>
            <td><?= htmlspecialchars($item['base']) ?></td>
            <td><?= htmlspecialchars($item['sauce']) ?></td>            <td>
              <?php if (isset($item['toppings']) && is_array($item['toppings']) && !empty($item['toppings'])): ?>
                <div class="toppings-list">
                  <?= htmlspecialchars(implode(', ', $item['toppings'])) ?>
                </div>
              <?php else: ?>
                None
              <?php endif; ?>
            </td>
            <td>
              <form method="POST" action="update_quantity.php" class="quantity-update-form">
                <input type="hidden" name="index" value="<?= $index ?>">
                <select name="quantity" onchange="this.form.submit()">
                  <?php for ($i = 1; $i <= 10; $i++): ?>
                    <option value="<?= $i ?>" <?= $item['quantity'] == $i ? 'selected' : '' ?>><?= $i ?></option>
                  <?php endfor; ?>
                </select>
              </form>
            </td>
            <td>$<?= number_format(floatval($item['price']), 2) ?></td>
            <td>
              <button type="submit" name="remove" value="<?= $index ?>" class="btn-remove">Remove</button>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    </form>    <div class="cart-total">
      <strong>Total:</strong> $<?= number_format($grandTotal, 2) ?>
    </div>

    <div class="cart-actions">
      <form method="POST" action="clear_cart.php" onsubmit="return confirm('Are you sure you want to clear your cart?');">
        <button type="submit" class="btn-clear">Clear Cart</button>
      </form>
      
      <a href="customer/menu.php" class="btn-continue">Continue Shopping</a>
      
      <a href="checkout.php" class="btn-checkout">Proceed to Checkout</a>
    </div>

  <?php else: ?>
    <div class="empty-cart-message">
      <p>Your cart is currently empty.</p>
      <a href="customer/menu.php" class="btn-browse">🍕 Browse Menu</a>
    </div>
  <?php endif; ?>

</main>

<?php include 'partials/footer.php'; ?>

</body>
</html>
