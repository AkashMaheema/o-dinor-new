<?php
// Include database configuration file
include './configdb.php';
session_start();
$name = $_SESSION['name'];
if (empty($_SESSION['name'])) {
    header("Location: /o-dinor_back/login.php");
}
// Fetch all stocks along with product names
$stocksQuery = "
    SELECT sp.id, p.name AS product_name, sp.quantity_sold, sp.sold_at
    FROM sold_products sp
    JOIN products p ON sp.product_id = p.id
";
$stocksResult = $conn->query($stocksQuery);
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
        <h1>Sales</h1>
    </header>
    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>sold_at</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($stocksResult->num_rows > 0) : ?>
                    <?php while ($row = $stocksResult->fetch_assoc()) : ?>
                        <tr>
                            <td><?= $row['id']; ?></td>
                            <td><?= $row['product_name']; ?></td>
                            <td><?= $row['quantity_sold']; ?></td>
                            <td><?= $row['sold_at']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="5">No stocks available.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>

<?php $conn->close(); ?>