<?php
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the posted data
    $productId = $_POST['product_id'] ?? null;
    $productName = $_POST['product_name'] ?? null;
    $productSKU = $_POST['product_sku'] ?? null;
    $productPrice = $_POST['product_price'] ?? null;

    // Validate the data (add more validation as needed)
    if ($productId && $productName && $productSKU && $productPrice) {
        // Prepare the SQL update statement
        $sql = "UPDATE products SET product_name = ?, product_sku = ?, product_price = ? WHERE id = ?";

        // Prepare the statement
        if ($stmt = $conn->prepare($sql)) {
            // Bind parameters
            $stmt->bind_param("ssdi", $productName, $productSKU, $productPrice, $productId);

            // Execute the statement
            if ($stmt->execute()) {
                // Success response
                echo json_encode(['status' => 'success', 'message' => 'Product updated successfully']);
            } else {
                // Error response
                echo json_encode(['status' => 'error', 'message' => 'Failed to update product']);
            }

            // Close the statement
            $stmt->close();
        } else {
            // Error response for statement preparation failure
            echo json_encode(['status' => 'error', 'message' => 'Failed to prepare the statement']);
        }
    } else {
        // Error response for missing data
        echo json_encode(['status' => 'error', 'message' => 'Invalid data provided']);
    }

    // Close the connection
    $conn->close();
} else {
    // Error response for invalid request method
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
