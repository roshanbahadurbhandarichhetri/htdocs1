<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<style>
  .cart-link {
    position: relative;
    display: inline-block;
  }
  
  .cart-count {
    position: absolute;
    top: -8px;
    right: -8px;
    background-color: #e74c3c;
    color: white;
    font-size: 0.7em;
    padding: 2px 6px;
    border-radius: 50%;
    font-weight: bold;
  }
</style>
<nav class="navbar">
  <div class="container">
    <h1 class="logo">🍕 Crust Pizza</h1>
    <ul>
      <li><a href="/index.php">Home</a></li>
      <li><a href="/about.php">About</a></li>
      <li><a href="/contact.php">Contact</a></li>      <li><a href="/customer/menu.php">Menu</a></li>
      <li><a href="/customer/customize.php">Customize</a></li>
      <li>
        <a href="/cart.php" class="cart-link">
          🛒
          <?php 
          $cartCount = 0;
          if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $item) {
              if (is_array($item)) {
                $cartCount += intval($item['quantity'] ?? 1);
              }
            }
          }
          if ($cartCount > 0): 
          ?>
            <span class="cart-count"><?= $cartCount ?></span>
          <?php endif; ?>
        </a>      </li>
      <?php if (isset($_SESSION['user_id'])): ?>
        <li><a href="/order_history.php">Orders</a></li>
        <li><a href="/profile.php">Profile</a></li>
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
          <li><a href="/admin/dashboard.php">Admin Panel</a></li>
        <?php endif; ?>
        <li><a href="/logout.php">Logout</a></li>
      <?php else: ?>
        <li><a href="/customer/signup_login.php">SignUp/Login</a></li>
      <?php endif; ?>
    </ul>
  </div>
</nav>
