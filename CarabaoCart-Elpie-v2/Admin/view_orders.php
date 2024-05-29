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
    <title>Products - CarabaoCart</title>
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
            background-color: none;
            box-shadow: 0 4px 8px rgb(212, 212, 212);
            border-radius: 25px;
            padding: 10px;
        }

        .order {
            padding-left: 35px;
            margin-top: 10px;
            float: left;
            width: 43%; /* Adjust the width as needed */
        }
        .image-container {
            float: right;
            width: 20%; /* Adjust the width as needed */
        }
        .date-container {
            float: right;
            width: 20%; /* Adjust the width as needed */
            margin-top: -14%;
        }
        hr {
            margin-top: 5px;
        }
        h2 {
            margin-top: 25px;
            margin-bottom: 20px;
        }
        form {
            float: right;
            margin-top: -6%;
            margin-right: 4%;
        }
        form button {
            padding: 5px;
            font-weight: bold;
            cursor: pointer;
            border: 1.5px solid lightslategray;
            border-radius: 5px;
        }
        form button:hover {
            background-color: #353F8E;
            color: #FBD420;
            border: none;
        }
        form select {
            border-radius: 5px;
            padding: 5px;
            margin-left: 4.5px;
            margin-bottom: 10px;
            width: 170px;
            cursor: pointer;
            font-weight: bold;
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
            <a href="home.php">Home</a>
            <a href="productOrders.php" class="active">Products</a>
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
    <h1 style="color: #353F8E; text-align:center">Place Orders</h1>
    <div class="inventory">
        <?php
            // Load the XML file
            $xmlFile = '../XML/PlaceOrders/orderData.xml'; // Path to your XML file
            $xml = simplexml_load_file($xmlFile);

            // Check if the XML file was loaded successfully
            if ($xml === false) {
                die('Error loading XML file.');
            }

            // Output messages
            foreach ($xml->children() as $orderData) {
                // Extract data from each <contact> element
                $name = (string)$orderData->name;
                $address = (string)$orderData->address;
                $quantityInput = (int)$orderData->quantityInput;
                $contactNumber = (string)$orderData->contactNumber;
                $productName = (string)$orderData->productName;
                $productPrice = (int)$orderData->productPrice;
                $orderTime = (string)$orderData->orderTime;

                $totalCost = $quantityInput * $productPrice;

                // Define the path to the product image
                $productImage = '';

                // Determine the product image based on the product name
                if ($productName === "Fresh Milk") {
                    $productImage = "../images/milk1.png";
                } else if ($productName === "Strawberry Milk") {
                    $productImage = "../images/milk2.png";
                } else if ($productName === "Chocolate Milk") {
                    $productImage = "../images/milk3.png";
                } else if ($productName === "Ice Cream") {
                    $productImage = "../images/icecream.png";
                } else if ($productName === "Milk Cheese") {
                    $productImage = "../images/cheese.png";
                } else if ($productName === "Yogurt") {
                    $productImage = "../images/yogurt.png";
                } else if ($productName === "Cookies") {
                    $productImage = "../images/cookies.png";
                } else if ($productName === "Protein Bar") {
                    $productImage = "../images/pbar.png";
                }

                // Display the message
                echo "<div class='order' data-name='$name'>";
                echo "<strong>Name:</strong> $name<br>";
                echo "<strong>Contact:</strong> $contactNumber<br>";
                echo "<strong>Address:</strong> $address<br><br>";
                echo "<strong>Item:</strong> $productName <br>";
                echo "<strong>Price: </strong>₱$productPrice <br>";
                echo "<strong>Quantity:</strong> $quantityInput<br>";
                echo "<strong>Total: </strong>₱$totalCost<br>";    
                echo "</div>";
                echo "<div class='img-container'>";
                echo "<img src='$productImage' alt='$productName Image' class='product-image'>"; // Display the product image
                echo "</div>";
                echo "<div class='date-container'>";
                echo "<strong>Date: </strong>$orderTime<br>";
                echo "</div>";

                // Directory where XML files are stored
                $xmlDirectory = "../XML/productStocks/";

                // Start the form
                echo "<form method='post' action='../Php/order_deliver.php'>";
                // Hidden inputs to pass product data
                echo "<input type='hidden' name='productName' value='$productName'>";
                echo "<input type='hidden' name='quantityInput' value='$quantityInput'>";
                
                // Start the select element
                echo "<select name='xmlFile' required>";
                echo "<option value=''>Select a file</option>"; // Default option
                foreach (glob($xmlDirectory . "stockData-*.xml") as $xmlFile) {
                    // Extract date from filename
                    $filename = basename($xmlFile);
                    preg_match("/stockData-(\d{2}-\d{2}-\d{4})\.xml/", $filename, $matches);
                    $fileDate = isset($matches[1]) ? $matches[1] : "";

                    // Add an option for each XML file
                    echo "<option value='$filename'>$fileDate</option>";
                }
                echo "</select> <br>";
                
                echo "<button type='submit' style='font-size: 12.5px; width: 180px; height: 30px; border-radius: 10px;'>Order Delivered</button>";
                echo "</form>";

                echo "<hr><br>";

            }
        ?>
    </div>
</body>
</html>
