<?php
date_default_timezone_set('Asia/Manila');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productName = $_POST["productName"] ?? '';
    $productPrice = $_POST["productPrice"] ?? 0;
    $productName = $_POST["productName"] ?? '';
    $name = $_POST["name"] ?? '';
    $address = $_POST["address"] ?? '';
    $quantityInput = $_POST["quantityInput"] ?? 0;
    $contactNumber= $_POST["contact-number"] ?? '';

    if (!empty($name) && !empty($address) && is_numeric($quantityInput) && !empty($contactNumber)) {
        $xml = simplexml_load_file("../XML/PlaceOrders/orderData.xml") ?: new SimpleXMLElement('<orderData/>');//Creating XML File

        $order = $xml->addChild('order');
        $order->addChild('name', $name);
        $order->addChild('address', $address);
        $order->addChild('productName', $productName);
        $order->addChild('productPrice', $productPrice);
        $order->addChild('quantityInput', $quantityInput);
        $order->addChild('contactNumber', $contactNumber);
        $order->addChild('orderTime', date('m-d-Y g:i a'));

        if ($xml->asXML("../XML/PlaceOrders/orderData.xml")) {
            header("Location: ../webpages/products.html?status=success");
        } else {
            header("Location: ../webpages/products.html?status=error&message=Failed+to+write+XML+file.");
        }
    } else {
        header("Location: ../webpages/products.html?status=error&message=Invalid+form+data.");
    }
    exit;
} else {
    header("Location: ../webpages/products.html");
    exit;
}
?>