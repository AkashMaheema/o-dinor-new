<?php
include './configdb.php';

$gender = isset($_GET['gender']) ? $_GET['gender'] : '';
$category = isset($_GET['category']) ? $_GET['category'] : '';

// Fetch products from the database filtered by category
$sql = "SELECT p.*, GROUP_CONCAT(pi.image_path) AS images,
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
        WHERE p.gender = ? AND p.category = ?
        GROUP BY p.id";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $gender, $category);
$stmt->execute();
$result = $stmt->get_result();

$products = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $row['images'] = explode(',', $row['images']);
        $products[] = $row;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/shop.css" />


</head>

<body>
    <?php include 'navbar.php'; ?>
    <div class="container mt-5">
        <h1 class="title mb-4 "><?php echo htmlspecialchars($category); ?></h1>

        <!-- Render the product data as hidden JSON -->
        <div id="product-data" style="display:none;">
            <?php echo json_encode($products); ?>
        </div>

        <!-- Filter inputs -->
        <div class="filter">
            <div class="SearchbyName">
                <input type="text" id="search-name" class="form-control form-check-name" placeholder="Search by name">
            </div>
            <div class="col-md-3">
                <div class="filterByPrice">
                        <input type="number" id="search-price-min" class="form-control min_price" placeholder="Min price">
                        <input type="number" id="search-price-max" class="form-control max_price" placeholder="Max price">
                </div>
            </div>
        </div>

        <div id="product-list" class="row row-cols-1 row-cols-md-3 g-4">
            <!-- JavaScript will render products here -->
        </div>
    </div>
    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const productData = JSON.parse(document.getElementById('product-data').textContent);
        const productList = document.getElementById('product-list');
        const searchName = document.getElementById('search-name');
        const searchPriceMin = document.getElementById('search-price-min');
        const searchPriceMax = document.getElementById('search-price-max');

        function renderProducts(products) {
            const screenWidth = window.innerWidth;
            productList.innerHTML = '';

            products.forEach(product => {
                const firstImage = product.images[0] || 'default_image.jpg';
                
                // Determine the column class based on screen width
                let colClass = 'col-md-3 mb-3'; // default for medium and larger screens
                if (screenWidth < 1200) {
                    colClass = 'col-md-12 mb-4'; // for smaller screens
                }

                productList.innerHTML += `
                <div class="${colClass}">
                    <a href="detail.php?id=${product.id}&category=${product.category}">
                    <div class="card">
                        <div class="img-body">
                            <img src="${firstImage}" class="" alt="${product.name}">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">${product.name}</h5>
                            <p class="card-text">LKR ${product.lowest_rate}</p>
                        </div>
                    </div>
                    </a>
                </div>
            `;
            });
        }

        function filterProducts() {
            const searchTermName = searchName.value.toLowerCase();
            const minPrice = parseFloat(searchPriceMin.value);
            const maxPrice = parseFloat(searchPriceMax.value);

            const filteredProducts = productData.filter(product =>
                (!searchTermName || product.name.toLowerCase().includes(searchTermName)) &&
                (!minPrice || product.lowest_rate >= minPrice) &&
                (!maxPrice || product.lowest_rate <= maxPrice)
            );
            renderProducts(filteredProducts);
        }

        // Initial render
        renderProducts(productData);

        // Add event listeners to filter inputs
        searchName.addEventListener('input', filterProducts);
        searchPriceMin.addEventListener('input', filterProducts);
        searchPriceMax.addEventListener('input', filterProducts);

        // Event listener for window resize to update layout
        window.addEventListener('resize', function() {
            renderProducts(productData);
        });
    });
</script>

</body>

</html>