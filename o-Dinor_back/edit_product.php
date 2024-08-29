<?php
include './configdb.php'; // Include your database connection script
session_start();
$name = $_SESSION['name'];
if (empty($_SESSION['name'])) {
    header("Location: /o-dinor_back/login.php");
}
// Check if product_id is provided via GET request
if (isset($_GET['product_id'])) {
    $product_id = intval($_GET['product_id']);
}

// Retrieve product details from the database
$sql = "SELECT * FROM products WHERE id = $product_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();
}

// Fetch existing sizes and colors for the product
$sizes_result = $conn->query("SELECT size FROM product_sizes WHERE product_id = $product_id");
$colors_result = $conn->query("SELECT color FROM product_colors WHERE product_id = $product_id");

$product['sizes'] = [];
$product['colors'] = [];

while ($row = $sizes_result->fetch_assoc()) {
    $product['sizes'][] = $row['size'];
}

while ($row = $colors_result->fetch_assoc()) {
    $product['colors'][] = $row['color'];
}

// Handle form submission (update or delete)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update'])) {
        // Update product details
        $name = $_POST['name'];
        $gender = $_POST['gender'];
        $category = $_POST['category'];
        $cost = $_POST['cost'];
        $rate = $_POST['rate'];
        $title = $_POST['title'];
        $description = $_POST['description'];

        // Update product details in the database
        $update_sql = "UPDATE products SET 
                               name = '$name', 
                               gender = '$gender', 
                               category = '$category', 
                               cost = '$cost', 
                               rate = '$rate', 
                               title = '$title', 
                               description = '$description' 
                               WHERE id = $product_id";

        if ($conn->query($update_sql) === TRUE) {
            echo '<div class="d-flex justify-content-end"><div class="alert alert-success m-1" role="alert" style="width: 300px;text-align:center;">Product updated successfully!</div></div>';

            // Update sizes
            $conn->query("DELETE FROM product_sizes WHERE product_id = $product_id");
            if (isset($_POST['size'])) {
                foreach ($_POST['size'] as $size) {
                    $size = $conn->real_escape_string($size);
                    $conn->query("INSERT INTO product_sizes (product_id, size) VALUES ($product_id, '$size')");
                }
            }

            // Update colors
            $conn->query("DELETE FROM product_colors WHERE product_id = $product_id");
            if (isset($_POST['color'])) {
                $valid_colors = array_filter($_POST['color'], function ($color) {
                    return $color !== '#000000'; // Filter out default color
                });
                foreach ($valid_colors as $color) {
                    $color = $conn->real_escape_string($color);
                    $conn->query("INSERT INTO product_colors (product_id, color) VALUES ($product_id, '$color')");
                }
            }
        } else {
            echo '<div class="alert alert-danger" role="alert">Error updating product: ' . $conn->error . '</div>';
        }
    } elseif (isset($_POST['delete'])) {
        // Delete product from the database
        $delete_sql = "DELETE FROM products WHERE id = $product_id";

        if ($conn->query($delete_sql) === TRUE) {
            echo '<div class="alert alert-success" role="alert">Product deleted successfully!</div>';
            // Redirect to view_products.php or any other page after deletion
            header('Location: view_products.php');
            exit;
        } else {
            echo '<div class="alert alert-danger" role="alert">Error deleting product: ' . $conn->error . '</div>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <?php include 'navbar.php'; ?>
    <header>
        <h1>Edit Product</h1>
    </header>

    <div class="container">
        <form action="edit_product.php?product_id=<?php echo $product_id; ?>" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="gender" class="form-label">Gender</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="genderM" value="M" <?php echo ($product['gender'] === 'M') ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="genderM">Male</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="genderF" value="F" <?php echo ($product['gender'] === 'F') ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="genderF">Female</label>
                </div>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-select" id="category" name="category" required>
                    <option value="Shirts" <?php echo ($product['category'] === 'Shirts') ? 'selected' : ''; ?>>Shirts</option>
                    <option value="T-Shirts" <?php echo ($product['category'] === 'T-Shirts') ? 'selected' : ''; ?>>T-Shirts</option>
                    <option value="Polos" <?php echo ($product['category'] === 'Polos') ? 'selected' : ''; ?>>Polos</option>
                    <option value="Shorts" <?php echo ($product['category'] === 'Shorts') ? 'selected' : ''; ?>>Shorts</option>
                    <option value="Jeans" <?php echo ($product['category'] === 'Jeans') ? 'selected' : ''; ?>>Jeans</option>
                    <option value="Trousers" <?php echo ($product['category'] === 'Trousers') ? 'selected' : ''; ?>>Trousers</option>
                    <option value="Blazers" <?php echo ($product['category'] === 'Blazers') ? 'selected' : ''; ?>>Blazers</option>
                    <option value="Jackets" <?php echo ($product['category'] === 'Jackets') ? 'selected' : ''; ?>>Jackets</option>
                    <option value="Shoes" <?php echo ($product['category'] === 'Shoes') ? 'selected' : ''; ?>>Shoes</option>
                    <option value="Accessories" <?php echo ($product['category'] === 'Accessories') ? 'selected' : ''; ?>>Accessories</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="size" class="form-label">Size</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="size[]" id="sizeS" value="S" <?php echo in_array('S', $product['sizes']) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="sizeS">S</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="size[]" id="sizeM" value="M" <?php echo in_array('M', $product['sizes']) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="sizeM">M</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="size[]" id="sizeL" value="L" <?php echo in_array('L', $product['sizes']) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="sizeL">L</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="size[]" id="sizeXL" value="XL" <?php echo in_array('XL', $product['sizes']) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="sizeXL">XL</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="size[]" id="sizeXXL" value="XXL" <?php echo in_array('XXL', $product['sizes']) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="sizeXXL">XXL</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="size[]" id="sizeXXXL" value="XXXL" <?php echo in_array('XXXL', $product['sizes']) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="sizeXXXL">XXXL</label>
                </div>
            </div>
            <div class="mb-3">
                <label for="color" class="form-label">Color</label><br>
                <?php
                // Show existing colors
                $color_count = max(5, count($product['colors']));
                for ($i = 1; $i <= $color_count; $i++) {
                    $color_id = "color$i";
                    $color_value = isset($product['colors'][$i - 1]) ? htmlspecialchars($product['colors'][$i - 1]) : '#000000';
                    echo "<div class=\"form-check form-check-inline\">
                            <input type=\"color\" id=\"$color_id\" name=\"color[]\" class=\"form-control form-control-color\" value=\"$color_value\">
                          </div>";
                }
                ?>
            </div>
            <div class="mb-3">
                <label for="cost" class="form-label">Cost</label>
                <input type="number" class="form-control" id="cost" name="cost" value="<?php echo htmlspecialchars($product['cost']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="rate" class="form-label">Rate</label>
                <input type="number" class="form-control" id="rate" name="rate" value="<?php echo htmlspecialchars($product['rate']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($product['title']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" required><?php echo htmlspecialchars($product['description']); ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="update">Update Product</button>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete Product</button>
        </form>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this product?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="edit_product.php?product_id=<?php echo $product_id; ?>" method="post">
                        <button type="submit" class="btn btn-danger" name="delete">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer class="d-flex justify-content-end">
        <a href="view_products.php" class="btn btn-secondary mt-3 m-5">Back to Products</a>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

</body>

</html>