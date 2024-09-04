<?php
// Include database connection
include './configdb.php'; // Ensure this file contains the proper connection details.

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Save Checkout Details
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $country = $_POST['country'];
    $street_address = $_POST['street_address'];
    $apartment = $_POST['apartment'];
    $city = $_POST['city'];
    $postcode = $_POST['postcode'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    // Insert checkout details and get the last inserted customer_id
    $stmt = $conn->prepare("INSERT INTO customers (first_name, last_name, country, street_address, apartment, city, postcode, phone, email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssss", $first_name, $last_name, $country, $street_address, $apartment, $city, $postcode, $phone, $email);

    if ($stmt->execute()) {
        $customer_id = $stmt->insert_id; // Get the last inserted customer_id
    } else {
        echo "Error: " . $stmt->error;
        exit;
    }

    // Fetch order details
    $subtotal = $_POST['subtotal'];
    $delivery = $_POST['delivery'];
    $discount = $_POST['discount'];
    $total = $_POST['total'];
    $payment_method = $_POST['payment_method'];

    // Insert order details into the orders table
    $order_stmt = $conn->prepare("INSERT INTO orders (customer_id, subtotal, delivery, discount, total, payment_method) VALUES (?, ?, ?, ?, ?, ?)");
    $order_stmt->bind_param("idddds", $customer_id, $subtotal, $delivery, $discount, $total, $payment_method);

    // Execute and check for errors
    if ($order_stmt->execute()) {
        $order_id = $order_stmt->insert_id; // Get the last inserted order_id
    } else {
        echo "Error inserting order: " . $order_stmt->error;
        exit;
    }

    // Decode the cart data from POST
    $cartData = json_decode($_POST['O-Dinor_cart'], true);

    // Insert each product in the order_has_items table
    $order_has_items_stmt = $conn->prepare("INSERT INTO order_has_items (order_id, product_id, quantity, color, size) VALUES (?, ?, ?, ?, ?)");

    foreach ($cartData as $item) {
        $product_id = $item['id'];
        $quantity = $item['quantity'];
        $color = $item['color'] ?? null; // Assuming color is available in the cart data
        $size = $item['size'] ?? null;   // Assuming size is available in the cart data

        // Bind the parameters for the current product
        $order_has_items_stmt->bind_param("iiiss", $order_id, $product_id, $quantity, $color, $size);

        // Execute and check for errors
        if (!$order_has_items_stmt->execute()) {
            echo "Error inserting product ID $product_id: " . $order_has_items_stmt->error;
            exit;
        }

        // Reduce stock quantity in the stock table
        // Uncomment and adjust as needed
        // $update_stock_stmt = $conn->prepare("UPDATE stock SET quantity = quantity - ? WHERE product_id = ?");
        // $update_stock_stmt->bind_param("ii", $quantity, $product_id);

        // if (!$update_stock_stmt->execute()) {
        //     echo "Error updating stock for product ID $product_id: " . $update_stock_stmt->error;
        //     exit;
        // }
    }

    // Close the statements and connection
    $stmt->close();
    $order_stmt->close();
    $order_has_items_stmt->close();
    // Uncomment if used
    // $update_stock_stmt->close();
    $conn->close();

    echo "Order and products saved successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>O-Dinor</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/checkout.css" />
</head>

<body class="goto-here">
  <?php include 'navbar.php'; ?>
  <div class="hero-wrap hero-bread" style="background-image: url('images/checkout.png')">
    <div class="container">
      <div class="row no-gutters slider-text align-items-center justify-content-center">
        <div class="col-md-9 text-center">
          <p class="breadcrumbs">
            <span class="mr-2"><a href="index.php">Home</a></span>
            <span>Checkout</span>
          </p>
          <h1 class="mb-0 bread">Checkout</h1>
        </div>
      </div>
    </div>
  </div>

  <section>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-8">
          <form id="checkout-form" class="billing-form" method="post">
            <h3 class="mb-4 billing-heading">Billing Details</h3>
            <div class="row align-items-end">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="firstname">First Name</label>
                  <input type="text" class="form-control" name="first_name" placeholder="First Name" required />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="lastname">Last Name</label>
                  <input type="text" class="form-control" name="last_name" placeholder="Last Name" required />
                </div>
              </div>
              <div class="w-100"></div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="country">State / Country</label>
                  <div class="select-wrap">
                    <div class="icon">
                      <span class="ion-ios-arrow-down"></span>
                    </div>
                    <select name="country" class="form-control" required>
                      <option value="SriLanka">Sri Lanka</option>
                      <option value="France">France</option>
                      <option value="Italy">Italy</option>
                      <option value="Philippines">Philippines</option>
                      <option value="South Korea">South Korea</option>
                      <option value="Hongkong">Hongkong</option>
                      <option value="Japan">Japan</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="w-100"></div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="streetaddress">Street Address</label>
                  <input type="text" class="form-control" name="street_address"
                    placeholder="House number and street name" required />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <input type="text" class="form-control" name="apartment"
                    placeholder="Apartment, suite, unit etc: (optional)" />
                </div>
              </div>
              <div class="w-100"></div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="towncity">Town / City</label>
                  <input type="text" class="form-control" name="city" placeholder="City" required />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="postcodezip">Postcode / ZIP *</label>
                  <input type="text" class="form-control" name="postcode" placeholder="Postcode / ZIP" required />
                </div>
              </div>
              <div class="w-100"></div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="phone">Phone</label>
                  <input type="text" class="form-control" name="phone" placeholder="Phone" required />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="emailaddress">Email Address</label>
                  <input type="email" class="form-control" name="email" placeholder="Email Address" required />
                </div>
              </div>
              <div class="w-100"></div>
              <div class="col-md-12">
                <div class="form-group mt-4">
                  <div class="radio">
                    <label class="mr-3"><input type="checkbox" name="create_account" value="1" /> Create an
                      Account?</label>
                    <label><input type="checkbox" name="ship_different_address" value="1" /> Ship to a different
                      address</label>
                  </div>
                </div>
              </div>
            </div>

            <!-- END -->

            <div class="row mt-5 pt-3 d-flex cart_calculation">
              <div class="col-md-6 d-flex">
                <div class="cart-detail cart-total bg-light p-3 p-md-4">
                  <h3 class="billing-heading mb-4">Cart Total</h3>
                  <p class="d-flex">
                    <span>Subtotal</span>
                    <span id="checkout-subtotal">LKR 0.00</span>
                  </p>
                  <p class="d-flex">
                    <span>Delivery</span>
                    <span id="checkout-delivery">LKR 0.00</span>
                  </p>
                  <p class="d-flex">
                    <span>Discount</span>
                    <span id="checkout-discount">LKR 0.00</span>
                  </p>
                  <hr />
                  <p class="d-flex total-price">
                    <span>Total</span>
                    <span id="checkout-total">LKR 0.00</span>
                  </p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="cart-detail bg-light p-3 p-md-4">
                  <h3 class="billing-heading mb-4">Payment Method</h3>
                  <div class="form-group">
                    <div class="col-md-12">
                      <div class="radio">
                        <label><input type="radio" name="payment_method" value="bank" class="mr-2" required /> Bank
                          Transfer</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <div class="radio">
                        <label><input type="radio" name="payment_method" value="cod" class="mr-2" required /> Cash on
                          Delivery</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <div class="radio">
                        <label><input type="radio" name="payment_method" value="paypal" class="mr-2" required />
                          Paypal</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <div class="checkbox">
                        <label><input type="checkbox" value="" class="mr-2" required /> I have read and accept the <a
                            id="termsLink" href="">terms and conditions</a></label>
                      </div>
                    </div>
                  </div>
                  <button id="checkout-button" type="submit" class="btn order-button" form="checkout-form">Place
                    an order</button>
                </div>
              </div>
            </div>
          </form>

        </div>
      </div>
    </div>
    <div id="orderModal" class="modal">
      <div class="modal-content">
        <!-- <span class="close">&times;</span> -->
        <div class="modal-info">
          <h1>Your order is complete!</h1>
          <p>You will be receiving a conformation email with order details.</p>
          <a href="shop.php" class="order-button">Explore more</a>
        </div>
      </div>
    </div>
    <div id="termsModal" class="modal1">
      <div class="modal1-content terms-box">
        <span class="close">&times;</span>
        <div class="terms-text">
          <h2>
            <center>Term of service</center>
          </h2>
          <p>
            Welcome to Odior. At our Odior, we prioritize your privacy. We
            collect personal data such as name, email, and address solely for
            order processing and customer service. Payment information is
            securely handled by trusted third-party providers. We do not share
            your data with third parties, except for shipping and payment
            processing purposes. Your data is stored securely, and you have the
            right to access or delete it at any time. By using our website, you
            consent to this policy. We may update this policy as needed, and any
            changes will be posted on this page.
          </p>
        </div>
      </div>
    </div>
  </section>

  <script>
    function loadCheckoutDetails() {
      document.getElementById('checkout-subtotal').textContent = localStorage.getItem('cartSubtotal') || 'LKR 0.00';
      document.getElementById('checkout-delivery').textContent = localStorage.getItem('cartDelivery') || 'LKR 0.00';
      document.getElementById('checkout-discount').textContent = localStorage.getItem('cartDiscount') || 'LKR 0.00';
      document.getElementById('checkout-total').textContent = localStorage.getItem('cartTotal') || 'LKR 0.00';
    }

    document.addEventListener('DOMContentLoaded', function () {
      loadCheckoutDetails();
    });

    const checkoutForm = document.getElementById('checkout-form');

    checkoutForm.addEventListener('submit', function (e) {
      e.preventDefault();

      const formData = new FormData(checkoutForm);

      // Add cart data to FormData
      let cartData = JSON.parse(localStorage.getItem('O-Dinor_cart')) || [];
      formData.append('O-Dinor_cart', JSON.stringify(cartData));

      function parseCurrency(value) {
        // Remove currency symbol and commas, then convert to float
        return parseFloat(value.replace(/[^0-9.-]+/g, '')) || 0;
      }

      // Retrieve and clean the values from local storage
      const subtotal = parseCurrency(localStorage.getItem('cartSubtotal')) || 0;
      const delivery = parseCurrency(localStorage.getItem('cartDelivery')) || 0;
      const discount = parseCurrency(localStorage.getItem('cartDiscount')) || 0;
      const total = parseCurrency(localStorage.getItem('cartTotal')) || 0;

      // Log the retrieved values to ensure they are correct
      console.log('Subtotal:', subtotal);
      console.log('Delivery:', delivery);
      console.log('Discount:', discount);
      console.log('Total:', total);

      // Append order amounts to FormData
      formData.append('subtotal', subtotal);
      formData.append('delivery', delivery);
      formData.append('discount', discount);
      formData.append('total', total);


      // Submit form data using Fetch API
      fetch('checkout.php', {
        method: 'POST',
        body: formData
      })
        .then(response => response.text())
        .then(data => {
          localStorage.removeItem('O-Dinor_cart');
          localStorage.removeItem('cartSubtotal');
          localStorage.removeItem('cartDelivery');
          localStorage.removeItem('cartDiscount');
          localStorage.removeItem('cartTotal');

          // Show success modal
          var modal = document.getElementById("orderModal");
          modal.style.display = "block";
        })
        .catch(error => console.error('Error:', error));
    });

    // Show terms modal
    document.getElementById("termsLink").addEventListener("click", function (event) {
      event.preventDefault(); // Prevent default anchor behavior

      var termsModal = document.getElementById("termsModal");
      termsModal.style.display = "block";
    });

    // Close the terms modal when clicking the close button
    document.querySelector("#termsModal .close").onclick = function () {
      document.getElementById("termsModal").style.display = "none";
    };

  </script>
  <?php include 'footer.php'; ?>
</body>

</html>