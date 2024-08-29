<?php
// Include database configuration file
include './configdb.php';
session_start();
$name = $_SESSION['name'];
if (empty($_SESSION['name'])) {
    header("Location: /o-dinor_back/login.php");
}

// Fetch unique genders from products
$gendersQuery = "SELECT DISTINCT gender FROM products";
$gendersResult = $conn->query($gendersQuery);

// Fetch unique categories from products
$categoriesQuery = "SELECT DISTINCT category FROM products";
$categoriesResult = $conn->query($categoriesQuery);

// Fetch products based on selected gender and category
$productsResult = null;
if (isset($_GET['gender']) && isset($_GET['category'])) {
    $gender = $_GET['gender'];
    $category = $_GET['category'];

    $productsQuery = "SELECT id, name FROM products WHERE gender='$gender' AND category='$category'";
    $productsResult = $conn->query($productsQuery);
}

// Fetch sizes and colors based on the selected product
$sizesResult = $colorsResult = null;
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    $sizesQuery = "SELECT id, size FROM product_sizes WHERE product_id=$product_id";
    $sizesResult = $conn->query($sizesQuery);

    $colorsQuery = "SELECT id, color FROM product_colors WHERE product_id=$product_id";
    $colorsResult = $conn->query($colorsQuery);
}

// Add stock to the database
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    $size = $_POST['size'];
    $color = $_POST['color'];
    $quantity = $_POST['quantity'];

    $insertStockQuery = "INSERT INTO stock (product_id, size, color, quantity) VALUES ($product_id, '$size', '$color', $quantity)";

    if ($conn->query($insertStockQuery) === TRUE) {
        echo '<div class="d-flex justify-content-end"><div class="alert alert-success m-1" role="alert" style="width: 300px;text-align:center;">New Stock added successfully!</div></div>';
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Stock</title>
    <script>
        function fetchProducts() {
            var gender = document.getElementById('gender').value;
            var category = document.getElementById('category').value;
            window.location.href = 'add_stock.php?gender=' + gender + '&category=' + category;
        }

        function fetchSizesAndColors() {
            var product_id = document.getElementById('product').value;
            window.location.href = 'add_stock.php?gender=<?= $_GET['gender'] ?? '' ?>&category=<?= $_GET['category'] ?? '' ?>&product_id=' + product_id;
        }
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <?php include 'navbar.php'; ?>
    <header>
        <h1>Add Stock</h1>
    </header>
    <div class="container">
        <form method="POST">
            <div class="form-group row">
                <label for="gender" class="col-sm-3 col-form-label">Select Gender</label>
                <div class="col-sm-10">
                    <select id="gender" name="gender" class="form-control" onchange="fetchProducts()">
                        <option value="">Select Gender</option>
                        <?php while ($row = $gendersResult->fetch_assoc()) : ?>
                            <option value="<?= $row['gender']; ?>" <?= (isset($_GET['gender']) && $_GET['gender'] == $row['gender']) ? 'selected' : ''; ?>>
                                <?= $row['gender']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="category" class="col-sm-3 col-form-label">Select Category</label>
                <div class="col-sm-10">
                    <select id="category" name="category" class="form-control" onchange="fetchProducts()">
                        <option value="">Select Category</option>
                        <?php while ($row = $categoriesResult->fetch_assoc()) : ?>
                            <option value="<?= $row['category']; ?>" <?= (isset($_GET['category']) && $_GET['category'] == $row['category']) ? 'selected' : ''; ?>>
                                <?= $row['category']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="product" class="col-sm-3 col-form-label">Select Product</label>
                <div class="col-sm-10">
                    <select id="product" name="product_id" class="form-control" onchange="fetchSizesAndColors()">
                        <option value="">Select Product</option>
                        <?php if ($productsResult) : ?>
                            <?php while ($row = $productsResult->fetch_assoc()) : ?>
                                <option value="<?= $row['id']; ?>" <?= (isset($_GET['product_id']) && $_GET['product_id'] == $row['id']) ? 'selected' : ''; ?>>
                                    <?= $row['name']; ?>
                                </option>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>

            <?php if ($sizesResult && $colorsResult) : ?>
                <div class="form-group row">
                    <label for="size" class="col-sm-3 col-form-label">Select Size</label>
                    <div class="col-sm-10">
                        <select id="size" name="size" class="form-control">
                            <option value="">Select Size</option>
                            <?php while ($row = $sizesResult->fetch_assoc()) : ?>
                                <option value="<?= $row['size']; ?>"><?= $row['size']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="color" class="col-sm-3 col-form-label">Select Color</label>
                    <div class="col-sm-10">
                        <?php if ($colorsResult) : ?>
                            <?php while ($row = $colorsResult->fetch_assoc()) : ?>
                                <div>
                                    <input type="radio" id="color_<?= $row['id']; ?>" name="color" value="<?= $row['color']; ?>" required>
                                    <label for="color_<?= $row['id']; ?>">
                                        <input type="color" class="form-control-color" value="<?= $row['color']; ?>" disabled>
                                    </label>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="quantity" class="col-sm-3 col-form-label">Quantity</label>
                    <div class="col-sm-10">
                        <input type="number" id="quantity" name="quantity" class="form-control" min="1" required>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-10 offset-sm-2">
                        <button type="submit" class="btn btn-primary">Add Stock</button>
                    </div>
                </div>
            <?php endif; ?>
        </form>
    </div>
</body>

</html>

<?php $conn->close(); ?>