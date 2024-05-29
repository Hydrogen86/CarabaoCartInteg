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
    <link rel="icon" href="../Images/logo.png">
    <title>Home - CarabaoCart</title>
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
        .contact-C .contact-us-messages {
            padding: 20px;
            max-width: 400px;
            border: 1.5px solid rgb(70, 70, 70);
            border-radius: 20px;
        }
        .contact-C .contact-us-messages .message-text{
            padding: 5px;
            background-color: rgb(185, 218, 229);
            border-radius: 10px;
        }
        .contact-C .contact-us-messages .message:hover {
            cursor: pointer;
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
        table tr .carabao, .cost, .accepted, .rejected {
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
            <a href="#" class="active" target="_self">Home</a>
            <a href="Deposit.php" target="_self">Deposit</a>
            <a href="Inventory.php" target="_self" >Inventory</a>
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
            <h2 style="color: #353F8E; margin-left: -1px;">Supplier List</h2>
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
    </div>
</body>
</html>
