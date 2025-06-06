<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove'])) {
    $index = intval($_POST['remove']);

    if (isset($_SESSION['cart'][$index])) {
        unset($_SESSION['cart'][$index]);

        // Reindex to avoid gaps
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }
}

header('Location: cart.php');
exit;
?>
