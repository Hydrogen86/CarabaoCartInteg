<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS-File/tableStyle.css">
    <link rel="stylesheet" href="../CSS-File/mainDesign.css">
    <link rel="icon" href="../Images/logo.png">
    <title>View CarabaoCart Data</title>
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
                <li><a href="View_CarabaoCart_Data.php" target="_self" class="active" >Home</a></li>
                <li><a href="Milk_Deposit.php" target="_self">Deposit</a></li>
                <li><a href="view_Milk_Data.php" target="_self">Inventory</a></li>
                <li><a href="../../CarabaoCart-Elpie-v2/Admin/stocks.php" target="_blank">Visit Shop</a></li>
            </ul>
        </nav><hr>
    </div>
    
    <div class="user-table">
        <h2>User List</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th class="carabao">Carabaos</th>
                <th class="deposited">Deposited(L)</th>
                <th class="rejected">Rejected(L)</th>
                <th class="accepted">Accepted(L)</th>
                <th class="cost">Cost(&#8369;)</th>
            </tr>
            <?php
                // Load the user data XML file
                $userData = simplexml_load_file("../XML-File/userData.xml");

                // Check if the XML file is successfully loaded
                if ($userData) {
                    // Initialize an array to store the total deposits and costs for each user
                    $userTotals = [];

                    // Process all milk data files
                    $milkDataFiles = glob("../XML-File/milkData-*.xml");
                    foreach ($milkDataFiles as $file) {
                        $milkData = simplexml_load_file($file);
                        foreach ($milkData->record as $record) {
                            $userID = (string)$record->userID;
                            $milkDeposit = (float)$record->milkDeposit;
                            $rejectedMilk = (float)$record->rejectedMilk;
                            $acceptedMilk = (float)$record->acceptedMilk;
                            $totalCost = (float)$record->totalCost;

                            if (!isset($userTotals[$userID])) {
                                $userTotals[$userID] = ['totalDeposited' => 0, 'totalRejected' => 0, 'totalAccepted' => 0, 'totalCost' => 0];
                            }

                            $userTotals[$userID]['totalDeposited'] += $milkDeposit;
                            $userTotals[$userID]['totalRejected'] += $rejectedMilk;
                            $userTotals[$userID]['totalAccepted'] += $acceptedMilk;
                            $userTotals[$userID]['totalCost'] += $totalCost;
                        }
                    }

                    // Output the data in a table format
                    foreach ($userData->user as $user) {
                        $userID = (string)$user->userID;
                        $totalDeposited = isset($userTotals[$userID]) ? $userTotals[$userID]['totalDeposited'] : 0;
                        $totalRejected = isset($userTotals[$userID]) ? $userTotals[$userID]['totalRejected'] : 0;
                        $totalAccepted = isset($userTotals[$userID]) ? $userTotals[$userID]['totalAccepted'] : 0;
                        $totalCost = isset($userTotals[$userID]) ? $userTotals[$userID]['totalCost'] : 0;

                        echo "<tr>";
                        echo "<td class='ID-row'>" . htmlspecialchars($userID) . "</td>";
                        echo "<td>" . htmlspecialchars($user->name) . "</td>";
                        echo "<td class='carabao'>" . htmlspecialchars($user->carabaoCount) . "</td>"; // Accessing the correct XML elements
                        echo "<td class='Deposited-Cell'>" . htmlspecialchars($totalDeposited) . "</td>";
                        echo "<td class='Rejected-Cell'>" . htmlspecialchars($totalRejected) . "</td>";
                        echo "<td class='Accepted-Cell'>" . htmlspecialchars($totalAccepted) . "</td>";
                        echo "<td class='Cost-Cell'>&#8369; " . htmlspecialchars($totalCost) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    // If the XML file cannot be loaded, display an error message
                    echo "<tr><td colspan='5'>Failed to load data.</td></tr>";
                }
            ?>
        </table>
    </div>
</body>
<style>
    table tr th {
        padding: 8px;
    }
    table .carabao {
        width: 100px;
        text-align: center;
        padding: 0;
    }
    table .Accepted-Cell, .Cost-Cell, .Deposited-Cell, .Rejected-Cell {
        width: 100px;
        text-align: left;
    }
    table tr .carabao, .cost, .accepted {
        text-align: center;
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