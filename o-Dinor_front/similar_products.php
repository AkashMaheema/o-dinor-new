<?php
include './configdb.php';

$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch similar products based on category or other criteria
$sql = "SELECT p.*, GROUP_CONCAT(pi.image_path) AS images FROM products p 
        LEFT JOIN product_images pi ON p.id = pi.product_id 
        WHERE p.id != ? 
        GROUP BY p.id 
        LIMIT 5"; // Adjust the limit as needed
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

$similarProducts = [];

while ($row = $result->fetch_assoc()) {
    $row['images'] = explode(',', $row['images']);
    $similarProducts[] = $row;
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($similarProducts);
?>
