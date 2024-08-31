<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>O-Dinor</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/main_cart.css">
</head>

<body class="goto-here">
  <?php include 'navbar.php'; ?>
  <div class="hero-wrap hero-bread" style="background-image: url('images/go-girl.jpg')">
    <div class="container">
      <div class="row no-gutters slider-text align-items-center justify-content-center">
        <div class="col-md-9 text-center">
          <p class="breadcrumbs">
            <span class="mr-2"><a href="index.php">Home</a></span>
            <span>Cart</span>
          </p>
          <h1 class="mb-0 bread">MY CART</h1>
        </div>
      </div>
    </div>
  </div>

  <section>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="cart-list">
            <table class="table col-md-12">
              <thead class="thead-primary">
                <tr class="text-center">
                  <th>&nbsp;</th>
                  <th>&nbsp;</th>
                  <th>Product</th>
                  <th>Color</th>
                  <th>Size</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody class="cart-items-list" id="cart-items">
                <!-- Cart items will be dynamically generated here -->
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="row justify-content-center cart_calucatation">
        <div class="col col-lg-5 col-md-6 mt-5 cart-wrap">
          <div class="cart-total mb-3">
            <h3>Cart Totals</h3>
            <p class="d-flex">
              <span>Subtotal</span>
              <span id="subtotal-price" class="subtotal-price">LKR 0.00</span>
            </p>
            <p class="d-flex">
              <span>Delivery</span>
              <span id="delivery-price" class="delivery-price">LKR 2000.00</span>
            </p>
            <p class="d-flex">
              <span>Discount</span>
              <input type="text" id="discount-code" class="discount-code-input" placeholder="Enter discount code">
            </p>
            <hr />
            <p class="d-flex total-price">
              <span>Total:</span>
              <span id="total-price">LKR 0.00</span>
            </p>
          </div>
          <p class="text-center">
            <a href="checkout.php" class="checkout-button" id="checkout-btn">Proceed to Checkout</a>
          </p>
        </div>
      </div>
    </div>
  </section>
  <?php include 'footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
  <script>
    // Retrieve the cart data from local storage
    let cartData = JSON.parse(localStorage.getItem('cart')) || {};
    const DELIVERY_PRICE = 2000; // Fixed delivery price

    // Display cart items in the list
    function displayCartItems() {
      const cartItemsContainer = document.getElementById('cart-items');
      cartItemsContainer.innerHTML = ''; // Clear existing items
      let subtotalPrice = 0;

      Object.keys(cartData).forEach(key => {
        const item = cartData[key];
        subtotalPrice += item.rate * item.quantity;

        const row = document.createElement('tr');
        row.innerHTML = `
                <td class="remove">
                    <button class="btn btn-sm btn-outline-secondary" onclick="removeItem('${key}')">X</button>
                </td>
                <td class="image-prod">
                    <img src="${item.image}" alt="${item.name}" style="width: 50px; height: 50px; margin-right: 10px;">
                </td>
                <td class="product-name">
                    ${item.name}
                </td>
                <td class="product-color">
                    <span style="display:inline-block; width: 20px; height: 20px; background-color: ${item.color}; border-radius: 50%; border: 1px solid #ccc;"></span>
                </td>
                <td class="product-size">
                    ${item.size}
                </td>
                <td class="price">
                    LKR ${item.rate.toFixed(2)}
                </td>
                <td class="quantity">
                    <button class="btn btn-sm btn-outline-secondary btn_Qnt" onclick="changeQuantity('${key}', ${item.quantity - 1})">-</button>
                    ${item.quantity}
                    <button class="btn btn-sm btn-outline-secondary btn_Qnt" onclick="changeQuantity('${key}', ${item.quantity + 1})">+</button>
                </td>
                <td class="total">
                    LKR ${(item.rate * item.quantity).toFixed(2)}
                </td>
            `;
        cartItemsContainer.appendChild(row);
      });

      // Update subtotal price display
      document.getElementById('subtotal-price').textContent = `LKR ${subtotalPrice.toFixed(2)}`;
      updateTotalPrice();
    }

    // Change quantity of items in the cart
    function changeQuantity(key, quantity) {
      if (quantity <= 0) {
        delete cartData[key];
      } else {
        cartData[key].quantity = quantity;
      }
      saveCart();
      displayCartItems();
    }

    // Remove item from the cart
    function removeItem(key) {
      delete cartData[key];
      saveCart();
      displayCartItems();
    }

    // Save cart data to local storage
    function saveCart() {
      localStorage.setItem('cart', JSON.stringify(cartData));
    }

    // Update total price based on subtotal, delivery, and discount
    function updateTotalPrice() {
      const subtotalPrice = parseFloat(document.getElementById('subtotal-price').textContent.replace('LKR ', ''));
      const delivery = DELIVERY_PRICE;
      const discount = applyDiscountCode(document.getElementById('discount-code').value) || 0;
      const totalPrice = subtotalPrice + delivery - discount;

      // Update the total price display
      document.getElementById('total-price').textContent = `LKR ${totalPrice.toFixed(2)}`;

      // Save values to localStorage
      localStorage.setItem('cartSubtotal', `LKR ${subtotalPrice.toFixed(2)}`);
      localStorage.setItem('cartDelivery', `LKR ${delivery.toFixed(2)}`);
      localStorage.setItem('cartDiscount', `LKR ${discount.toFixed(2)}`);
      localStorage.setItem('cartTotal', `LKR ${totalPrice.toFixed(2)}`);
    }

    // Apply discount code and return the discount amount
    function applyDiscountCode(code) {
      // Sample discount codes: 'DISCOUNT10' for 10% off
      const discountCodes = {
        'DISCOUNT10': 0.10, // 10% discount
        'DISCOUNT20': 0.20  // 20% discount
      };
      return discountCodes[code.toUpperCase()] * parseFloat(document.getElementById('subtotal-price').textContent.replace('LKR ', ''));
    }

    // Event listener for changes in the discount code input field
    document.getElementById('discount-code').addEventListener('input', updateTotalPrice);

    // Checkout button click event
    document.getElementById('checkout-btn').addEventListener('click', function () {
      window.location.href = 'checkout.php';
    });

    // Load cart items on page load
    document.addEventListener('DOMContentLoaded', displayCartItems);

  </script>
</body>

</html>