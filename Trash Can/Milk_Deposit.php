<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS-File/tableStyle.css">
    <link rel="stylesheet" href="../CSS-File/mainDesign.css">
    <link rel="icon" href="../Images/logo.png">
    <script src="../JS-File/MilkDepositComputation.js"></script>
    <title>User Milk Deposit</title>
</head>
<body>
    <div class="wrapper">
        <!-- logo -->
        <div class="logo">
                <a href="../../CarabaoCart-Elpie-v2/index.html" target="_blank">
                    <img src="../Images/logo.png" alt="">
                    <h2>Carabao<br>Cart</h2>
                </a>
        </div>
        <nav>
            <ul>
                <li><a href="View_CarabaoCart_Data.php" target="_self">Home</a></li>
                <li><a href="Milk_Deposit.php" target="_self"class="active">Deposit</a></li>
                <li><a href="view_Milk_Data.php" target="_self" >Inventory</a></li>
                <li><a href="../../CarabaoCart-Elpie-v2/Admin/stocks.php" target="_blank">Visit Shop</a></li>
            </ul>
        </nav><hr>
    </div>
    <div class="user-table">
        <h2>Milk Deposit</h2>

        <form action="../PHP-File/Save_Milk_Data.php" method="post">
            <button type="submit" class="save-btn" id="save-btn">SAVE</button>
            <table id="user-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Carabaos</th>
                        <th>Deposit(&#8369;100/L)</th>
                        <th>Rejected(L)</th>
                        <th>Action</th>
                        <th>Accepted(L)</th>
                        <th>Cost (&#8369;)</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $xml = simplexml_load_file("../XML-File/userData.xml");

                    if ($xml) {
                        foreach ($xml->user as $user) {
                            echo "<tr>";
                            echo "<td class='ID-row'>" . htmlspecialchars($user->userID) . "</td>";
                            echo "<td class='name-row'>" . htmlspecialchars($user->name) . "</td>";
                            echo "<td class='carb-count-row'>" . htmlspecialchars($user->carabaoCount) . "</td>";
                            echo "<td class='input-cell'>";
                            echo "<input type='number' name='milk_deposit[" . $user->userID . "]' value='0' min='0' step='any'>";
                            echo "</td>";
                            echo "<td class='input-cell'>";
                            echo "<input type='number' name='rejected_milk[" . $user->userID . "]' value='0' min='0' step='any'>";
                            echo "</td>";
                            echo "<td class='deposit-btn'>";
                            echo "<button class='depositButton' data-userid='" . $user->userID . "'>Deposit</button>";
                            echo "</td>";
                            echo "<td class='accepted-cell'></td>";
                            echo "<td class='cost-cell'></td>";
                            echo "<td class='time-cell'></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>Failed to load data.</td></tr>";
                    }
                    ?>
                    <tr id="totalRow">
                        <td colspan="3" class="total-cell">Total</td>
                        <td id="totalMilkDeposit">0.00</td>
                        <td id="totalMilkRejected" colspan="2">0.00</td>
                        <td id="totalMilkAccepted">0.00</td>
                        <td id="totalCost">0.00</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
    
    <script>
        // Prevent form submission when clicking the Deposit button
        document.querySelectorAll(".depositButton").forEach(function(button) {
            button.addEventListener("click", function(event) {
                event.preventDefault(); // Prevent default form submission
                // Your deposit action code goes here..
            });
        });
    </script>

</body>
<style>
    .user-table form tbody .cost-cell {
        width: 100px;
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
