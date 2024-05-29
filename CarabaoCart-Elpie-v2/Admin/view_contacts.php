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
    <title>Messages - CarabaoCart</title>
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
            text-align: center; /* Align contact form to the left */
            margin-right: 20px; /* Add some margin to the right */
        }
        .contact-C h2 {
            margin-left: 30px;
        }
        .contact-C .contact-us-messages {
            text-align: left;
            padding: 20px;
            width: 100%;
            border: 1.5px solid rgb(70, 70, 70);
            border-radius: 20px;
            font-size: 1.2rem;
        }
        .contact-C .contact-us-messages .message-text{
            padding: 5px;
            background-color: rgb(185, 218, 229);
            border-radius: 10px;
        }
        .contact-C .contact-us-messages .message:hover {
            cursor: pointer;
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
            <a href="inventory.php">Inventory</a>
            <a href="view_contacts.php" class="active">Messages</a>
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
    <div class="contact-C">
        <h1 style="color: #353F8E;">Customer Messages</h1><br><br>
        <div class="contact-us-messages">
            <?php
                // Load the XML file
                $xmlFile = '../XML/contact.xml'; // Path to your XML file
                $xml = simplexml_load_file($xmlFile);

                // Check if the XML file was loaded successfully
                if ($xml === false) {
                    die('Error loading XML file.');
                }

                // Output messages
                foreach ($xml->children() as $contact) {
                    // Extract data from each <contact> element
                    $txtName = (string)$contact->txtName;
                    $txtPhone = (string)$contact->txtPhone;
                    $txtEmail = (string)$contact->txtEmail;
                    $txtMessage = (string)$contact->txtMessage;

                    // Display the message
                    echo "<div class='message' data-name='$txtName'>";
                    echo "<strong>From:</strong> $txtName<br>";
                    echo "<strong>Email:</strong> $txtEmail<br>";
                    echo "<strong>Phone:</strong> $txtPhone<br>";
                    echo "<strong>Message:</strong> <span class='message-text'>$txtMessage</span>";
                    echo "</div>";
                    echo "<hr><br>";
                }
            ?>
        </div>
    </div>
</body>
<script>
    // JavaScript code for handling message display
    document.addEventListener('DOMContentLoaded', function() {
        var messages = document.querySelectorAll('.message');

        // Hide all messages initially
        messages.forEach(function(message) {
            message.querySelector('.message-text').style.display = 'none';
        });

        // Display messages when a name is clicked
        messages.forEach(function(message) {
            message.addEventListener('click', function() {
                var messageText = message.querySelector('.message-text');
                if (messageText.style.display === 'none') {
                    // Hide all messages
                    messages.forEach(function(msg) {
                        msg.querySelector('.message-text').style.display = 'none';
                    });
                    // Show the clicked message
                    messageText.style.display = 'block';
                } else {
                    // Hide the clicked message
                    messageText.style.display = 'none';
                }
            });
        });
    });
  </script>
</html>
