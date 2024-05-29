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
    <title>Inventory - CarabaoCart</title>
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
        }
        select {
            margin: 5px 0 10px 0;
            cursor: pointer;
            font-size: 15px;
        }
        .inventory .table-head th {
            padding-left: 5px;
        }
        
        tr th {
            background-color: #353F8E;
            color: #fff;
        }
        select {
            border-radius: 10px;
            font-size: 1.1rem;
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
            <a href="stocks.php">Stocks</a>
            <a href="inventory.php" class="active">Inventory</a>
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
        <h1 style=" color: #353F8E; text-align:center">Stock History</h1>
        <?php
        // Directory where XML files are stored
        $xmlDirectory = "../XML/productStocks/";

        // Start the select element
        echo "<select id='xmlSelect'>";
        echo "<option value=''>Select a file</option>"; // Default option
        foreach (glob($xmlDirectory . "stockData-*.xml") as $xmlFile) {
            // Extract date from filename
            $filename = basename($xmlFile);
            preg_match("/stockData-(\d{2}-\d{2}-\d{4})\.xml/", $filename, $matches);
            $fileDate = isset($matches[1]) ? $matches[1] : "";

            // Add an option for each XML file
            echo "<option value='$filename'>$fileDate</option>";
        }
        echo "</select>";

        // JavaScript to redirect when an option is selected
        echo "<script>
                document.getElementById('xmlSelect').addEventListener('change', function() {
                    var selectedFile = this.value;
                    if (selectedFile) {
                        window.location.href = '?file=' + selectedFile;
                    }
                });
            </script>";

        // Check if a file has been selected
        if (isset($_GET['file'])) {
            $selectedFile = basename($_GET['file']);
            $xmlFileName = $xmlDirectory . $selectedFile;

            // Check if the XML file exists
            if (file_exists($xmlFileName)) {
                // Load the XML file
                $xml = simplexml_load_file($xmlFileName);
                if ($xml === false) {
                    die("Error: Cannot create object from the selected XML file");
                }
            } else {
                die("Error: XML file not found.");
            }
            $itemNumber = 1;

            echo "<h5>Stock Data for: " . htmlspecialchars($fileDate) . "</h5>";
            echo "<table>";
            echo "<tr class='table-head'><th>Item No.</th><th>Product Name</th><th>Price</th><th>Stock</th><th>Total Amount</th><th>Expiry Date</th></tr>";

            foreach ($xml->Product as $product) {

                echo "<tr>";
                echo "<td class='item-num'>$itemNumber</td>";
                echo "<td>" . htmlspecialchars($product['name']) . "</td>";
                echo "<td>₱" . htmlspecialchars($product['price']) . "</td>";
                echo "<td>" . htmlspecialchars($product['stock']) . "</td>";
                echo "<td>₱" . htmlspecialchars($product['price'] * $product['stock']) . "</td>";
                echo "<td class='exp-date'>". htmlspecialchars($product['expiration_date']) . "</td>";
                echo "</tr>";
                $itemNumber++;
            }

            echo "</table>";
        }
        ?>
    </div>
</body>
<
</html>
