<?php
include './configdb.php'; // Include your database connection script
session_start();
$name = $_SESSION['name'];
if (empty($_SESSION['name'])) {
    header("Location: login.php");
    exit;
}

// Check if product_id is provided via GET request
if (isset($_GET['product_id'])) {
    $product_id = intval($_GET['product_id']);
} else {
    header('Location: view_products.php');
    exit;
}

// Retrieve product details from the database
$sql = "SELECT * FROM products WHERE id = $product_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();
} else {
    header('Location: view_products.php');
    exit;
}

// Fetch existing sizes and colors for the product
$sizes_result = $conn->query("SELECT size, cost, rate FROM product_sizes WHERE product_id = $product_id");
$colors_result = $conn->query("SELECT color FROM product_colors WHERE product_id = $product_id");

$product['sizes'] = [];
$product['colors'] = [];

while ($row = $sizes_result->fetch_assoc()) {
    $product['sizes'][$row['size']] = ['cost' => $row['cost'], 'rate' => $row['rate']];
}

while ($row = $colors_result->fetch_assoc()) {
    $product['colors'][] = $row['color'];
}

// Handle form submission (update or delete)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update'])) {
        // Update product details
        $name = $conn->real_escape_string($_POST['name']);
        $gender = $conn->real_escape_string($_POST['gender']);
        $category = $conn->real_escape_string($_POST['category']);
        $title = $conn->real_escape_string($_POST['title']);
        $description = $conn->real_escape_string($_POST['description']);

        // Update product details in the database
        $update_sql = "UPDATE products SET 
                       name = '$name', 
                       gender = '$gender', 
                       category = '$category', 
                       title = '$title', 
                       description = '$description' 
                       WHERE id = $product_id";

        if ($conn->query($update_sql) === TRUE) {
            echo '<div class="d-flex justify-content-end"><div class="alert alert-success m-1" role="alert" style="width: 300px;text-align:center;">Product updated successfully!</div></div>';

            // Update sizes
            $sizes = ['S', 'M', 'L', 'XL', 'XXL', 'XXXL'];
            foreach ($sizes as $size) {
                if (isset($_POST['size']) && in_array($size, $_POST['size'])) {
                    $cost = $conn->real_escape_string($_POST['cost_' . $size]);
                    $rate = $conn->real_escape_string($_POST['rate_' . $size]);

                    // Check if the size already exists
                    $size_exists_query = "SELECT * FROM product_sizes WHERE product_id = $product_id AND size = '$size'";
                    $size_exists_result = $conn->query($size_exists_query);

                    if ($size_exists_result->num_rows > 0) {
                        // Update the existing size
                        $update_size_sql = "UPDATE product_sizes SET cost = '$cost', rate = '$rate' WHERE product_id = $product_id AND size = '$size'";
                        $conn->query($update_size_sql);
                    } else {
                        // Insert the new size
                        $insert_size_sql = "INSERT INTO product_sizes (product_id, size, cost, rate) VALUES ($product_id, '$size', '$cost', '$rate')";
                        $conn->query($insert_size_sql);
                    }
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
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
                <input type="text" class="form-control" id="name" name="name"
                       value="<?php echo htmlspecialchars($product['name']); ?>" required>
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
                <label for="size" class="form-label">Size</label>
                <div class="mb-3">
                    <?php
                    $sizes = ['S', 'M', 'L', 'XL', 'XXL', 'XXXL'];
                    foreach ($sizes as $size) {
                        $checked = isset($product['sizes'][$size]) ? 'checked' : '';
                        $cost = isset($product['sizes'][$size]['cost']) ? $product['sizes'][$size]['cost'] : '';
                        $rate = isset($product['sizes'][$size]['rate']) ? $product['sizes'][$size]['rate'] : '';
                        echo '<div class="d-flex align-items-center mb-2">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="size[]" id="size' . $size . '" value="' . $size . '" ' . $checked . '>
                                    <label class="form-check-label" for="size' . $size . '">' . $size . '</label>
                                </div>
                                <input type="number" name="cost_' . $size . '" placeholder="Cost" class="form-control form-control-sm mx-2" value="' . htmlspecialchars($cost) . '">
                                <input type="number" name="rate_' . $size . '" placeholder="Rate" class="form-control form-control-sm" value="' . htmlspecialchars($rate) . '">
                              </div>';
                    }
                    ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="color" class="form-label">Color</label><br>
                <?php
                // Prepare color inputs with existing colors or default values
                $colorInputs = array_merge($product['colors'], array_fill(0, 5 - count($product['colors']), '#000000'));

                for ($i = 0; $i < 5; $i++) {
                    echo '<div class="form-check form-check-inline">
                            <input type="color" id="color' . ($i + 1) . '" name="color[]" 
                            value="' . htmlspecialchars($colorInputs[$i]) . '" 
                            class="form-control form-control-color">
                          </div>';
                }
                ?>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($product['title']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"><?php echo htmlspecialchars($product['description']); ?></textarea>
            </div>
            <button type="submit" name="update" class="btn btn-primary">Update</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-oBqDVmMz00wbI+Kj6C1J6iL6ZcKpP2I9PZ6pf8zWjV+WujwodR+oQNh89R1IqmnH" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
            integrity="sha384-qrb6k8HO3rr9eJfOHB0SB+86kM7p7GoM81ikqPHacmmAuNJTYZCptatwi/7x9ru5" crossorigin="anonymous"></script>
</body>

</html>
