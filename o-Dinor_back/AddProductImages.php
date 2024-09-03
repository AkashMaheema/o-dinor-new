<?php
// Include database configuration
include './configdb.php';
session_start();
$name = $_SESSION['name'];
if (empty($_SESSION['name'])) {
    header("Location: login.php");
    exit();
}

// Handle image uploads
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['upload'])) {
    $product_id = $_POST['product_id'];

    if ($product_id) {
        // Check the number of existing images for this product
        $sql_check_images = "SELECT COUNT(*) AS image_count FROM product_images WHERE product_id = $product_id";
        $result_check_images = $conn->query($sql_check_images);
        $row = $result_check_images->fetch_assoc();
        $current_image_count = $row['image_count'];

        // Set the limit for total images
        $image_limit = 5;

        // Check if adding new images would exceed the limit
        if ($current_image_count < $image_limit) {
            $uploads_dir = '../o-Dinor_back/uploads';
            if (!is_dir($uploads_dir)) {
                mkdir($uploads_dir, 0777, true);
            }

            $total_images = count($_FILES['images']['name']);
            $images_to_upload = min($image_limit - $current_image_count, $total_images);

            for ($i = 0; $i < $images_to_upload; $i++) {
                $image_name = $_FILES['images']['name'][$i];
                $image_tmp_name = $_FILES['images']['tmp_name'][$i];
                $image_path = $uploads_dir . '/' . basename($image_name);

                if (move_uploaded_file($image_tmp_name, $image_path)) {
                    // Insert image path into the database
                    $sql = "INSERT INTO product_images (product_id, image_path) VALUES ($product_id, '$image_path')";
                    if ($conn->query($sql)) {
                        echo '<div class="d-flex justify-content-end"><div class="alert alert-success" role="alert" style="width: 300px;text-align:center;">New image added successfully!</div></div>';
                    } else {
                        echo '<div class="alert alert-danger" role="alert">Error uploading image: ' . $conn->error . '</div>';
                    }
                } else {
                    echo '<div class="alert alert-danger" role="alert">Error moving uploaded file.</div>';
                }
            }

            if ($images_to_upload < $total_images) {
                echo '<div class="alert alert-warning" role="alert">Only ' . $images_to_upload . ' images were uploaded due to the limit of 5 images per product.</div>';
            }
        } else {
            echo '<div class="d-flex justify-content-end"><div class="alert alert-warning" role="alert" style="width: 1000px;text-align:center;">This product already has the maximum number of 5 images. Please delete some images before uploading new ones.</div></div>';
        }
    } else {
        echo '<div class="alert alert-warning" role="alert">Invalid product selected.</div>';
    }
}

// Delete image handler
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['image_id'])) {
    $image_id = $_POST['image_id'];

    // Perform deletion from database and filesystem
    $sql_select = "SELECT id, image_path FROM product_images WHERE id = $image_id";
    $result_select = $conn->query($sql_select);

    if ($result_select->num_rows > 0) {
        $row = $result_select->fetch_assoc();
        $image_path = $row['image_path'];

        // Delete from filesystem
        if (unlink($image_path)) {
            // Delete from database
            $sql_delete = "DELETE FROM product_images WHERE id = $image_id";
            if ($conn->query($sql_delete)) {
                echo '<div class="d-flex justify-content-end"><div class="alert alert-success" role="alert" style="width: 300px;text-align:center;">Image deleted successfully</div></div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">Error deleting image: ' . $conn->error . '</div>';
            }
        } else {
            echo '<div class="alert alert-danger" role="alert">Error deleting image file.</div>';
        }
    } else {
        echo '<div class="alert alert-warning" role="alert">Image not found.</div>';
    }
}

// Fetch products based on gender and category
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['gender']) && isset($_GET['category'])) {
    $gender = $_GET['gender'];
    $category = $_GET['category'];

    $sql_fetch = "SELECT id, name FROM products WHERE gender = '$gender' AND category = '$category'";
    $result_fetch = $conn->query($sql_fetch);

    $products = array();
    if ($result_fetch->num_rows > 0) {
        while ($row = $result_fetch->fetch_assoc()) {
            $products[] = array(
                'id' => $row['id'],
                'name' => $row['name']
            );
        }
    }

    header('Content-Type: application/json');
    echo json_encode($products);
    exit();
}

