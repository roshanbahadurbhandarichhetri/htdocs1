<footer class="footer" style="background-color: #f9f9f9; padding: 20px; text-align: center; font-size: 14px; color: #333;">

  <!-- Group and Course Info -->
  <p>
    &copy; <?= date('Y') ?> Crust Pizza | Built for the final assessment of <strong>DWIN309</strong> at Kent Institute Australia.
  </p>
  <p>
    Group Members: 
    Thais dos Santos Vieira (K231629), 
    Jen Raven Ganga (K231898), 
    Anita Gaire (K231558), 
    Nishma Dhungana (K231421)
  </p>

  <hr style="margin: 15px 0;">

  <!-- Contact and Social Info -->
  <p><strong>Contact Us</strong></p>
  <p>Email: <a href="mailto:crustsupport@example.com">crustsupport@example.com</a> | 
     Phone: +61 2 1234 5678</p>
  <p>
    Follow us:
    <a href="https://facebook.com" target="_blank">Facebook</a> |
    <a href="https://instagram.com" target="_blank">Instagram</a> |
    <a href="https://twitter.com" target="_blank">Twitter</a>
  </p>

  <hr style="margin: 15px 0;">

  <!-- Site Map for Public Pages -->
  <p><strong>Site Map:</strong></p>
  <p>
    <a href="/index.php">Home</a> |
    <a href="/about.php">About</a> |
    <a href="/contact.php">Contact</a> |
    <a href="/menu.php">Menu</a> |
    <a href="/customize.php">Customize Pizza</a> |
    <a href="/cart.php">Cart</a> |
    <a href="/orders.php">My Orders</a> |
    <a href="/profile.php">My Profile</a> |
    <a href="/signup.php">Sign Up</a> |
    <a href="/login.php">Login</a> |
    <a href="/staff/loginStaff.php">Staff Login 🔒</a>
  </p>

  <!-- Conditional Staff Links - only visible if staff is logged in -->
  <?php if (isset($_SESSION['employee_id'])): ?>
    <hr style="margin: 15px 0;">
    <p><strong>Staff Tools:</strong></p>
    <p>
      <a href="/staff/admin/admin.php">Admin Panel</a> |
      <a href="/staff/admin/counter.php">Staff HomePage</a> |
      <a href="/staff/kitchen.php">Orders</a> |
      <a href="/staff/delivery.php">Delivery Panel</a> |
      <a href="/staff/admin/pizza.php">Menu Management</a> |
      <a href="/staff/inventory.php">Inventory</a> |
      <a href="/staff/logout.php">Logout</a>
    </p>
  <?php endif; ?>

</footer>