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
$totalResultsQuery = "SELECT COUNT(*) as total FROM customers";
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

// Determine the sql LIMIT starting number for the results on the displaying page
$offset = ($page - 1) * $resultsPerPage;

// Fetch limited records with pagination
$checkoutQuery = "SELECT * FROM customers LIMIT $offset, $resultsPerPage";
$checkoutResult = $conn->query($checkoutQuery);

?>

<!DOCTYPE html>
<html>

<head>
    <title>View Stocks</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <?php include 'navbar.php'; ?>
    <header>
        <h1>Check Out Details</h1>
    </header>
    <div class="container">
    <table class="table table-striped" style="height: 100vh; overflow: auto;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer Name</th>
                <th>Address</th>
                <th>Phone Number</th>
                <th>Email</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php if ($checkoutResult->num_rows > 0) : ?>
                <?php while ($row = $checkoutResult->fetch_assoc()) : ?>
                    <tr>
                        <td><?= $row['id']; ?></td>
                        <td><?= $row['first_name']; ?> &nbsp;<?= $row['last_name']; ?></td>
                        <td><?= $row['street_address']; ?>&nbsp;<?= $row['apartment']; ?>&nbsp;<?= $row['city']; ?>&nbsp;<?= $row['country']; ?>&nbsp;<?= $row['postcode']; ?></td>
                        <td><?= $row['phone']; ?></td>
                        <td><?= $row['email']; ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else : ?>
                <tr>
                    <td colspan="5">No stocks available.</td>
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