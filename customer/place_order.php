<?php
session_start();
include '../includes/db.php';

$user_id = $_SESSION['user_id'];
$delivery_type = $_POST['delivery_type'];
$total_price = 0;

// Calculate again to avoid manipulation
foreach ($_SESSION['cart'] as $item) {
    $pizza = $conn->query("SELECT * FROM pizzas WHERE id = {$item['pizza_id']}")->fetch_assoc();
    $price = $pizza['base_price'];

    if ($item['crust'] === 'medium') $price += 2;
    if ($item['crust'] === 'large') $price += 4;

    $ingredients = array_merge([$item['sauce']], $item['cheese'], $item['veg'], $item['nonveg']);
    if ($ingredients) {
        $ids = implode(",", $ingredients);
        $result = $conn->query("SELECT * FROM ingredients WHERE id IN ($ids)");
        while ($ing = $result->fetch_assoc()) {
            $price += $ing['price'];
        }
    }

    $subtotal = $price * $item['quantity'];
    $total_price += $subtotal;
}

// Insert order
$conn->query("INSERT INTO orders (user_id, total_price, delivery_type, status) VALUES ($user_id, $total_price, '$delivery_type', 'pending')");
$order_id = $conn->insert_id;

// Insert items
foreach ($_SESSION['cart'] as $item) {
    $pizza_id = $item['pizza_id'];
    $qty = $item['quantity'];
    $conn->query("INSERT INTO order_items (order_id, pizza_id, quantity) VALUES ($order_id, $pizza_id, $qty)");
}

unset($_SESSION['cart']);
echo "<p>Order placed successfully! <a href='menu.php'>Order More</a></p>";
