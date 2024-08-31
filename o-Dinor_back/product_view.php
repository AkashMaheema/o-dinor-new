<?php
include './configdb.php';
session_start();
$name = $_SESSION['name'];
if (empty($_SESSION['name'])) {
    header("Location: login.php");
}

// Fetch product details based on product id
$product_id = isset($_GET['product_id']) ? $_GET['product_id'] : 1;
$product_sql = "SELECT p.*, GROUP_CONCAT(DISTINCT pi.image_path ORDER BY pi.id) AS images, 
                GROUP_CONCAT(DISTINCT pc.color ORDER BY pc.color) AS colors 
                FROM products p 
                LEFT JOIN product_images pi ON p.id = pi.product_id 
                LEFT JOIN product_colors pc ON p.id = pc.product_id
                WHERE p.id = ?
                GROUP BY p.id";
$stmt = $conn->prepare($product_sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$product_result = $stmt->get_result();
$product = $product_result->fetch_assoc();

// Fetch sizes with their costs and prices
$sizes_sql = "SELECT size, cost, rate FROM product_sizes WHERE product_id = ?";
$stmt_sizes = $conn->prepare($sizes_sql);
$stmt_sizes->bind_param("i", $product_id);
$stmt_sizes->execute();
$sizes_result = $stmt_sizes->get_result();
$sizes = [];
while ($row = $sizes_result->fetch_assoc()) {
    $sizes[] = $row;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Product View</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .container {
            display: flex;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .carousel {
            width: 10%;
            display: flex;
            flex-direction: column;
        }

        .carousel img {
            cursor: pointer;
            object-fit: cover;
            outline: 1px solid #ffa45c;
        }

        .main-image {
            width: 35%;
            text-align: center;
        }

        .details {
            width: 40%;
        }

        .color-circle {
            width: 30px;
            height: 30px;
            border-radius: 10%;
            display: inline-block;
            border: 1px solid #000;
            margin-top: 5px;
        }

        .size-box {
            display: inline-block;
            padding: 6px 10px;
            border: 1px solid #000;
            margin: 5px;
            cursor: pointer;
        }

        .similar-products {
            margin-top: 20px;
        }

        .product {
            display: inline-block;
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="carousel">
            <!-- Carousel of images -->
            <?php
            $images = explode(',', $product['images']);
            foreach ($images as $i => $image_path) : ?>
                <img src="<?= htmlspecialchars($image_path); ?>" alt="Image <?= $i + 1; ?>" class="img-fluid carousel-image">
            <?php endforeach; ?>
        </div>
        <div class="main-image">
            <img id="mainImage" src="<?= htmlspecialchars($images[0]); ?>" alt="Main Image" class="img-fluid" style="height: 600px">
        </div>
        <div class="details">
            <h1><?= htmlspecialchars($product['name']); ?></h1>
            <h3>ID : <?= htmlspecialchars($product['id']); ?></h3>
            <p><b>Gender:</b> <?= $product['gender'] == 'M' ? "Male" : "Female"; ?></p>
            <h4>Title</h4>
            <p><?= htmlspecialchars($product['title']); ?></p>
            <h4>Description</h4>
            <p><?= htmlspecialchars($product['description']); ?></p>
            <p><b>Colors:</b>
                <?php
                $colors = explode(',', $product['colors']);
                foreach ($colors as $color) : ?>
                    <span class="color-circle" style="background-color: <?= htmlspecialchars($color); ?>;"></span>
                <?php endforeach; ?>
            </p>
            <p><b>Sizes:</b>
                <div id="sizes">
                    <?php foreach ($sizes as $size) : ?>
                        <span class="size-box" data-cost="<?= htmlspecialchars($size['cost']); ?>" data-rate="<?= htmlspecialchars($size['rate']); ?>">
                            <?= htmlspecialchars($size['size']); ?>
                        </span>
                    <?php endforeach; ?>
                </div>
            </p>
            <p><b>Cost:</b> LKR <span id="productCost"><?= htmlspecialchars($sizes[0]['cost']); ?></span></p>
            <p><b>Price:</b> LKR <span id="productRate"><?= htmlspecialchars($sizes[0]['rate']); ?></span></p>

            <a href="edit_product.php?product_id=<?= $product['id']; ?>" class="btn btn-primary m-1">Edit</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const carouselImages = document.querySelectorAll('.carousel-image');
            const mainImage = document.getElementById('mainImage');
            const sizeBoxes = document.querySelectorAll('.size-box');
            const productCost = document.getElementById('productCost');
            const productRate = document.getElementById('productRate');

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
                image.addEventListener('click', function() {
                    mainImage.src = this.src;
                });
            });

            // Adjust carousel image height on window resize
            window.addEventListener('resize', setCarouselImagesHeight);

            // Update cost and rate when a size is selected
            sizeBoxes.forEach(box => {
                box.addEventListener('click', function() {
                    productCost.textContent = this.getAttribute('data-cost');
                    productRate.textContent = this.getAttribute('data-rate');
                });
            });
        });
    </script>
</body>

</html>
