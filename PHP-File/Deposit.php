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
    <script src="../JS-File/MilkDepositComputation.js"></script>
    <title>Deposit - CarabaoCart</title>
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
        .map-container {
            width: 60%; /* Adjust map container width */
            height: 520px; /* Adjust map container height */
            margin-top: 8%; /* Add margin to the top */
            border-radius: 15px; /* Add border radius */
            overflow: hidden; /* Ensure content does not overflow rounded corners */
            margin-left: 700px;
            position: fixed;
        }

        .map {
            position: relative;
            padding-bottom: 75%; /* Aspect ratio */
            height: 0;
            overflow: hidden;
        }
        .map iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
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
        .save-btn {
            float: right;
            margin-bottom: 10px;
            cursor: pointer;
        }
        .save-btn:hover {
            color: #FBD420;
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
            <a href="View_Data.php" target="_self">Home</a>
            <a href="#" target="_self"  class="active">Deposit</a>
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
            <h2 style="color: #353F8E; margin-left: -1px;">Milk Deposit</h2>

            <form action="../PHP-File/Save_Milk_Data.php" method="post">
                <button type="submit" class="save-btn" id="save-btn" style='font-size: 1.2rem; width: 100px; height: 35px; border-radius: 10px;'>SAVE</button>
                <table id="user-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th style="width: 350px;">Name</th>
                            <th>Carabaos</th>
                            <th>Deposit(&#8369;100/L)</th>
                            <th>Rejected(L)</th>
                            <th style="width: 90px; text-align:center;">Action</th>
                            <th>Accepted(L)</th>
                            <th>Cost (&#8369;)</th>
                            <th style="width: 350px;">Time</th>
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
</html>
