<?php
// Include database connection
include 'configdb.php';
session_start();
$name = $_SESSION['name'];
if (empty($_SESSION['name'])) {
    header("Location: login.php");
}

// Define the number of results per page
$resultsPerPage = 10;

// Find out the total number of orders
$totalOrdersQuery = "SELECT COUNT(*) as total FROM orders";
$totalOrdersResult = $conn->query($totalOrdersQuery);
$totalOrders = $totalOrdersResult->fetch_assoc()['total'];

// Determine the total number of pages available
$totalPages = ceil($totalOrders / $resultsPerPage);

// Determine which page number visitor is currently on
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) {
    $page = 1;
} elseif ($page > $totalPages) {
    $page = $totalPages;
}

// Determine the SQL LIMIT starting number for the results on the displaying page
$offset = ($page - 1) * $resultsPerPage;

// Fetch orders with pagination
$ordersQuery = "SELECT * FROM orders LIMIT $offset, $resultsPerPage";
$ordersResult = $conn->query($ordersQuery);

if (!$ordersResult) {
    die("Query failed: " . $conn->error);
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Debugging output
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';

    $orderId = isset($_POST['order_id']) ? (int)$_POST['order_id'] : null;
    $action = isset($_POST['action']) ? $_POST['action'] : null;

    if ($orderId !== null && $action !== null) {
        if ($action == 'confirm') {
            // Update the order status to 'Confirmed'
            $updateOrderQuery = "UPDATE orders SET status = 'Confirmed' WHERE id = ?";
            $stmt = $conn->prepare($updateOrderQuery);

            if (!$stmt) {
                die("Prepare failed: " . $conn->error);
            }

            $stmt->bind_param('i', $orderId);
            $stmt->execute();

            // Reduce stock quantities for each product in the order
            $itemsQuery = "SELECT product_id, quantity, color, size FROM order_has_items WHERE order_id = ?";
            $stmt = $conn->prepare($itemsQuery);

            if (!$stmt) {
                die("Prepare failed: " . $conn->error);
            }

            $stmt->bind_param('i', $orderId);
            $stmt->execute();
            $itemsResult = $stmt->get_result();

            while ($item = $itemsResult->fetch_assoc()) {
                $productId = $item['product_id'];
                $quantity = $item['quantity'];
                $color = $item['color'];
                $size = $item['size'];

                // Update stock quantity
                $stockQuery = "SELECT quantity FROM stock WHERE product_id = ? AND color = ? AND size = ?";
                $stmt = $conn->prepare($stockQuery);

                if (!$stmt) {
                    die("Prepare failed: " . $conn->error);
                }

                $stmt->bind_param('iss', $productId, $color, $size);
                $stmt->execute();
                $stockResult = $stmt->get_result();

                if ($stockResult->num_rows > 0) {
                    $stock = $stockResult->fetch_assoc();
                    $newQuantity = $stock['quantity'] - $quantity;

                    if ($newQuantity >= 0) {
                        $updateStockQuery = "UPDATE stock SET quantity = ? WHERE product_id = ? AND color = ? AND size = ?";
                        $stmt = $conn->prepare($updateStockQuery);

                        if (!$stmt) {
                            die("Prepare failed: " . $conn->error);
                        }

                        $stmt->bind_param('iiss', $newQuantity, $productId, $color, $size);
                        $stmt->execute();
                    } else {
                        // Handle case where stock cannot fulfill the order
                        $message = "Insufficient stock for Product ID $productId, Color: $color, Size: $size.";
                    }
                }
            }

            $stmt->close();
            if (!isset($message)) {
                $message = 'Order confirmed successfully';
            }
        } elseif ($action == 'reject') {
            // Update the order status to 'Rejected'
            $updateOrderQuery = "UPDATE orders SET status = 'Rejected' WHERE id = ?";
            $stmt = $conn->prepare($updateOrderQuery);

            if (!$stmt) {
                die("Prepare failed: " . $conn->error);
            }

            $stmt->bind_param('i', $orderId);
            $stmt->execute();

            // Remove the order from the orders table and order_has_items table
            $deleteOrderQuery = "DELETE FROM orders WHERE id = ?";
            $stmt = $conn->prepare($deleteOrderQuery);

            if (!$stmt) {
                die("Prepare failed: " . $conn->error);
            }

            $stmt->bind_param('i', $orderId);
            $stmt->execute();

            $deleteItemsQuery = "DELETE FROM order_has_items WHERE order_id = ?";
            $stmt = $conn->prepare($deleteItemsQuery);

            if (!$stmt) {
                die("Prepare failed: " . $conn->error);
            }

            $stmt->bind_param('i', $orderId);
            $stmt->execute();

            $stmt->close();
            $message = 'Order rejected and removed successfully';
        } else {
            // Invalid action
            $message = 'Invalid action';
        }
    } else {
        $message = 'Required parameters are missing.';
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Admin Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <?php include 'navbar.php'; ?>
    <header>
        <h1>Manage Orders</h1>
    </header>
    <div class="container">
        <?php if (isset($message)) : ?>
            <div class="alert alert-info"><?= htmlspecialchars($message); ?></div>
        <?php endif; ?>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer ID</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Order Items</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($ordersResult->num_rows > 0) :
                    while ($row = $ordersResult->fetch_assoc()) :
                        $orderId = $row['id'];
                        // Fetch order items
                        $itemsQuery = "SELECT p.name, ohi.quantity, ohi.color, ohi.size 
                                       FROM order_has_items ohi
                                       JOIN products p ON ohi.product_id = p.id
                                       WHERE ohi.order_id = ?";
                        $stmt = $conn->prepare($itemsQuery);
                        $stmt->bind_param('i', $orderId);
                        $stmt->execute();
                        $itemsResult = $stmt->get_result();
                        
                        $itemsList = [];
                        while ($item = $itemsResult->fetch_assoc()) {
                            $itemsList[] = $item['name'] . " (Qty: " . $item['quantity'] . ", Color: " . $item['color'] . ", Size: " . $item['size'] . ")";
                        }
                        $itemsListStr = implode('<br>', $itemsList);
                ?>
                        <tr>
                            <td><?= htmlspecialchars($row['id']); ?></td>
                            <td><?= htmlspecialchars($row['customer_id']); ?></td>
                            <td><?= htmlspecialchars($row['created_at']); ?></td>
                            <td><?= htmlspecialchars($row['status']); ?></td>
                            <td><?= $itemsListStr; ?></td>
                            <td>
                                <?php if ($row['status'] !== 'Confirmed') : ?>
                                    <form method="post" action="">
                                        <input type="hidden" name="order_id" value="<?= htmlspecialchars($row['id']); ?>">
                                        <button type="submit" name="action" value="confirm" class="btn btn-success btn-sm">Confirm</button>
                                        <button type="submit" name="action" value="reject" class="btn btn-danger btn-sm">Reject</button>
                                    </form>
                                <?php else : ?>
                                    <span class="badge bg-success">Confirmed</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="6">No orders available.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Pagination Controls -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=<?= $page - 1 ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                    <li class="page-item <?= $page == $i ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item <?= $page >= $totalPages ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=<?= $page + 1 ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</body>

</html>

<?php $conn->close(); ?>
