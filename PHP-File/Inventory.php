<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../CSS-File/design.css">
    <link rel="stylesheet" href="../CSS-File/tableStyle.css">
    <link rel="stylesheet" href="../CSS-File/mainDesign.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Questrial&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX==" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700&display=swap" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="icon" href="../Images/logo.png">
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
        .contact-C {
            text-align: left; /* Align contact form to the left */
            margin-right: 20px; /* Add some margin to the right */
        }
        .contact-C h2 {
            margin-left: 30px;
        }
        table tr th {
        padding: 8px;
        }
        table .carabao {
            width: 100px;
            text-align: center;
            padding: 0;
        }
        table .Accepted-Cell, .Cost-Cell, .Deposited-Cell, .Rejected-Cell {
            width: 150px;
            text-align: left;
        }
        table tr .carabao, .cost, .accepted {
            text-align: center;
        }
        
        .user-table {
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }
        .user-table h1 {
            margin: -2px;
            color: #353F8E;
        }
        .user-table h4 {
            padding: 0;
            margin: 0;
            margin-top: 8px;
        }
        .user-table .percentage-container {
            padding: 10px;
            margin-top: 130px;
            margin-left: 8%;
            width: 450px;
            text-align: left;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            border-radius: 5px;
            float: left;
            font-family: var(--font-poppins);
            font-size: 18.5px;
            font-weight: 500;
            color: rgb(26, 203, 209);
        }
        .user-table .percentage-container span {
            font-size: 45px;
            font-weight: bold;
            margin-left: 5px;
            color: #4e4e4e;
        }
        .user-table .percentage-container .name-span {
            font-size: 18.5px;
            font-weight: 500;
            color: black;
        }
        .user-table .percentage-container p {
            margin: 0;
        }
        /*Design for Select*/
        .user-table select {
            margin-left: 10px;
            cursor: pointer;
            font-family: var(--font-poppins);
            font-size: 1.1rem;
            border: 2px solid rgb(19, 19, 19);
            border-radius: 10px;
            transition: .3s;
        }
        .contact-C .user-table .pie-graph {
            color: #353F8E;
            text-align: center;
            margin: 50%;
            width: 500px;
            margin-bottom: 20px;
            margin-top: 3%;
        }
        tr th {
            background-color: #353F8E;
            color: #fff;
        }
        .user-table h4, h3, h2 {
            color: #353F8E;
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
            <a href="View_Data.php" target="_self">Home</a>
            <a href="Deposit.php" target="_self">Deposit</a>
            <a href="#" target="_self"  class="active" >Inventory</a>
        </div>

        <div class="search">
            <span class="material-symbols-outlined">search</span>
            <input type="text" placeholder="Search">
            <div class="icons">
                <a href="../CarabaoCart-Elpie-v2/Admin/home.php" target="_blank"><i class='bx bx-user'></i></a>
            </div>
        </div>
    </div>
    <!-- contact -->
    <br><br><br><br>
    <div class="contact-C">
        <div class="user-table">
            <h2 style="color: #353F8E; margin-left: 1px;">Data History</h2>
            <?php
            // Directory where XML files are stored
            $xmlDirectory = "../XML-File/";

            // Start the select element
            echo "<select id='xmlSelect'>";
            echo "<option value=''>Select a file</option>"; // Default option
            foreach (glob($xmlDirectory . "milkData-*.xml") as $xmlFile) {
                // Extract date from filename
                $filename = basename($xmlFile);
                preg_match("/milkData-(\d{2}-\d{2}-\d{4})\.xml/", $filename, $matches);
                $fileDate = isset($matches[1]) ? $matches[1] : "";

                /*/ Add an option for each XML file
                echo "<option value='$filename'>$fileDate</option>";*/
                echo "<option value='" . htmlspecialchars($filename) . "'>" . htmlspecialchars($fileDate) . "</option>";
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

            // Check if a specific XML file is requested
            if (isset($_GET['file'])) {
                $requestedFile = $_GET['file'];
                $xmlPath = $xmlDirectory . $requestedFile;

                // Check if the requested XML file exists
                if (file_exists($xmlPath)) {
                    // Load the XML file
                    $xml = simplexml_load_file($xmlPath);

                    // Display XML data in a table
                    echo "<h4>Data for: $fileDate</h4>";
                    echo "<table>";
                    echo "<tr><th>ID</th><th>Name</th><th>Deposit</th><th>Rejected</th><th>Accepted</th><th>Cost &#8369;100/L</th><th>Time Saved</th></tr>";
                    foreach ($xml->record as $record) {
                        echo "<tr>";
                        echo "<td class='ID-row'>{$record->userID}</td>";
                        echo "<td>{$record->name}</td>";
                        echo "<td>{$record->milkDeposit}</td>";
                        echo "<td>{$record->rejectedMilk}</td>";
                        echo "<td>{$record->acceptedMilk}</td>";
                        echo "<td>&#8369; {$record->totalCost}</td>";
                        echo "<td>{$record->timeSaved}</td>";
                        echo "</tr>";
                    }
                    // Display totals
                    echo "<tr id='totalRow'>";
                    echo "<td colspan='2'>Total</td>";
                    echo "<td>{$xml->totals->totalMilkDeposit}</td>";
                    echo "<td>{$xml->totals->totalMilkRejected}</td>";
                    echo "<td>{$xml->totals->totalMilkAccepted}</td>";
                    echo "<td>&#8369; {$xml->totals->totalMilkCost}</td>";
                    echo "<td></td>"; // Empty cell for Time Saved column
                    echo "</tr>";
                    echo "</table>";
                } else {
                    // XML file not found
                    echo "XML file not found.";
                }

                // Calculate percentages
                $TD = $xml->totals->totalMilkDeposit;
                $TR = $xml->totals->totalMilkRejected;
                $TA = $xml->totals->totalMilkAccepted;
                $TC = $xml->totals->totalMilkCost;

                $totalPercentage = 100;
                if ($TR > 0 || $TD > 0 && $TA > 0) {
                    $percentageTR = ($TR / $TD) * $totalPercentage;
                    $percentageTA = ($TA / $TD) * $totalPercentage;

                    /*/ Display the percentages
                    echo "<p><span class='name-span'>Deposited:</span> <span class='perctge-span'>$TD</span> Liters <span class='name-span'>Rejected:</span> <span class='perctge-span'>$TR </span>" . number_format($percentageTR, 2) . "% <span class='name-span'>Accepted:</span> <span class='perctge-span'>$TA </span>" . number_format($percentageTA, 2) . "% <span class='name-span'>Cost:</span> <span class='perctge-span'>$TC</span> &#8369;</p>";*/
                    echo "<div class='percentage-container'>";
                    echo "<h3>Totals</h3>";
                    echo "<p><span class='name-span'>Deposit:</span> <span>$TD</span> Liters</p>";
                    echo "<p><span class='name-span'>Rejected:</span> <span>$TR</span> " . number_format($percentageTR, 2) . "% Liters</p>";
                    echo "<p><span class='name-span'>Accepted:</span> <span>$TA</span>" . number_format($percentageTA, 2) . "%  Liters</p>";
                    echo "<p><span class='name-span'>Cost:</span> &#8369;<span class='perctge-span'>$TC</span> Pesos</p>";
                    echo "</div>";
                } else {
                    echo "<h3>No Data</h3>";
                }
            }
            ?>
            <!--------------------------JS Pie Chart----------------------->
            <div class="pie-graph">
                <canvas id="myPieChart" width="100" height="100"></canvas>
                
                <script>
                    // Check if both data points are not zero
                    if (<?php echo $TR; ?> !== 0 || <?php echo $TA; ?> !== 0) {
                        var ctx = document.getElementById('myPieChart').getContext('2d');
                        var myPieChart = new Chart(ctx, {
                            type: 'pie',
                            data: {
                                labels: ['Rejected', 'Accepted'], // Labels for each segment
                                datasets: [{
                                    data: [<?php echo $TR; ?>, <?php echo $TA; ?>], // Data for each segment
                                    backgroundColor: ['#FBD420', '#353F8E'] // Colors for each segment
                                }]
                            },
                            options: {
                                legend: {
                                    display: true,
                                    position: 'bottom',
                                    labels: {
                                        fontSize: 25 // Set legend font size
                                    }
                                },
                                tooltips: {
                                    bodyFontSize: 25 // Set tooltip font size
                                }
                            }
                        });
                        // Adding an h2 heading
                        var chartContainer = document.getElementsByClassName('pie-graph')[0];
                        var heading = document.createElement('h1');
                        heading.textContent = 'Data Chart';
                        chartContainer.insertBefore(heading, chartContainer.firstChild);
                    } else {
                        // Display "No data" message
                        var canvas = document.getElementById('myPieChart');
                        canvas.style.display = 'none';
                        var message = document.createElement('h2');
                        message.textContent = 'No data';
                        document.getElementsByClassName('pie-graph')[0].appendChild(message);
                    }
                </script>
            </div>
            <!--------------------------JS Pie Chart----------------------->
    </div>
    </div>
</body>

</html>
