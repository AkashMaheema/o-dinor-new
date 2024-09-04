<?php
// Include database configuration file
include './configdb.php';
session_start();
$name = $_SESSION['name'];
if (empty($_SESSION['name'])) {
    header("Location: login.php");
}

// Define the number of results per page
$resultsPerPage = 10;

// Find out the number of results stored in the database
$totalResultsQuery = "
    SELECT COUNT(*) as total 
    FROM orders o
    JOIN products p ON o.product_id = p.id
";
$totalResultsResult = $conn->query($totalResultsQuery);
$totalResults = $totalResultsResult->fetch_assoc()['total'];

// Determine the total number of pages available
$totalPages = ceil($totalResults / $resultsPerPage);

// Determine which page number visitor is currently on
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) {
    $page = 1;
} elseif ($page > $totalPages) {
    $page = $totalPages;
}

// Determine the SQL LIMIT starting number for the results on the displaying page
$offset = ($page - 1) * $resultsPerPage;

// Fetch limited records with pagination
$stocksQuery = "
    SELECT o.id, p.name AS product_name, o.checkout_id, o.quantity_sold, o.sold_at
    FROM orders o
    JOIN products p ON o.product_id = p.id
    LIMIT $offset, $resultsPerPage
";
$stocksResult = $conn->query($stocksQuery);
?>
<!DOCTYPE html>
<html>

<head>
    <title>View Sales</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <?php include 'navbar.php'; ?>
    <header>
        <h1>Sales</h1>
    </header>
    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Check Out ID</th>
                    <th>Quantity</th>
                    <th>Sold At</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($stocksResult->num_rows > 0) : ?>
                    <?php while ($row = $stocksResult->fetch_assoc()) : ?>
                        <tr>
                            <td><?= $row['id']; ?></td>
                            <td><?= $row['product_name']; ?></td>
                            <td><?= $row['checkout_id']; ?></td>
                            <td><?= $row['quantity_sold']; ?></td>
                            <td><?= $row['sold_at']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="5">No sales available.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <li class="page-item <?= $page <= 1 ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?page=<?= $page - 1; ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                    <li class="page-item <?= $i == $page ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a>
                    </li>
                <?php endfor; ?>

                <li class="page-item <?= $page >= $totalPages ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?page=<?= $page + 1; ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</body>

</html>

<?php $conn->close(); ?>
