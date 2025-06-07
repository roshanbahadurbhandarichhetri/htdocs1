<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Define your menu items data here or fetch from DB
    $menuItems = [
        'Peri Peri Chicken' => [
            'base' => 'Regular',
            'sauce' => 'Tomato',
            'toppings' => ['House Cooked Chicken', 'Roasted Capsicum', 'Caramelised Onions', 'Mozzarella', 'Shallots', 'Bocconcini'],
            'price' => [
                'Small' => 14.99,
                'Medium' => 16.99,
                'Large' => 18.99
            ],
        ],
        'Meat Deluxe' => [
            'base' => 'Regular',
            'sauce' => 'BBQ',
            'toppings' => ['Smoked Ham', 'Pepperoni', 'Italian Sausage', 'House Cooked Chicken', 'Ground Beef', 'Bacon', 'Mozzarella'],
            'price' => [
                'Small' => 14.99,
                'Medium' => 16.99,
                'Large' => 18.99
            ],
        ],
        'Crust Supreme' => [
            'base' => 'Regular',
            'sauce' => 'Tomato',
            'toppings' => ['Smoked Ham', 'Pepperoni', 'Italian Sausage', 'Mozzarella', 'Mushrooms', 'Fresh Capsicum', 'Spanish Onions', 'Pineapple', 'Kalamata Olives'],
            'price' => [
                'Small' => 14.99,
                'Medium' => 16.99,
                'Large' => 18.99
            ],
        ],
        'Vegetarian Supreme' => [
            'base' => 'Regular',
            'sauce' => 'Tomato',
            'toppings' => ['Grilled Eggplant', 'Marinated Artichokes', 'Baby Spinach', 'Roasted Capsicum', 'Mushrooms', 'Sundried Tomatoes', 'Mozzarella', 'Bocconcini'],
            'price' => [
                'Small' => 13.99,
                'Medium' => 15.99,
                'Large' => 17.99
            ],
        ],
        'BBQ Chicken' => [
            'base' => 'Regular',
            'sauce' => 'BBQ',
            'toppings' => ['House Cooked Chicken', 'Mozzarella', 'Mushrooms', 'Spanish Onions', 'Shallots'],
            'price' => [
                'Small' => 14.99,
                'Medium' => 16.99,
                'Large' => 18.99
            ],
        ],
        'Pepperoni' => [
            'base' => 'Regular',
            'sauce' => 'Tomato',
            'toppings' => ['Pepperoni', 'Spanish Onions', 'Fresh Capsicum', 'House Cooked Ground Beef', 'Mozzarella', 'Garlic'],
            'price' => [
                'Small' => 13.99,
                'Medium' => 15.99,
                'Large' => 17.99
            ],
        ],
        'Pesto Chicken Club' => [
            'base' => 'Regular',
            'sauce' => 'Tomato & Garlic',
            'toppings' => ['House Cooked Chicken Breast Fillets', 'Prosciutto', 'Mozzarella', 'Spanish Onions', 'Fresh Tomatoes', 'Fresh Avocado', 'Wild Rocket', 'Pesto Aioli'],
            'price' => [
                'Small' => 15.99,
                'Medium' => 17.99,
                'Large' => 19.99
            ],
        ],
        '1889 Margherita' => [
            'base' => 'Regular',
            'sauce' => 'Tomato',
            'toppings' => ['Bocconcini', 'Cherry Tomatoes', 'Fresh Basil', 'Cracked Pepper', 'Sea Salt'],
            'price' => [
                'Small' => 12.99,
                'Medium' => 14.99,
                'Large' => 16.99
            ],
        ],
        'Mediterranean Lamb' => [
            'base' => 'Garlic Infused',
            'sauce' => 'Tomato',
            'toppings' => ['House Cooked Lamb', 'Mozzarella', 'Tomatoes', 'Green Capsicum', 'Spanish Onions', 'Feta', 'Oregano', 'Mint Yoghurt'],
            'price' => [
                'Small' => 15.99,
                'Medium' => 17.99,
                'Large' => 19.99
            ],
        ],
        'Vietnamese Chilli Chicken' => [
            'base' => 'Regular',
            'sauce' => 'Tomato, Hoisin, Sweet Chilli and Garlic',
            'toppings' => ['House Cooked Chicken', 'Shallots', 'Mozzarella', 'Slaw', 'Fresh Coriander', 'Chilli', 'Coriander Aioli'],
            'price' => [
                'Small' => 15.99,
                'Medium' => 17.99,
                'Large' => 19.99
            ],
        ],
        'Garlic Prawn' => [
            'base' => 'Regular',
            'sauce' => 'Tomato',
            'toppings' => ['Garlic Marinated Prawns', 'Sundried Tomatoes', 'Shallots', 'Mozzarella', 'Roasted Capsicum', 'Feta', 'Fresh Herbs', 'Lemon'],
            'price' => [
                'Small' => 16.99,
                'Medium' => 18.99,
                'Large' => 20.99
            ],
        ],
        'Peri Peri (not) Chicken' => [
            'base' => 'Regular',
            'sauce' => 'Tomato',
            'toppings' => ['Plant Based Chicken', 'Roasted Capsicum', 'Caramelised Onions', 'Mozzarella', 'Shallots', 'Bocconcini', 'Peri Peri Sauce'],
            'price' => [
                'Small' => 15.99,
                'Medium' => 17.99,
                'Large' => 19.99
            ],
        ],
        'Veg Beef Royale' => [
            'base' => 'Regular',
            'sauce' => 'Tomato',
            'toppings' => ['Seasoned Plant Based Mince', 'Roasted Heirloom Tomatoes', 'Sliced Onion', 'Mozzarella', 'Burger sauce', 'Pickles'],
            'price' => [
                'Small' => 15.99,
                'Medium' => 17.99,
                'Large' => 19.99
            ],
        ],
        'Moroccan Lamb' => [
            'base' => 'Regular',
            'sauce' => 'Tomato',
            'toppings' => ['House Cooked Lamb', 'Mozzarella', 'Spanish Onions', 'Baby Spinach', 'Mint Yoghurt', 'Lemon'],
            'price' => [
                'Small' => 15.99,
                'Medium' => 17.99,
                'Large' => 19.99
            ],
        ],
        'Truffle Beef Rossini' => [
            'base' => 'Regular',
            'sauce' => 'Garlic',
            'toppings' => ['Premium Beef', 'Wild Mushroom medley', 'Mozzarella', 'Caramelised Onions', 'Fresh Parsley', 'Basil', 'Bocconcini', 'Black Truffle Aioli'],
            'price' => [
                'Small' => 16.99,
                'Medium' => 18.99,
                'Large' => 20.99
            ],
        ],
        'Pulled Pork and Slaw' => [
            'base' => 'Regular',
            'sauce' => 'BBQ',
            'toppings' => ['Twice Cooked Shredded Pork', 'Mozzarella', 'Caramelised Onions', 'Fresh Pear', 'Slaw', 'Garlic Aioli'],
            'price' => [
                'Small' => 15.99,
                'Medium' => 17.99,
                'Large' => 19.99
            ],
        ],
        'Hawaiian' => [
            'base' => 'Regular',
            'sauce' => 'Tomato',
            'toppings' => ['Ham', 'Pineapple', 'Mozzarella'],
            'price' => [
                'Small' => 12.99,
                'Medium' => 14.99,
                'Large' => 16.99
            ],
        ],
        'Classic Margherita' => [
            'base' => 'Regular',
            'sauce' => 'Tomato',
            'toppings' => ['Mozzarella', 'Oregano'],
            'price' => [
                'Small' => 11.99,
                'Medium' => 13.99,
                'Large' => 15.99
            ],
        ],
        'Capricciosa' => [
            'base' => 'Regular',
            'sauce' => 'Tomato',
            'toppings' => ['Ham', 'Mushroom', 'Olives', 'Mozzarella'],
            'price' => [
                'Small' => 12.99,
                'Medium' => 14.99,
                'Large' => 16.99
            ],
        ],
        // Sides
        'Garlic Bread' => [
            'base' => 'N/A',
            'sauce' => 'N/A',
            'toppings' => ['Herb & Garlic Butter'],
            'price' => [
                'Small' => 8.99,
                'Medium' => 8.99,
                'Large' => 8.99
            ],
        ],
        'Oven Baked Chips' => [
            'base' => 'N/A',
            'sauce' => 'N/A',
            'toppings' => ['Crispy Oven Baked Chips'],
            'price' => [
                'Small' => 8.99,
                'Medium' => 8.99,
                'Large' => 8.99
            ],
        ],
        'Smokey BBQ Wings' => [
            'base' => 'N/A',
            'sauce' => 'BBQ',
            'toppings' => ['Succulent and juicy BBQ wings'],
            'price' => [
                'Small' => 10.99,
                'Medium' => 10.99,
                'Large' => 10.99
            ],
        ],
    ];    if (isset($_POST['name'])) {
        $name = $_POST['name'];
    } elseif (isset($_POST['item_name'])) {
        $name = $_POST['item_name'];
    } else {
        $name = 'Custom Pizza';
    }
    
    // Get selected size (default to Medium if not specified)
    $size = isset($_POST['size']) ? $_POST['size'] : 'Medium';
    
    // Fetch the correct price from the database based on the pizza name and size
    require_once 'include/db.php';
    
    // Default prices in case we can't find it in the database
    $defaultPrices = [
        'Small' => 15.99,
        'Medium' => 18.99,
        'Large' => 20.99
    ];
    
    $itemPrice = $defaultPrices[$size];
    
    // Map our size names to the database size codes
    $sizeMap = [
        'Small' => 'S',
        'Medium' => 'M',
        'Large' => 'L',
        'Extra Large' => 'X'
    ];
    
    $dbSize = $sizeMap[$size] ?? 'L';
    
    // Try to get the price from the database
    $stmt = $conn->prepare("SELECT base_price FROM pizza WHERE pizza_name = ? AND size = ?");
    $stmt->bind_param("ss", $name, $dbSize);
    $stmt->execute();
    $result = $stmt->get_result();
      if ($result && $row = $result->fetch_assoc()) {
        $itemPrice = $row['base_price'];
    }
    
    // Prepare the item for cart
    if (isset($menuItems[$name])) {
        // Use menu item data for predefined pizzas
        $itemData = $menuItems[$name];
        $item = [
            'name' => $name,
            'base' => $itemData['base'],
            'sauce' => $itemData['sauce'],
            'toppings' => $itemData['toppings'],
            'size' => $size,
            'quantity' => max(1, intval($_POST['quantity'] ?? 1)),
            'price' => $itemPrice,
        ];
    } else {
        // Fallback for custom pizzas or incomplete data
        $item = [
            'name' => $name,
            'base' => $_POST['base'] ?? '',
            'sauce' => $_POST['sauce'] ?? '',
            'size' => $size,
            'toppings' => isset($_POST['toppings']) && is_array($_POST['toppings']) ? $_POST['toppings'] : [],
            'quantity' => max(1, intval($_POST['quantity'] ?? 1)),
            'price' => $itemPrice,
        ];
    }

    if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    
    $_SESSION['cart'][] = $item;
    
    // Set a success message in session
    $_SESSION['cart_message'] = "{$item['name']} ({$item['size']}) has been added to your cart!";
    
    // Redirect back to the referring page instead of cart
    $referer = $_SERVER['HTTP_REFERER'] ?? 'customer/menu.php';
    header("Location: $referer");
    exit;
} else {
    echo "Invalid request.";
}
?>
