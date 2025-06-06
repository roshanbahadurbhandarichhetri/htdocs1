<?php
session_start();

// Initialize cart if not set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Menu - Crust Pizza</title>
  <link rel="stylesheet" href="../css/style.css" />
  <link rel="stylesheet" href="../css/menu.css" />
  <style>
    /* Notification styles */
    .notification {
      position: fixed;
      top: 20px;
      right: 20px;
      background-color: #4CAF50;
      color: white;
      padding: 15px 20px;
      border-radius: 5px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.2);
      z-index: 1000;
      animation: fadeIn 0.5s, fadeOut 0.5s 3.5s forwards;
      max-width: 300px;
    }
    
    .close-notification {
      cursor: pointer;
      float: right;
      font-weight: bold;
      margin-left: 10px;
    }
    
    @keyframes fadeIn {
      from {opacity: 0; transform: translateY(-10px);}
      to {opacity: 1; transform: translateY(0);}
    }
    
    @keyframes fadeOut {
      from {opacity: 1; transform: translateY(0);}
      to {opacity: 0; transform: translateY(-10px);}
    }
    
    /* Size selection styles */
    .size-select {
      margin: 10px 0;
      width: 100%;
      padding: 8px;
      border-radius: 4px;
      border: 1px solid #ddd;
    }
      .add-to-cart-form {
      display: flex;
      flex-direction: column;
    }
    
    .quantity-selector {
      display: flex;
      align-items: center;
      margin: 8px 0;
    }
    
    .quantity-selector label {
      margin-right: 8px;
      font-weight: bold;
    }
    
    .quantity-select {
      padding: 6px;
      border-radius: 4px;
      border: 1px solid #ddd;
      width: 60px;
    }
      /* Improve notification styling */
    .notification {
      position: fixed;
      top: 20px;
      right: 20px;
      background-color: #27ae60;
      color: white;
      padding: 15px 20px;
      border-radius: 5px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.2);
      z-index: 1000;
      animation: fadeIn 0.5s;
      max-width: 300px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    
    .cart-icon {
      font-size: 1.2em;
      margin-right: 10px;
      display: inline-block;
      animation: bounce 0.6s ease-in-out;
    }
    
    @keyframes bounce {
      0%, 20%, 50%, 80%, 100% {transform: translateY(0);}
      40% {transform: translateY(-10px);}
      60% {transform: translateY(-5px);}
    }
    
    .close-notification {
      cursor: pointer;
      font-weight: bold;
      margin-left: 10px;
      font-size: 1.2em;
    }
  </style>
</head>
<body>

<?php include '../partials/navbar.php'; ?>

<!-- Display notification if set -->
<?php if (isset($_SESSION['cart_message'])): ?>
  <div class="notification" id="cart-notification">
    <div>
      <span class="cart-icon">🛒</span>
      <?= htmlspecialchars($_SESSION['cart_message']) ?>
    </div>
    <span class="close-notification" onclick="this.parentElement.style.display='none';">&times;</span>
  </div>
  <script>
    // Auto-hide notification after 4 seconds
    setTimeout(function() {
      var notification = document.getElementById('cart-notification');
      if (notification) {
        notification.style.animation = 'fadeOut 0.5s forwards';
        setTimeout(function() {
          notification.style.display = 'none';
        }, 500);
      }
    }, 4000);
  </script>
  <?php unset($_SESSION['cart_message']); ?>
<?php endif; ?>

