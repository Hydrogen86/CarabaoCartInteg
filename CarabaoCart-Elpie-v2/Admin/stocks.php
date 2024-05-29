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
        .available-stocks {
            float: right;
        }
        tr th {
            background-color: #353F8E;
            color: #fff;
        }
        .item-num {
            width: 100px;
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
            <a href="view_orders.php">Products</a>
            <a href="stocks.php" class="active">Stocks</a>
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
    <div class="inventory">
        <?php
            // Load the XML file
            $xmlFile = '../XML/stockData.xml';
            $xml = simplexml_load_file($xmlFile);

            // Initialize an array to store the stock values
            $stocks = [];

            // Extract stock data from the XML
            foreach ($xml->Product as $product) {
                $productName = (string)$product['name'];
                $stock = (int)$product['stock'];
                $stocks[$productName] = $stock;
            }

            // Check if form is submitted
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['stock'])) {
                // Merge the new stock values with the existing ones
                foreach ($_POST['stock'] as $product => $newStock) {
                    if (isset($stocks[$product])) {
                        // If the product already exists, add the new stock to the existing one
                        $stocks[$product] += (int)$newStock;
                    } else {
                        // If the product is new, simply set its stock to the new value
                        $stocks[$product] = (int)$newStock;
                    }
                }
                
                // Update the XML with the merged stock data
                foreach ($xml->Product as $product) {
                    $productName = (string)$product['name'];
                    if (isset($stocks[$productName])) {
                        $product['stock'] = $stocks[$productName];
                    }
                }
                
                // Save the updated XML
                $xml->asXML($xmlFile);
            }

         // Output the form
        ?>

        <h1 style="color:#353F8E; text-align:center">Stock</h1>
        <form action="../Php/saveStocks.php" method="post">
            <button type="submit" class="save-btn" id="save-btn" style="width: 100px; height:35px; border-radius:10px;">SAVE</button>
            <table id="item-table">
                <thead>
                    <tr>
                        <th>Item No.</th>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Add Stock</th>
                        <th>Action</th>
                        <th>Stocks</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $itemNumber = 1;
                    // Loop through each product
                    foreach ($xml->Product as $product) {
                        $productName = (string)$product['name'];
                        $price = (int)$product['price'];
                        $stock = isset($stocks[$productName]) ? $stocks[$productName] : 0;
                        $totalCost = $price * $stock;

                        // Output the table row with product information
                        echo "<tr>";
                        echo "<td class='item-num'>$itemNumber</td>";
                        echo "<td class='product-name'>$productName</td>";
                        echo "<td class='product-price'>₱ $price</td>";
                        echo "<td class='input-cell'>";
                        echo "<input type='number' name='stock[$productName]' value='' min='0' step='1'>";
                        echo "</td>";
                        echo "<td class='add-stock-btn'>";
                        echo "<button class='add-btn'>Add</button>";
                        echo "</td>";
                        echo "<td class='item-stock' name='item-stock'>$stock</td>"; // Display current stock
                        echo "<td class='total-cost'>₱ $totalCost</td>"; // Display total cost
                        echo "</tr>";

                        $itemNumber++;
                    }
                    ?>
                </tbody>
            </table>
        </form><br>
        <div class="available-stocks">
            <?php
                // Path to the XML file
                $xmlFile = '../XML/milkStocks.xml';

                // Load the XML file
                if (file_exists($xmlFile)) {
                    $xml = simplexml_load_file($xmlFile);

                    // Check if the XML file was loaded successfully
                    if ($xml === false) {
                        echo '<p>Error loading XML file.</p>';
                    } else {
                        // Extract the totalMilkAccepted value and round it to the nearest whole number
                        $totalMilkAccepted = round((float)$xml->totalMilkAccepted);

                        // Display the value
                        echo "<label>Current Stocks: </label>";
                        echo "<strong> $totalMilkAccepted</strong>";
                    }
                } else {
                    echo '<p>XML file not found.</p>';
                }
            ?>
        </div>

    </div>
</body>
<script>
    // Prevent form submission when clicking the Deposit button
    document.querySelectorAll(".add-btn").forEach(function(button) {
        button.addEventListener("click", function(event) {
            event.preventDefault(); // Prevent default form submission
            // Your deposit action code goes here...
        });
    });
</script>
<script src="../JS/stockComputations.js"></script>
</html>
