<?php
include './configdb.php'; // Include your database connection script
session_start();
$name = $_SESSION['name'];
if (empty($_SESSION['name'])) {
    header("Location: /o-dinor_back/login.php");
}

// Retrieve all products without any search filtering
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

// Function to get the lowest cost for a product
function getLowestCost($product_id, $conn) {
    $sql_sizes = "SELECT MIN(cost) as lowest_cost FROM product_sizes WHERE product_id = $product_id";
    $result_sizes = $conn->query($sql_sizes);

    if ($result_sizes->num_rows > 0) {
        $row = $result_sizes->fetch_assoc();
        return $row['lowest_cost'];
    }

    return null; // If no sizes are found
}

// Handle product deletion
if (isset($_POST['delete'])) {
    $product_id = $_POST['product_id'];

    // Delete product from the database
    $delete_sql = "DELETE FROM products WHERE id = $product_id";

    if ($conn->query($delete_sql) === TRUE) {
        echo '<div class="alert alert-success" role="alert">Product deleted successfully!</div>';
        header('Location: view_products.php');
        exit;
    } else {
        echo '<div class="alert alert-danger" role="alert">Error deleting product: ' . $conn->error . '</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View All Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/view_product.css">
</head>

<body>
    <?php include 'navbar.php'; ?>
    <header>
        <h1>View All Products</h1>
    </header>

    <div class="container">
        <!-- Search Form -->
        <form class="d-flex mb-4">
            <div class="SearchbyName">
                <input class="form-control me-2" type="search" id="searchInput" placeholder="Search by name" aria-label="Search">
            </div>
        </form>

        <div class="row" id="productContainer">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $lowest_cost = getLowestCost($row['id'], $conn); // Get the lowest cost for the product

                    echo '<div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4 product-card" data-name="' . strtolower($row['name']) . '">';
                    echo '<div class="card">';

                    // Display product image (adjust path as per your setup)
                    $image_path = './uploads/default.jpg'; // Replace with actual path
                    $sql_images = "SELECT image_path FROM product_images WHERE product_id = " . $row['id'] . " LIMIT 1";
                    $result_images = $conn->query($sql_images);

                    if ($result_images->num_rows > 0) {
                        $image_path = $result_images->fetch_assoc()['image_path'];
                    }

                    echo '<img src="' . $image_path . '" class="image card-img-top" alt="Product Image">';

                    echo '<div class="card-body">';
                    echo '<div class="card-txts">';
                    echo '<h5 class="card-title">' . $row['name'] . '</h5>';
                    echo '<p class="card-text"><strong>Category:</strong> ' . $row['category'] . '</p>';
                    echo '<p class="card-text"><strong>Gender:</strong> ' . $row['gender'] . '</p>';
                    echo '<p class="card-text"><strong>Lowest Cost:</strong> LKR ' . number_format($lowest_cost, 2) . '</p>';
                    echo '</div>';
                    echo '<div class="card-btns">';
                    echo '<a href="product_view.php?product_id=' . $row['id'] . '" class="btn btn-info m-1">View</a>';
                    echo '<a href="edit_product.php?product_id=' . $row['id'] . '" class="btn btn-primary m-1">Edit</a>';
                    echo '<button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#deleteModal-' . $row['id'] . '">Delete</button>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';

                    // Delete Modal
                    echo '<div class="modal fade" id="deleteModal-' . $row['id'] . '" tabindex="-1" aria-labelledby="deleteModalLabel-' . $row['id'] . '" aria-hidden="true">';
                    echo '<div class="modal-dialog">';
                    echo '<div class="modal-content">';
                    echo '<div class="modal-header">';
                    echo '<h5 class="modal-title" id="deleteModalLabel-' . $row['id'] . '">Confirm Deletion</h5>';
                    echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                    echo '</div>';
                    echo '<div class="modal-body">';
                    echo 'Are you sure you want to delete this product?';
                    echo '</div>';
                    echo '<div class="modal-footer">';
                    echo '<button type="button" class="btn " data-bs-dismiss="modal">Cancel</button>';
                    echo '<form action="view_products.php" method="post">';
                    echo '<input type="hidden" name="product_id" value="' . $row['id'] . '">';
                    echo '<button type="submit" class="btn" name="delete">Delete</button>';
                    echo '</form>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<div class="col">';
                echo '<p>No products found.</p>';
                echo '</div>';
            }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('searchInput');
            const productCards = document.querySelectorAll('.product-card');

            searchInput.addEventListener('input', function () {
                const searchTerm = searchInput.value.toLowerCase();

                productCards.forEach(card => {
                    const productName = card.getAttribute('data-name');
                    if (productName.includes(searchTerm)) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    </script>
</body>

</html>

<?php
$conn->close(); // Close the database connection
?>
