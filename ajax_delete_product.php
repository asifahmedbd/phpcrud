<?php
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productId = $_POST['product_id'] ?? null;

    if ($productId) {
        $sql = "DELETE FROM products WHERE id = ?";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("i", $productId);

            if ($stmt->execute()) {
                echo json_encode(['status' => 'success', 'message' => 'Product deleted successfully']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to delete product']);
            }

            $stmt->close();
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to prepare the statement']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid product ID']);
    }

    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
