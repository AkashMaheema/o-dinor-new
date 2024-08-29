<?php
include './configdb.php';

// Fetch product details based on product id
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$product_sql = "SELECT p.*, GROUP_CONCAT(DISTINCT pi.image_path ORDER BY pi.id) AS images, 
                  GROUP_CONCAT(DISTINCT pc.color ORDER BY pc.color) AS colors, 
                  GROUP_CONCAT(DISTINCT ps.size ORDER BY ps.size) AS sizes,
                  COALESCE(
                          (SELECT ps.rate FROM product_sizes ps WHERE ps.product_id = p.id AND ps.size = 'S' LIMIT 1),
                          (SELECT ps.rate FROM product_sizes ps WHERE ps.product_id = p.id AND ps.size = 'M' LIMIT 1),
                          (SELECT ps.rate FROM product_sizes ps WHERE ps.product_id = p.id AND ps.size = 'L' LIMIT 1),
                          (SELECT ps.rate FROM product_sizes ps WHERE ps.product_id = p.id AND ps.size = 'XL' LIMIT 1),
                          (SELECT ps.rate FROM product_sizes ps WHERE ps.product_id = p.id AND ps.size = 'XXL' LIMIT 1),
                          (SELECT ps.rate FROM product_sizes ps WHERE ps.product_id = p.id AND ps.size = 'XXXL' LIMIT 1)
                  ) AS lowest_rate
                  FROM products p 
                  LEFT JOIN product_images pi ON p.id = pi.product_id 
                  LEFT JOIN product_colors pc ON p.id = pc.product_id
                  LEFT JOIN product_sizes ps ON p.id = ps.product_id
                  WHERE p.id = ?
                  GROUP BY p.id";
