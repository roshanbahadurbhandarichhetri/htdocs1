<?php
session_start();

// Check if the request is POST and index and quantity are set
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['index']) && isset($_POST['quantity'])) {
    $index = intval($_POST['index']);
    $quantity = max(1, intval($_POST['quantity'])); // Ensure quantity is at least 1
    
    // Ensure cart exists and index is valid
    if (isset($_SESSION['cart']) && is_array($_SESSION['cart']) && isset($_SESSION['cart'][$index])) {
        // Update quantity
        $_SESSION['cart'][$index]['quantity'] = $quantity;
        
        // Recalculate price if needed
        if (isset($_SESSION['cart'][$index]['price_per_unit'])) {
            $_SESSION['cart'][$index]['price'] = $_SESSION['cart'][$index]['price_per_unit'] * $quantity;
        }
        
        // Set confirmation message
        $_SESSION['cart_message'] = "Quantity updated!";
    }
}

// Redirect back to cart
header('Location: cart.php');
exit;
?>
