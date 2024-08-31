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
        <div class="col-xl-8 ">
          <form action="#" class="billing-form">
            <h3 class="mb-4 billing-heading">Billing Details</h3>
            <div class="row align-items-end">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="firstname">First Name</label>
                  <input type="text" class="form-control" placeholder="" />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="lastname">Last Name</label>
                  <input type="text" class="form-control" placeholder="" />
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
                    <select name="" id="" class="form-control">
                      <option value="">France</option>
                      <option value="">Italy</option>
                      <option value="">Philippines</option>
                      <option value="">South Korea</option>
                      <option value="">Hongkong</option>
                      <option value="">Japan</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="w-100"></div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="streetaddress">Street Address</label>
                  <input type="text" class="form-control" placeholder="House number and street name" />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Apartment, suite, unit etc: (optional)" />
                </div>
              </div>
              <div class="w-100"></div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="towncity">Town / City</label>
                  <input type="text" class="form-control" placeholder="" />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="postcodezip">Postcode / ZIP *</label>
                  <input type="text" class="form-control" placeholder="" />
                </div>
              </div>
              <div class="w-100"></div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="phone">Phone</label>
                  <input type="text" class="form-control" placeholder="" />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="emailaddress">Email Address</label>
                  <input type="text" class="form-control" placeholder="" />
                </div>
              </div>
              <div class="w-100"></div>
              <div class="col-md-12">
                <div class="form-group mt-4">
                  <div class="radio">
                    <label class="mr-3"><input type="radio" name="optradio" /> Create an
                      Account?
                    </label>
                    <label><input type="radio" name="optradio" /> Ship to
                      different address</label>
                  </div>
                </div>
              </div>
            </div>
          </form>
          <!-- END -->

          <div class="row mt-5 pt-3 d-flex cart_calucatation">
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
                      <label><input type="radio" name="optradio" class="mr-2" />
                        Direct Bank Transfer</label>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-12">
                    <div class="radio">
                      <label><input type="radio" name="optradio" class="mr-2" />
                        Check Payment</label>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-12">
                    <div class="radio">
                      <label><input type="radio" name="optradio" class="mr-2" />
                        Paypal</label>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-12">
                    <div class="checkbox">
                      <label><input type="checkbox" value="" class="mr-2" /> I
                        have read and accept the terms and conditions</label>
                    </div>
                  </div>
                </div>
                <p>
                  <a href="#" class="order-button" id="order-btn">Place an order</a>
                </p>
              </div>
            </div>
          </div>
        </div>
        <!-- .col-md-8 -->
      </div>
    </div>
  </section>
  <?php include 'footer.php'; ?>

  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script
    src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>

  <script>
    function loadCheckoutDetails() {
      document.getElementById('checkout-subtotal').textContent = localStorage.getItem('cartSubtotal') || 'LKR 0.00';
      document.getElementById('checkout-delivery').textContent = localStorage.getItem('cartDelivery') || 'LKR 0.00';
      document.getElementById('checkout-discount').textContent = localStorage.getItem('cartDiscount') || 'LKR 0.00';
      document.getElementById('checkout-total').textContent = localStorage.getItem('cartTotal') || 'LKR 0.00';
    }

    document.addEventListener('DOMContentLoaded', loadCheckoutDetails);

    // Clear cart data from localStorage after placing the order
    document.getElementById('order-btn').addEventListener('click', function () {
      localStorage.removeItem('cartSubtotal');
      localStorage.removeItem('cartDelivery');
      localStorage.removeItem('cartDiscount');
      localStorage.removeItem('cartTotal');
      alert('Order placed successfully!'); // Add your order processing logic here
    });
  </script>
</body>

</html>