$stmt = $conn->prepare($product_sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$product_result = $stmt->get_result();
$product = $product_result->fetch_assoc();

// Fetch size-specific rates for the product
$size_rate_sql = "SELECT size, rate FROM product_sizes WHERE product_id = ?";
$stmt = $conn->prepare($size_rate_sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$size_rate_result = $stmt->get_result();
$sizeRates = [];
while ($row = $size_rate_result->fetch_assoc()) {
    $sizeRates[$row['size']] = $row['rate'];
}

// Define standard sizes
$standard_sizes = ['S', 'M', 'L', 'XL', 'XXL', 'XXXL'];

// Get available sizes from the product data
$available_sizes = explode(',', $product['sizes']);

// Fetch similar products based on the category
$category = $product['category'];
$sql = "SELECT p.*, 
        GROUP_CONCAT(pi.image_path ORDER BY pi.id) AS images,
        COALESCE(
            (SELECT ps.rate FROM product_sizes ps WHERE ps.product_id = p.id AND ps.size = 'S' LIMIT 1),
            (SELECT ps.rate FROM product_sizes ps WHERE ps.product_id = p.id AND ps.size = 'M' LIMIT 1),
            (SELECT ps.rate FROM product_sizes ps WHERE ps.product_id = p.id AND ps.size = 'L' LIMIT 1),
            (SELECT ps.rate FROM product_sizes ps WHERE ps.product_id = p.id AND ps.size = 'XL' LIMIT 1),
            (SELECT ps.rate FROM product_sizes ps WHERE ps.product_id = p.id AND ps.size = 'XXL' LIMIT 1),
            (SELECT ps.rate FROM product_sizes ps WHERE ps.product_id = p.id AND ps.size = 'XXXL' LIMIT 1)
        ) AS lowest_rate
        FROM products p 
        LEFT JOIN product_images pi ON p.id = pi.product_id 
        WHERE p.category = ? AND p.id != ? 
        GROUP BY p.id 
        LIMIT 4"; // Adjust the limit as needed
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $category, $product_id);
$stmt->execute();
$result = $stmt->get_result();

$similarProducts = [];
while ($row = $result->fetch_assoc()) {
  $row['images'] = explode(',', $row['images']);
  $similarProducts[] = $row;
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Product View</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="css/detail.css" />
  <link rel="stylesheet" href="css/cart.css" />
</head>

<body>
  <?php include 'navbar.php'; ?>
  <?php include 'header_bar.php'; ?>
  <div class="container">
    <div class="title">PRODUCT DETAILS</div>
    <br>
    <div class="detailContainer">
      <div class="imageContainer">
        <div class="carousel">
          <!-- Carousel of images -->
          <?php
          $images = explode(',', $product['images']);
          foreach ($images as $i => $image_path): ?>
            <img src="<?= htmlspecialchars($image_path); ?>" alt="Image <?= $i + 1; ?>" class="img-fluid carousel-image">
          <?php endforeach; ?>
        </div>
        <div class="image">
          <img id="mainImage" src="<?= htmlspecialchars($images[0]); ?>" alt="Main Image" class="img-fluid">
        </div>
      </div>
      <div class="details">
        <h1><?= htmlspecialchars($product['name']); ?></h1>
        <h4>Title</h4>
        <p><?= htmlspecialchars($product['title']); ?></p>
        <h4>Description</h4>
        <p><?= htmlspecialchars($product['description']); ?></p>
        <p><b>Colors:</b></p>
        <div id="color-options">
          <?php
          $colors = explode(',', $product['colors']);
          foreach ($colors as $color): ?>
            <label class="color-label">
              <input type="radio" name="color" value="<?= htmlspecialchars($color); ?>" required>
              <span class="color-circle" style="background-color: <?= htmlspecialchars($color); ?>;"></span>
            </label>
          <?php endforeach; ?>
        </div>
        <p><b>Sizes:</b></p>
        <div id="size-options">
          <?php foreach ($standard_sizes as $size):
            $is_available = in_array($size, $available_sizes);
            ?>
            <label class="size-label">
              <input type="radio" name="size" value="<?= htmlspecialchars($size); ?>" <?= $is_available ? '' : 'disabled'; ?> required>
              <span
                class="size-box <?= $is_available ? 'available' : 'unavailable'; ?>"><?= htmlspecialchars($size); ?></span>
            </label>
          <?php endforeach; ?>
        </div>
        <br>
        <p><b>Price:</b> LKR <span id="product-price"><?= htmlspecialchars(number_format($product['lowest_rate'], 2)); ?></span></p>

        <div class="buttons">
          <button class="btn_add" onclick="addToCart()">Add To Cart</button>
        </div>
      </div>
    </div>
    <div class="title">SIMILAR PRODUCTS</div>
    <div class="listProduct" id="similar-products"></div>
  </div>
  <br>
  <br>
  <?php include 'footer.php'; ?>
  <?php include 'cart.php'; ?>


  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const colorOptions = document.querySelectorAll('#color-options .color-label');
      const sizeOptions = document.querySelectorAll('#size-options .size-label');
      const sizeRates = <?= json_encode($sizeRates); ?>; // PHP size rates passed to JS
      const priceElement = document.getElementById('product-price');

      colorOptions.forEach(label => {
        label.addEventListener('click', function () {
          colorOptions.forEach(item => item.classList.remove('selected'));
          this.classList.add('selected');
        });
      });

      sizeOptions.forEach(label => {
        if (!label.querySelector('input').disabled) {
          label.addEventListener('click', function () {
            sizeOptions.forEach(item => item.classList.remove('selected'));
            this.classList.add('selected');

            // Update price based on selected size
            const selectedSize = label.querySelector('input').value;
            if (sizeRates[selectedSize]) {
              priceElement.textContent = parseFloat(sizeRates[selectedSize]).toFixed(2);
            }
          });
        }
      });

      const carouselImages = document.querySelectorAll('.carousel-image');
      const mainImage = document.getElementById('mainImage');
      const similarProducts = <?php echo json_encode($similarProducts); ?>;

      // Function to set carousel images height equal to main image height
      function setCarouselImagesHeight() {
        const mainImageHeight = mainImage.clientHeight;
        carouselImages.forEach(image => {
          image.style.height = `${mainImageHeight / 6}px`;
        });
      }

      // Initial setting of carousel images height
      setCarouselImagesHeight();

      // Add click event to carousel images
      carouselImages.forEach(image => {
        image.addEventListener('click', function () {
          mainImage.src = this.src;
        });
      });

      // Adjust carousel image height on window resize
      window.addEventListener('resize', setCarouselImagesHeight);

      // Add similar products
      const similarProductsContainer = document.getElementById('similar-products');
      similarProducts.forEach(similarProduct => {
        const item = document.createElement('a');
        item.href = 'detail.php?id=' + similarProduct.id;
        item.classList.add('item');
        item.innerHTML = `
            <div class='img-body'>
            <img src="${similarProduct.images[0] || 'default_image.jpg'}" alt="${similarProduct.name}">
            </div>
            <div class='card-body'>
            <h2>${similarProduct.name}</h2>
            <div class="price">LKR ${similarProduct.lowest_rate.toFixed(2)}</div>
            </div>
          `;
        similarProductsContainer.appendChild(item);
      });
    });
  </script>
</body>

</html>
