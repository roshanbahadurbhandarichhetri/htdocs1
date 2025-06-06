<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Crust Pizza | About Us</title>
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/about.css" />
</head>
<body>

<?php include 'partials/navbar.php'; ?>

<main class="about-container">
  <section class="about-intro">
    <h2>About Crust Pizza</h2>
    <p>Welcome to <strong>Crust Pizza</strong> – where flavor meets passion!</p>
    <p>Founded in 2020, we’ve grown to become a local favorite for gourmet pizzas, handcrafted with love and fresh, locally-sourced ingredients. Our mission is simple: <em>Deliver happiness in every slice</em>.</p>
  </section>

  <section class="why-choose-us">
    <h3>Why Choose Us?</h3>
    <ul>
      <li>✓ Fresh, Premium Ingredients</li>
      <li>✓ 100% Handcrafted Dough</li>
      <li>✓ Fast & Reliable Delivery</li>
      <li>✓ Vegan and Gluten-Free Options Available</li>
    </ul>
    <p>Whether you're dining in, taking out, or ordering online, we’re here to serve you with a smile.</p>
  </section>

  <section class="our-menu">
    <h3>Our Menu</h3>
    <p>We offer <strong>19 delicious standard pizzas</strong>, ranging from timeless classics like Margherita and Pepperoni to bold flavors like Spicy Peri-Peri and Tandoori Paneer. Pair your pizza with our tasty sides including garlic bread, cheesy wedges, and fresh salads!</p>
    <div class="button-group">
      <a href="/customer/menu.php" class="btn view-menu-btn">View Our Menu</a>
    </div>
  </section>

  <section class="custom-pizza">
    <h3>Make Your Own Pizza</h3>
    <p>Want something uniquely yours? With our <strong>Make Your Own Pizza</strong> feature, you can create your dream pizza from scratch! Choose your crust, sauce, cheese, toppings, and more.</p>
    
    <div class="button-group">
      <a href="/customer/customize.php" class="btn custom-pizza-btn">Make Your Own Pizza</a>
    </div>
  </section>
</main>

<?php include 'partials/footer.php'; ?>

</body>
</html>
