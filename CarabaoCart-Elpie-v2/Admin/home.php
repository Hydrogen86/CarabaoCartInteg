<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../design.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Questrial&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX==" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700&display=swap" rel="stylesheet" />
    <link rel="icon" href="../images/logo.png">
    <link rel="stylesheet" href="../CSS/tableDesign.css">
    <title>Stocks - CarabaoCart</title>
    <style>
        .heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background-color: #f3f3f3;
        }
        .logo {
            display: flex;
            align-items: center;
        }
        .logo h2 {
            margin-left: 10px;
        }
        .navbar {
            display: flex;
            align-items: center;
        }
        .navbar a {
            margin-right: 10px;
            text-decoration: none;
            color: black;
        }
        .search {
            display: flex;
            align-items: center;
            padding: -7px;
        }
        .search input {
            border: none;
            outline: none;
            width: 200px;
            padding: 5px;
            margin-left: 5px;
        }
        .icons {
            display: flex;
            align-items: center;
            margin-left: 10px;
        }
        .icons a {
            text-decoration: none;
            color: black;
            margin-right: 10px;
        }
        .icons i {
            font-size: 24px;
        }
        .inventory {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 500px;
            background-color: none;
        }
        .inventory table tr th, tr td {
            padding-left: 10px;
        }
        .inventory table .item-num {
            width: 100px;
            text-align: center;
        }
        
        tr th {
            background-color: #353F8E;
            color: #fff;
        }
    </style>

</head>
<body>
    <!-- Heading -->
    <div class="heading">
        <!-- logo -->
        <div class="logo">
            <a href="#">
                <img src="../images/logo.png" alt="">
                <h2>Carabao<br>Cart</h2>
            </a>
        </div>
        <!-- Nav Bar -->
        <div class="navbar">
            <a href="home.php" class="active">Home</a>
            <a href="view_orders.php">Products</a>
            <a href="stocks.php" >Stocks</a>
            <a href="inventory.php">Inventory</a>
            <a href="view_contacts.php">Messages</a>
        </div>

        <div class="search">
            <span class="material-symbols-outlined">search</span>
            <input type="text" placeholder="Search">
            <div class="icons">
                <a href="../../PHP-File/View_Data.php"><i class='bx bx-package'></i></a>
                <a href="../index.html"><i class='bx bx-store'></i></a>
                
            </div>
        </div>
    </div>
    <!-- contact -->
    <br><br><br><br>
    <?php
        // Initialize an associative array to store total stocks for each product
        $productTotals = [];
        // Associative array to store product prices
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

        // Get a list of XML files in the productStocks directory
        $xmlFiles = glob("../XML/productStocks/stockData-*.xml");

        // Loop through each XML file
        foreach ($xmlFiles as $xmlFile) {
            $xml = simplexml_load_file($xmlFile);
            if ($xml === false) {
                continue; // Skip this file if it cannot be loaded
            }

            // Loop through each product in the XML file
            foreach ($xml->Product as $product) {
                $productName = (string)$product['name'];
                $stock = (int)$product['stock'];

                // Update total stocks for this product
                if (!isset($productTotals[$productName])) {
                    $productTotals[$productName] = 0;
                }
                $productTotals[$productName] += $stock;
            }
        }
    ?>

    <div class="inventory">
        <h1 style="color: #353F8E; text-align:center">Total Stocks</h1><br>
        <table>
            <tr>
                <th class='item-num' style=" color: #fff;">Item No.</th>
                <th>Products</th>
                <th>Price</th>
                <th>No. of Stocks</th>
                <th>Total</th>
            </tr>
            <?php
            // Counter for item number
            $itemNo = 1;

            // Loop through each product
            foreach ($productTotals as $productName => $totalStocks) {
                // Retrieve the price for this product (assuming it's defined somewhere in your code)
                $price = isset($products_prices[$productName]) ? $products_prices[$productName] : 0;

                // Calculate the cost for this product
                $cost = $price * $totalStocks;

                // Display product information in table row
                echo "<tr>";
                echo "<td class='item-num'>{$itemNo}</td>";
                echo "<td>{$productName}</td>";
                echo "<td>₱ {$price}</td>";
                echo "<td>{$totalStocks}</td>";
                echo "<td>₱ {$cost}</td>";
                echo "</tr>";

                $itemNo++; // Increment item number
            }
            ?>
        </table>
    </div>
</body>
</html>
