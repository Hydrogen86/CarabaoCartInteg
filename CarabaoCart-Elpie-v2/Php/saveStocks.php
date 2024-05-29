<?php
// Create a unique filename based on the current date
$date = date("m-d-Y");
$xmlFileName = "../XML/productStocks/stockData-$date.xml";

// Define the path to milkStocks.xml
$xmlFileMilkStocks = '../XML/milkStocks.xml';

// Define the product prices
$products_prices = [
    "Fresh Milk" => 160,
    "Strawberry Milk" => 160,
    "Chocolate Milk" => 160,
    "Ice Cream" => 100,
    "Yogurt" => 100,
    "Milk Cheese" => 100,
    "Cookies" => 100,
    "Protein Bar" => 50
];

// Function to initialize a new SimpleXMLElement structure with expiration dates
function initializeXmlWithExpiration($products_prices) {
    $xmlString = '<?xml version="1.0" encoding="UTF-8"?><stockData></stockData>';
    $xml = new SimpleXMLElement($xmlString);

    // Define expiration periods for products
    $expiration_periods = [
        "Fresh Milk" => 15,
        "Strawberry Milk" => 15,
        "Chocolate Milk" => 15,
        "Ice Cream" => 60,
        "Yogurt" => 60,
        "Milk Cheese" => 90,
        "Cookies" => 90,
        "Protein Bar" => 90
    ];

    foreach ($products_prices as $product => $price) {
        $productElement = $xml->addChild('Product');
        $productElement->addAttribute('name', $product);
        $productElement->addAttribute('price', $price);
        $productElement->addAttribute('stock', 0);

        // Calculate expiration date based on current date and expiration period
        $expiration_date = date('Y-m-d', strtotime("+$expiration_periods[$product] days"));
        $productElement->addAttribute('expiration_date', $expiration_date);
    }

    // Initialize totalStocks element
    $xml->addChild('totals')->addChild('totalStocks', 0);

    return $xml;
}

// Check if the XML file for today already exists, if not create a new one
if (file_exists($xmlFileName)) {
    // Load existing stock data from today's XML file
    $xml = simplexml_load_file($xmlFileName);
    if ($xml === false) {
        die("Error: Cannot create object from today's XML file");
    }
} else {
    // Initialize a new XML structure with expiration dates if the file doesn't exist
    $xml = initializeXmlWithExpiration($products_prices);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $newStocks = $_POST['stock'];

    // Clear existing products in the XML
    while ($xml->Product[0]) {
        unset($xml->Product[0]);
    }

    // Initialize totalStocks to 0
    $totalStocks = 0;

    // Replace the XML with the new stock data
    foreach ($products_prices as $productName => $price) {
        $product = $xml->addChild('Product');
        $product->addAttribute('name', $productName);
        $product->addAttribute('price', $price);
        $product->addAttribute('stock', isset($newStocks[$productName]) ? (int)$newStocks[$productName] : 0);

        // Add to totalStocks
        $totalStocks += isset($newStocks[$productName]) ? (int)$newStocks[$productName] : 0;

        // Calculate expiration date based on current date and expiration period
        $expiration_periods = [
            "Fresh Milk" => 15,
            "Strawberry Milk" => 15,
            "Chocolate Milk" => 15,
            "Ice Cream" => 60,
            "Yogurt" => 60,
            "Milk Cheese" => 90,
            "Cookies" => 90,
            "Protein Bar" => 90
        ];
        $expiration_date = date('Y-m-d', strtotime("+$expiration_periods[$productName] days"));
        $product->addAttribute('expiration_date', $expiration_date);
    }

    // Clear existing totals in the XML
    while ($xml->totals[0]) {
        unset($xml->totals[0]);
    }

    // Create totals element
    $totals = $xml->addChild('totals');
    $totals->addChild('totalStocks', $totalStocks);

    // Save the updated XML to today's file
    $xml->asXML($xmlFileName);

    // Now, subtract the total stock from the milkStocks.xml
    $xmlMilkStocks = simplexml_load_file($xmlFileMilkStocks);
    if ($xmlMilkStocks === false) {
        die("Error: Cannot load milkStocks XML file");
    }

    // Get the total milk accepted
    $totalMilkAccepted = (int)$xmlMilkStocks->totalMilkAccepted;

    // Ensure that the subtraction won't result in a negative value
    if ($totalStocks <= $totalMilkAccepted) {
        // Subtract the total stock from the total milk accepted
        $totalMilkAccepted -= $totalStocks;
    } else {
        // If the total stock exceeds totalMilkAccepted, set totalMilkAccepted to 0
        $totalMilkAccepted = 0;
    }


    // Update the totalMilkAccepted element
    $xmlMilkStocks->totalMilkAccepted = $totalMilkAccepted;

    // Save the updated milkStocks XML
    $xmlMilkStocks->asXML($xmlFileMilkStocks);

    // Reload the page
    header("Location: ../Admin/stocks.php");
    exit();
}
?>