// Fetch images handler for AJAX request
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Fetch images from database
    $sql_fetch = "SELECT id, image_path FROM product_images WHERE product_id = $product_id";
    $result_fetch = $conn->query($sql_fetch);

    $images = array();
    if ($result_fetch->num_rows > 0) {
        while ($row = $result_fetch->fetch_assoc()) {
            $images[] = array(
                'id' => $row['id'],
                'image_path' => $row['image_path']
            );
        }
    }

    header('Content-Type: application/json');
    echo json_encode($images);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Product Images</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <style>
        .product-image {
            max-width: 100px;
            max-height: 100px;
            margin: 5px;
        }

        .image-container {
            display: inline-block;
            text-align: center;
            margin: 10px;
        }

        .selected {
            outline: 2px solid red; /* Red outline for selected image */
        }
    </style>
</head>

<body>
    <?php include 'navbar.php'; ?>
    <header>
        <h1>Add Product Images</h1>
    </header>
    <div class="container">
        <form action="AddProductImages.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="gender" class="form-label">Gender:</label>
                <select name="gender" id="gender" class="form-select" onchange="updateProducts()" required>
                    <option value="">Select Gender</option>
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category:</label>
                <select name="category" id="category" class="form-select" onchange="updateProducts()" required>
                    <option value="">Select Category</option>
                    <!-- Populate categories dynamically from database -->
                    <?php
                    $sql = "SELECT DISTINCT category FROM products";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['category'] . "'>" . $row['category'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="product_id" class="form-label">Select Product:</label>
                <select name="product_id" id="product_id" class="form-select" required>
                    <option value="">Select Product</option>
                    <!-- Products will be updated dynamically -->
                </select>
            </div>
            <div class="mb-3">
                <label for="images" class="form-label">Product Images:</label>
                <input type="file" id="images" name="images[]" class="form-control" multiple accept="image/*" required>
            </div>
            <button type="submit" name="upload" class="btn btn-primary">Add Images</button>
            <button type="button" class="btn btn-secondary ms-2" onclick="showImages()">Show Images</button>
        </form>
        <div id="imagesDiv" class="mt-3"></div>
        <button id="deleteBtn" class="btn btn-danger mt-3" style="display:none;" onclick="deleteSelectedImage()">Delete Selected Image</button>
    </div>

    <script>
        function updateProducts() {
            var gender = document.getElementById('gender').value;
            var category = document.getElementById('category').value;

            if (gender && category) {
                fetch('AddProductImages.php?gender=' + gender + '&category=' + category)
                    .then(response => response.json())
                    .then(data => {
                        var productSelect = document.getElementById('product_id');
                        productSelect.innerHTML = '<option value="">Select Product</option>';
                        if (data.length > 0) {
                            data.forEach(product => {
                                var option = document.createElement('option');
                                option.value = product.id;
                                option.textContent = product.name;
                                productSelect.appendChild(option);
                            });
                        } else {
                            productSelect.innerHTML = '<option value="">No products available</option>';
                        }
                    })
                    .catch(error => console.error('Error fetching products:', error));
            }
        }

        function showImages() {
            var productId = document.getElementById('product_id').value;
            if (productId) {
                fetch('AddProductImages.php?product_id=' + productId)
                    .then(response => response.json())
                    .then(data => {
                        var imagesDiv = document.getElementById('imagesDiv');
                        imagesDiv.innerHTML = '';
                        if (data.length > 0) {
                            data.forEach(image => {
                                var imgContainer = document.createElement('div');
                                imgContainer.className = 'image-container';

                                var img = document.createElement('img');
                                img.src = image.image_path;
                                img.className = 'product-image';
                                img.dataset.imageId = image.id; // Set data attribute for image id

                                img.addEventListener('click', function() {
                                    var selectedImage = document.querySelector('.selected');
                                    if (selectedImage) {
                                        selectedImage.classList.remove('selected');
                                    }
                                    this.classList.add('selected');
                                    document.getElementById('deleteBtn').style.display = 'block';
                                });

                                imgContainer.appendChild(img);
                                imagesDiv.appendChild(imgContainer);
                            });
                        } else {
                            imagesDiv.innerHTML = 'No images found for this product.';
                            document.getElementById('deleteBtn').style.display = 'none';
                        }
                    })
                    .catch(error => console.error('Error fetching images:', error));
            } else {
                alert('Please select a product to show images.');
            }
        }

        function deleteSelectedImage() {
            var selectedImage = document.querySelector('.selected');
            if (selectedImage) {
                var imageId = selectedImage.dataset.imageId;
                if (confirm('Are you sure you want to delete this image?')) {
                    fetch('AddProductImages.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: 'image_id=' + encodeURIComponent(imageId)
                        })
                        .then(response => response.text())
                        .then(data => {
                            showImages(); // Refresh image display
                        })
                        .catch(error => {
                            alert('Error deleting image. Please try again later.');
                        });
                }
            } else {
                alert('Please select an image to delete.');
            }
        }
    </script>
</body>

</html>

