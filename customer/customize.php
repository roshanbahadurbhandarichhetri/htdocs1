<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Crust Pizza - Customize Your Pizza</title>
  <link rel="stylesheet" href="../css/style.css" />
  <link rel="stylesheet" href="../css/customize.css" />
</head>
<body>

<?php include '../partials/navbar.php'; ?>

<main class="customize-page">
  <h1 class="page-title">Customize Your Pizza</h1>

  <form action="../add_to_cart.php" method="POST" class="customize-form" id="pizzaForm">
    <img src="../images/custom_pizza.jpg" alt="Custom Pizza" class="pizza-image" />

    <label for="base">Choose Your Base <small>(Prices included)</small>:</label>
    <select name="base" id="base" required>
      <option value="Thin Crust" data-price="8">Thin Crust ($8)</option>
      <option value="Thick Crust" data-price="9">Thick Crust ($9)</option>
      <option value="Cheese Stuffed" data-price="11">Cheese Stuffed ($11)</option>
      <option value="Gluten-Free" data-price="10">Gluten-Free ($10)</option>
    </select>

    <label for="sauce">Choose Sauce:</label>
    <select name="sauce" id="sauce" required>
      <option value="Tomato" data-price="0">Tomato ($0)</option>
      <option value="BBQ" data-price="1">BBQ ($1)</option>
      <option value="Alfredo" data-price="1.5">Alfredo ($1.5)</option>
      <option value="Pesto" data-price="2">Pesto ($2)</option>
    </select>

    <label>Choose Toppings <small>($1.5 each)</small>:</label>
    <div class="toppings-list">
      <?php 
        $toppings = [
          'Mozzarella', 'Pepperoni', 'Mushrooms', 'Onions', 'Green Peppers',
          'Olives', 'Ham', 'Pineapple', 'Bacon', 'Jalapenos'
        ];
        foreach ($toppings as $top): ?>
          <label>
            <input type="checkbox" name="toppings[]" value="<?= htmlspecialchars($top) ?>" />
            <?= htmlspecialchars($top) ?>
          </label>
      <?php endforeach; ?>
    </div>

    <label for="quantity">Quantity:</label>
    <input type="number" id="quantity" name="quantity" min="1" max="10" value="1" required />

    <input type="hidden" name="name" value="Custom Pizza" />
    <input type="hidden" name="price" id="priceInput" value="0" />

    <button type="submit" class="btn-submit">Add to Cart</button>
  </form>

  <aside class="order-summary" aria-live="polite" aria-atomic="true">
    <h2>Your Order Summary</h2>
    <div class="summary-item"><span>Base:</span><span id="summary-base">Thin Crust</span></div>
    <div class="summary-item"><span>Sauce:</span><span id="summary-sauce">Tomato</span></div>
    <div class="summary-item"><span>Toppings:</span><span id="summary-toppings">None</span></div>
    <div class="summary-item"><span>Quantity:</span><span id="summary-quantity">1</span></div>
    <div class="summary-total">Total: $<span id="summary-total">8.00</span></div>
  </aside>
</main>

<script>
  // JS for updating summary and price dynamically
  const baseSelect = document.getElementById('base');
  const sauceSelect = document.getElementById('sauce');
  const toppingsCheckboxes = document.querySelectorAll('.toppings-list input[type="checkbox"]');
  const quantityInput = document.getElementById('quantity');

  const summaryBase = document.getElementById('summary-base');
  const summarySauce = document.getElementById('summary-sauce');
  const summaryToppings = document.getElementById('summary-toppings');
  const summaryQuantity = document.getElementById('summary-quantity');
  const summaryTotal = document.getElementById('summary-total');
  const priceInput = document.getElementById('priceInput');

  function updateSummary() {
    // Base and sauce info and prices
    const basePrice = parseFloat(baseSelect.selectedOptions[0].dataset.price);
    const saucePrice = parseFloat(sauceSelect.selectedOptions[0].dataset.price);
    const quantity = parseInt(quantityInput.value) || 1;

    summaryBase.textContent = baseSelect.value;
    summarySauce.textContent = sauceSelect.value;
    summaryQuantity.textContent = quantity;

    // Toppings
    let toppingsSelected = [];
    toppingsCheckboxes.forEach(cb => {
      if (cb.checked) toppingsSelected.push(cb.value);
    });
    summaryToppings.textContent = toppingsSelected.length ? toppingsSelected.join(', ') : 'None';

    // Calculate total price
    const toppingPriceEach = 1.5;
    const totalPrice = (basePrice + saucePrice + (toppingsSelected.length * toppingPriceEach)) * quantity;

    summaryTotal.textContent = totalPrice.toFixed(2);
    priceInput.value = totalPrice.toFixed(2);
  }

  // Event listeners
  baseSelect.addEventListener('change', updateSummary);
  sauceSelect.addEventListener('change', updateSummary);
  toppingsCheckboxes.forEach(cb => cb.addEventListener('change', updateSummary));
  quantityInput.addEventListener('input', updateSummary);

  // Initialize on page load
  updateSummary();
</script>

<?php include '../partials/footer.php'; ?>

</body>
</html>
