<?php
// Include database configuration
include './configdb.php';
session_start();
$name = $_SESSION['name'];
if (empty($_SESSION['name'])) {
    header("Location: /o-dinor_back/login.php");
}
// Handle image uploads
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['upload'])) {
    $product_id = $_POST['product_id'];

    //Handle image uploads
    if (isset($_FILES['images'])) {
        $uploads_dir = '../o-Dinor_back/uploads';
        if (!is_dir($uploads_dir)) {
            mkdir($uploads_dir, 0777, true);
        }

        $total_images = count($_FILES['images']['name']);
        for ($i = 0; $i < $total_images && $i < 10; $i++) { // Limit to 10 images
            $image_name = $_FILES['images']['name'][$i];
            $image_tmp_name = $_FILES['images']['tmp_name'][$i];
            $image_path = $uploads_dir . '/' . basename($image_name);

            if (move_uploaded_file($image_tmp_name, $image_path)) {
                // Insert image path into the database
                $sql = "INSERT INTO product_images (product_id, image_path) VALUES ($product_id, '$image_path')";
                if ($conn->query($sql)) {
                    echo '<div class="d-flex justify-content-end"><div class="alert alert-success m-1" role="alert" style="width: 300px;text-align:center;z-index:10;">New image added successfully!</div></div>';
                } else {
                    echo "Error uploading image: " . $conn->error;
                }
            } else {
                echo "Error moving uploaded file";
            }
        }
    } else {
        echo "No images selected";
    }
}

// Delete image handler
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['image_id'])) {
    $image_id = $_POST['image_id'];

    // Perform deletion from database and filesystem if required
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
                echo '<div class="d-flex justify-content-end"><div class="alert alert-success m-1" role="alert" style="width: 300px;text-align:center;">Image deleted successfully</div></div>';
            } else {
                echo "Error deleting image: " . $conn->error;
            }
        } else {
            echo "Error deleting image file";
        }
    } else {
        echo "Image not found";
    }
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
    exit;
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
            outline: 2px solid red;
            /* Red outline for selected image */
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
            <ul type="none">
                <li>
                    <label for="product_id" class="col-sm-3 col-form-label">Select Product:</label>
                    <select name="product_id" id="product_id" class="w-50" required>
                        <option value="">Select Product</option>
                        <?php
                        $sql = "SELECT id, name FROM products";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                            }
                        } else {
                            echo "<option value=''>No products available</option>";
                        }
                        ?>
                    </select>
                </li>
                <li>
                    <label for="images" class="col-sm-3 col-form-label">Product Images:</label>
                    <input type="file" id="images" name="images[]" class="w-50" multiple accept="image/*" required>
                </li>
            </ul>
            <div class="d-flex justify-content-end">
                <button type="submit" name="upload" class="btn btn-primary">Add Images</button>
                <button type="button" onclick="showImages()" class="btn btn-secondary ms-2">Show Images</button>
            </div>
        </form>
        <div id="imagesDiv" class="mt-3"></div>
        <button id="deleteBtn" class="btn btn-danger mt-3" style="display:none;" onclick="deleteSelectedImage()">Delete Selected Image</button>
    </div>

    <script>
        function showPopup(message) {
            alert(message);
            window.location.href = 'AddProductImages.php';
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
                        .then(response => {
                            if (response.ok) {
                                return response.text();
                            }
                            throw new Error('Network response was not ok.');
                        })
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