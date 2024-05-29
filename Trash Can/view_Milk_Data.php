<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS-File/tableStyle.css">
    <link rel="stylesheet" href="../CSS-File/mainDesign.css">
    <link rel="icon" href="../Images/logo.png">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Milk Data</title>
</head>
<body>
    <div class="wrapper">
        <div class="logo">
            <a href="../../CarabaoCart-Elpie-v2/index.html" target="_blank">
                <img src="../Images/logo.png" alt="">
                <h2>Carabao<br>Cart</h2>
            </a>
        </div>
        <nav>
            <ul>
                <li><a href="View_CarabaoCart_Data.php" target="_self">Home</a></li>
                <li><a href="Milk_Deposit.php" target="_self">Deposit</a></li>
                <li><a href="view_Milk_Data.php" target="_self" class="active">Inventory</a></li>
                <li><a href="../../CarabaoCart-Elpie-v2/Admin/stocks.php" target="_blank">Visit Shop</a></li>
            </ul>
        </nav><hr>
    </div>

    <div class="user-table">
        <h2>Data History</h2>
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
            <h2>Data Chart</h2>
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
                                backgroundColor: ['#fca311', '#14213d'] // Colors for each segment
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
                } else {
                    // Display "No data" message
                    var canvas = document.getElementById('myPieChart');
                    canvas.style.display = 'none';
                    var message = document.createElement('p');
                    message.textContent = 'No data';
                    document.getElementsByClassName('pie-graph')[0].appendChild(message);
                }
            </script>
        </div>
        <!--------------------------JS Pie Chart----------------------->
    </div>

</body>
<!--Internal Design for Pie Chart-->
<style>
    body {
        background-color: #fff;
        padding: 20px;
    }
    .user-table {
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
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
        width: 400px;
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
        font-size: 14.5px;
        border: 2px solid rgb(19, 19, 19);
        border-radius: 10px;
        transition: .3s;
    }
    .user-table select:hover {
        border: 2px solid rgb(148, 148, 148);
        background-color: var(--light-blue);
        color: #fff;
    }
    .user-table .pie-graph {
        color: var(--light-blue);
        text-align: center;
        margin: 50%;
        width: 500px;
        margin-bottom: 20px;
        margin-top: 20px;
    }
    .logo {
        display: flex;
    }
    .wrapper .logo a img {
        width: 75px;
        height: 75px;
    }
    .wrapper .logo a {
        display: flex;
        height: fit-content;
        width: fit-content;
        text-decoration: none;
        color: #353F8E;
    }
</style>
</html>