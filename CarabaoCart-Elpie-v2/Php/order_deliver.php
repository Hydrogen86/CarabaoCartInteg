<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get product name, quantity, and selected XML file from POST request
    $productName = $_POST['productName'];
    $quantityInput = (int)$_POST['quantityInput'];
    $selectedFile = $_POST['xmlFile'];

    if (empty($selectedFile)) {
        die('No XML file selected.');
    }

    // Load the selected stock XML file
    $xmlFilePath = "../XML/productStocks/" . $selectedFile;
    $stockXml = simplexml_load_file($xmlFilePath);

    // Check if the stock XML file was loaded successfully
    if ($stockXml === false) {
        die('Error loading stock XML file.');
    }

    // Update the stock quantity
    $productFound = false;
    foreach ($stockXml->children() as $product) {
        if ((string)$product['name'] == $productName) {
            $stock = (int)$product['stock'];
            $newStock = $stock - $quantityInput;
            if ($newStock < 0) {
                $newStock = 0; // Ensure stock doesn't go negative
            }
            $product['stock'] = $newStock;
            $productFound = true;
            break;
        }
    }

    // Save the updated stock XML file
    if ($productFound) {
        $stockXml->asXML($xmlFilePath);
        echo "Stock updated successfully.";
    } else {
        echo "Product not found in the selected stock file.";
    }

    // Redirect back to the order page or display a success message
    header('Location: ../Admin/view_orders.php');
    exit;
} else {
    echo "Invalid request method.";
}
?>