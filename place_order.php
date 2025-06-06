<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $deliveryOption = $_POST['deliveryOption'] ?? 'delivery';

    // Save choice to session for use on the next page
    $_SESSION['deliveryOption'] = $deliveryOption;

    // [Insert your existing order processing logic here]

    // Redirect to confirmation page
    header("Location: order_confirmation.php");
    exit();
}
?>
