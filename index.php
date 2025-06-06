<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Crust Pizza - Home</title>
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/index.css" />
</head>
<body>

<?php include 'partials/navbar.php'; ?>

<!-- HERO SECTION -->
<header class="hero">
  <div class="container">
    <h1>Welcome to Crust Pizza</h1>
    <p>Australia’s finest gourmet pizza is just a click away. Fresh ingredients, award-winning flavors.</p>
    <a href="customer/menu.php" class="btn btn-primary">Order Now</a>
  </div>
</header>

<!-- ABOUT SECTION -->
<!-- ABOUT SECTION -->
<section class="about container" aria-labelledby="about-heading">
  <h2 id="about-heading">About Us</h2>
  <p>Crust Pizza has been serving gourmet pizzas since 2001. Known for our iconic Peri Peri Chicken and a wide range of vegan, gluten-free, and low-carb options, we’re passionate about flavor and innovation.</p>
  <a href="about.php" class="btn btn-primary" style="margin-top: 20px; display: inline-block;">Learn More About Us</a>
</section>


<!-- POPULAR PIZZAS -->
<section class="pizzas container" aria-labelledby="popular-pizzas-heading">
  <h2 id="popular-pizzas-heading">Our Popular Picks</h2>
  <div class="pizza-list">
    <article class="pizza-card" tabindex="0" aria-label="Margherita Pizza">
      <img src="images/margherita.png" alt="Margherita Pizza" />
      <h3>Margherita</h3>
      <p>Classic delight with cheese and tomato base.</p>
    </article>
    <article class="pizza-card" tabindex="0" aria-label="Peri Peri Chicken Pizza">
      <img src="images/Periperi.png" alt="Peri Peri Chicken Pizza" />
      <h3>Peri Peri Chicken</h3>
      <p>Our award-winning spicy chicken pizza.</p>
    </article>
    <article class="pizza-card" tabindex="0" aria-label="Vegan Delight Pizza">
      <img src="images/vegandelight.png" alt="Vegan Delight Pizza" />
      <h3>Vegan Delight</h3>
      <p>Plant-based goodness with rich flavors.</p>
    </article>
  </div>
</section>

<!-- HOW IT WORKS -->
<section class="steps container" aria-labelledby="how-it-works-heading">
  <h2 id="how-it-works-heading">How It Works</h2>
  <ol>
    <li>Sign up and log in to your account.</li>
    <li>Choose your pizza or build your own.</li>
    <li>Place your order and track delivery.</li>
  </ol>
  
  <a href="customer/signup_login.php" class="btn btn-success">Sign Up / Login</a>
</section>

<section class="team">
  <h2 id="team-details"> Know the Team </h2>
  <P> Our teams consists of 4 members including: </p>
  <ol>
    <li>Thais dos Santos Vieira (K231629)</li>
    <li>Jen Raven Ganga (K231898)</li>
    <li>Anita Gaire (K231558)</li>
    <li>Nishma Dhungana (K231421)</li>
</ol>
</section>

<?php include 'partials/footer.php'; ?>

</body>
</html>
