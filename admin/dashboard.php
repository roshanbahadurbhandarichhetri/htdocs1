<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header("Location: ../customer/menu.php");
    exit;
}
?>

<h1>Admin Dashboard</h1>
<p>Welcome, <?php echo $_SESSION['name']; ?> | <a href="../logout.php">Logout</a></p>