<main class="menu-container" role="main">
  <h1>Crust Pizza Menu</h1>

  <section class="pizza-section">
    <h2>Pizzas</h2>

    <?php
    $pizzas = [
      ["Peri Peri Chicken", "periperi.png", "XL: 7640kJ | CC: 8070kJ | L: 5690kJ | GF: 6020kJ | HP: 5210kJ", "GMEHWGF*", "House Cooked Chicken, Roasted Capsicum, Caramelised Onions, Mozzarella, Shallots and Bocconcini on a Tomato base, topped with Peri-Peri sauce"],
      ["Meat Deluxe", "meatdeluxe.png", "XL: 7110kJ | CC: 8000kJ | L: 5140kJ | GF: 5570kJ | HP: 4920kJ", "GMWGF*", "Smoked Ham, Pepperoni, Italian Sausage, House Cooked Chicken & Ground Beef and Bacon and Mozzarella on a BBQ base"],
      ["Crust Supreme", "crustsupreme.png", "XL: 6170kJ | CC: 6660kJ | L: 4450kJ | GF: 4840kJ | HP: 4300kJ", "GMWGF*", "Smoked Ham, Pepperoni, Italian Sausage, Mozzarella, Mushrooms, Fresh Capsicum, Spanish Onions, Pineapple & Kalamata Olives on a Tomato base"],
      ["Vegetarian Supreme", "vegsupreme.png", "XL: 6240kJ | CC: 6670kJ | L: 4650kJ | GF: 4980kJ | HP: 4480kJ", "GMTNUTSEWGF*", "Grilled Eggplant, Marinated Artichokes, Baby Spinach, Roasted Capsicum, Mushrooms, Sundried Tomatoes, Mozzarella & Bocconcini on a Tomato base, topped with Pesto Aioli"],
      ["BBQ Chicken", "bbqchicken.png", "XL: 6580kJ | CC: 7360kJ | L: 4830kJ | GF: 5410kJ | HP: 4710kJ", "GMWGF*", "House Cooked Chicken, Mozzarella, Mushrooms, Spanish Onions & Shallots on a BBQ base (Feta optional)"],
      ["Pepperoni", "pepperoni.png", "XL: 6640kJ | CC: 7060kJ | L: 4940kJ | GF: 5140kJ | HP: 4610kJ", "GMWGF*", "Pepperoni, Spanish Onions, Fresh Capsicum, House Cooked Ground Beef, Mozzarella & Garlic on a Tomato base"],
      ["Pesto Chicken Club", "pestochicken.png", "XL: 7580kJ | CC: 8000kJ | L: 5770kJ | GF: 6090kJ | HP: 5600kJ", "GMEWGF*", "House Cooked Chicken Breast Fillets, Thinly Sliced Prosciutto, Mozzarella, Spanish Onions & Fresh Tomatoes on a Tomato & Garlic base, Garnished with Fresh Avocado, Wild Rocket and Pesto Aioli"],
      ["1889 Margherita", "margherita.png", "XL: 5930kJ | CC: 6310kJ | L: 4370kJ | GF: 4670kJ | HP: 4210kJ", "GMWGF*", "Originating in 1889, a genuine Margherita with Bocconcini and Cherry Tomatoes on a Tomato base and garnished with Fresh Basil, Cracked Pepper & Sea Salt"],
      ["Mediterranean Lamb", "mediterraneanlamb.png", "XL: 7010kJ | CC: 7650kJ | L: 4920kJ | GF: 5460kJ | HP: 4760kJ", "GMWGF*", "House Cooked Lamb roasted in Mediterranean spices, Mozzarella, Tomatoes, Green Capsicum, Spanish Onions, Feta & Oregano on a Garlic Infused base, garnished with Mint Yoghurt & Lemon wedge"],
      ["Vietnamese Chilli Chicken", "vietnamesechillichicken.png", "XL: 7480kJ | CC: 7900kJ | L: 5490kJ | HP: 5080kJ", "GMSOYESsHW", "House Cooked Chicken topped with Shallots, Mozzarella, on a Tomato, Hoisin, Sweet Chilli and Garlic base, garnished with Slaw, Fresh Coriander, Chilli & Coriander Aioli"],
      ["Garlic Prawn", "garlicprawn.png", "XL: 6310kJ | CC: 6710kJ | L: 5000kJ | GF: 5310kJ | HP: 4850kJ", "GMWGF*Cr", "Garlic Marinated Prawns, Sundried Tomatoes, Shallots, Mozzarella, Roasted Capsicum & Feta on a Tomato base, garnished with Fresh Herbs & Lemon"],
      ["Peri Peri (not) Chicken", "periperinotchicken.png", "XL: 7020kJ | CC: 7440kJ | L: 5270kJ | HP: 5220kJ", "GMSOYESsHW", "Plant Based Chicken, Roasted Capsicum, Caramelised Onions, Mozzarella, Shallots and Bocconcini on a Tomato base with a sesame seed crust. Topped with our Famous Peri Peri Sauce"],
      ["Veg Beef Royale", "vegbeefroyale.png", "XL: 6430kJ | CC: 6830kJ | L: 4800kJ | GF: 5110kJ | HP: 4650kJ", "GMSOYSsW", "Seasoned Plant Based Mince, roasted Heirloom Tomatoes, sliced Onion and Mozzarella on a Tomato base with a sesame seed crust. Topped with Burger sauce and Pickles"],
      ["Moroccan Lamb", "moroccanlamb.png", "XL: 6300kJ | CC: 6720kJ | L: 4610kJ | HP: 4230kJ", "GMSOYSsWGF*", "House Cooked Lamb roasted in aromatic spices, Mozzarella, Spanish Onions & Baby Spinach on a Tomato base, garnished with Mint Yoghurt and Lemon wedge."],
      ["Truffle Beef Rossini", "trufflebeefrossini.png", "XL: 8740kJ | CC: 10500kJ | L: 6480kJ | GF: 6790kJ | HP: 6330kJ", "GMEW", "Premium Beef, Wild Mushroom medley, Mozzarella, Caramelised Onions on a Garlic base garnished with Fresh Parsley & Basil, topped with Bocconcini & Black Truffle Aioli"],
      ["Pulled Pork and Slaw", "pulledporkandslaw.png", "XL: 7860kJ | CC: 8290kJ | L: 5950kJ | GF: 6280kJ | HP: 5810kJ", "GMEW", "Twice Cooked Shredded Pork, Mozzarella & Caramelised Onions on a BBQ base topped with Fresh Pear, Slaw & Garlic Aioli"],
      ["Hawaiian", "hawaiian.png", "XL: 5750kJ | CC: 6160kJ | L: 4160kJ | GF: 4470kJ | HP: 4010kJ", "GMWGF*", "Ham, Pineapple & Mozzarella on a Tomato base"],
      ["Classic Margherita", "classicmargherita.png", "XL: 6550kJ | CC: 6960kJ | L: 4650kJ | GF: 4960kJ | HP: 4500kJ", "GMWGF*", "Mozzarella & Oregano on a Tomato base"],
      ["Capricciosa", "capricciosa.png", "XL: 5520kJ | CC: 6010kJ | L: 4650kJ | GF: 4960kJ | HP: 3810kJ", "GMWGF*", "Ham, Mushroom, Olives & Mozzarella on a Tomato base (Anchovies optional)"]
    ];    foreach ($pizzas as $pizza) {
      echo '<article class="menu-item">
        <img src="../images/' . $pizza[1] . '" alt="' . $pizza[0] . '" class="menu-image" />
        <h3>' . $pizza[0] . '</h3>
        <p class="energy">' . $pizza[2] . '</p>
        <p class="codes">' . $pizza[3] . '</p>
        <p class="description">' . $pizza[4] . '</p>        <form method="POST" action="../add_to_cart.php" class="add-to-cart-form">
          <input type="hidden" name="item_name" value="' . $pizza[0] . '" />
          <select name="size" class="size-select">
            <option value="Small">Small</option>
            <option value="Medium" selected>Medium</option>
            <option value="Large">Large</option>
          </select>
          <div class="quantity-selector">
            <label for="quantity-' . str_replace(' ', '-', strtolower($pizza[0])) . '">Qty:</label>
            <select name="quantity" id="quantity-' . str_replace(' ', '-', strtolower($pizza[0])) . '" class="quantity-select">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>
          </div>
          <button type="submit" class="add-to-cart">Add to Cart</button>
        </form>
      </article>';
    }
    ?>
  </section>

  <section class="sides-section">
    <h2>Sides</h2>

    <?php
    $sides = [
      ["Garlic Bread", "2140kJ", "GSOYW", "9 inch Loaf with Herb & Garlic Butter (Vegan friendly)"],
      ["Oven Baked Chips", "2050kJ", "GF", "Crispy Oven Baked Chips with your choice of seasoning"],
      ["Smokey BBQ Wings", "4190kJ", "GF", "Succulent and juicy BBQ wings tossed in a smokey sauce with sweet BBQ undertones."]
    ];    foreach ($sides as $side) {
      echo '<article class="menu-item">
        <h3>' . $side[0] . '</h3>
        <p class="energy">' . $side[1] . '</p>
        <p class="codes">' . $side[2] . '</p>
        <p class="description">' . $side[3] . '</p>        <form method="POST" action="../add_to_cart.php" class="add-to-cart-form">
          <input type="hidden" name="item_name" value="' . $side[0] . '" />
          <input type="hidden" name="price" value="8.99" />
          <div class="quantity-selector">
            <label for="quantity-' . str_replace(' ', '-', strtolower($side[0])) . '">Qty:</label>
            <select name="quantity" id="quantity-' . str_replace(' ', '-', strtolower($side[0])) . '" class="quantity-select">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>
          </div>
          <button type="submit" class="add-to-cart">Add to Cart</button>
        </form>
      </article>';
    }
    ?>
  </section>
</main>

<?php include '../partials/footer.php'; ?>

</body>
</html>
