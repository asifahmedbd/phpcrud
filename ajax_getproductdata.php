<?php
// Established your database connection ($conn) properly
include("connection.php");
// Check if id parameter is passed
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Prepare SQL statement to fetch product data
    $sql = "SELECT * FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if any rows were returned
    if ($result->num_rows > 0) {
        // Fetch the data into an associative array
        $row = $result->fetch_assoc();

        // Return the data as JSON
        echo json_encode($row);
    } else {
        // No rows found with the given id
        echo json_encode(array('error' => 'No product found'));
    }
} else {
    // No id parameter provided
    echo json_encode(array('error' => 'No product id provided'));
}
?>