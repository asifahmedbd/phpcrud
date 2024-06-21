<!-- process_form.php -->
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    print_r($_POST);
    $product_name = $_POST["product_name"];
    $product_sku = $_POST["product_sku"];

    // Process the data (e.g., insert into a database)
    // ...

    // Example: Display the received data
    echo "Product Name: " . $product_name . "<br>";
    echo "Product SKU: " . $product_sku;
}
?>
