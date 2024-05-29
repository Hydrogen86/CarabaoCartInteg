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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&family=Questrial&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" href="../images/logo.png">
    <title>Checkout - CarabaoCart</title>
    <style>
        /* Your CSS styles */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f3f3f3;
        }

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
            color: #002868;
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
            color: #002868;
            margin-right: 10px;
        }

        .icons i {
            font-size: 24px;
        }

        .container {
            display: flex;
            flex-direction: row;
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .product-info {
            display: flex;
            flex-direction: column;
            width: 50%;
            padding-right: 20px;
        }

        .product-image img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .product-details {
            margin-top: 10px;
        }

        .product-description {
            font-size: 14px;
        }

        .container form {
            width: 50%;
        }

        .form-control {
            margin-bottom: 15px;
        }

        .form-control label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            font-size: 14px;
        }

        .form-control input,
        .form-control textarea,
        .form-control select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 10px;
        }

        .form-control select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background: url('arrow.png') no-repeat right center;
            background-size: 12px;
        }

        .payment__types {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .payment__type {
            flex: 1;
            text-align: center;
            margin-right: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .payment__type:last-child {
            margin-right: 0;
        }

        .payment__type:hover {
            background-color: #f0f0f0;
        }

        .payment__type.active {
            background-color: #f0f0f0;
            color: #fff;
            border-color: #002868;
        }

        #placeOrderBtn {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: #002868;
            color: #fff;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 18px;
            margin-top: 15px;
        }

        #placeOrderBtn:hover {
            background-color: #001F52;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;
            border-radius: 10px;
            text-align: center;
        }

        .modal-content img {
            width: 100%;
            max-width: 200px;
            margin: 0 auto;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .map-container {
            width: 100%;
            height: 300px;
            margin: 20px auto;
            border-radius: 15px;
            overflow: hidden;
        }

        .map iframe {
            width: 100%;
            height: 100%;
            border-radius: 15px;
        }
    </style>
</head>
<body>
    <!-- Heading -->
    <div class="heading">
        <!-- logo -->
        <div class="logo">
            <a href="index.html">
                <img src="../images/logo.png" alt="">
                <h2>Carabao<br>Cart</h2>
            </a>
        </div>
        <!-- Nav Bar -->
        <div class="navbar">
            <a href="../index.html">Home</a>
            <a href="about.html">About</a>
            <a href="products.html" class="active">Products</a>
            <a href="testimonial.html">Testimonials</a>
            <a href="contact.html">Contact</a>
        </div>
        <div class="search">
            <span class="material-symbols-outlined">search</span>
            <input type="text" placeholder="Search">
            <div class="icons">
                <a href="#"><i class='bx bx-cart'></i></a> <!-- Cart icon -->
                <a href="#"><i class='bx bx-user'></i></a> <!-- Profile icon -->
            </div>
        </div>
    </div>

    <!-- Checkout Form -->
    <br><br><br><br>
    <div class="container">
        <div class="product-info">
            <div class="product-image">
                <img src="../images/pbar.png" alt="Protein Bar">
            </div>
            <div class="product-details">
                <div class="form-control">
                    <label>Product: Protein Bar</label>
                    <label id="productPrice">Price: ₱50.00</label>        
                </div>
                <ul class="product-description">
                    <li><b>Product Description:</b></li><br>
                    <li>Indulge in the creamy goodness and rich flavor with every sip.</li>
                    <li>Perfect for creating delicious smoothies.</li>
                    <li>Locally sourced from trusted dairy farms.</li>
                    <li>Packed with calcium and vitamins, promoting strong bones and overall health.</li>
                    
                </ul>
            </div>
        </div>
        <?php
            // Get all XML files matching the pattern
            $xmlFiles = glob('../XML/productStocks/stockData-*.xml');
            if (!$xmlFiles) {
                echo "No XML files found.";
                exit;
            }

            // Initialize total stock count for Fresh Milk
            $totalFreshMilkStock = 0;

            // Iterate through each XML file
            foreach ($xmlFiles as $xmlFile) {
                // Load the XML file
                $xml = simplexml_load_file($xmlFile);

                // Find the Fresh Milk product and retrieve its stock count
                foreach ($xml->Product as $product) {
                    if ((string)$product['name'] === "Protein Bar") {
                        $totalFreshMilkStock += (int)$product['stock'];
                        break;
                    }
                }
            }

        ?>
        <form action="../Php/save_order.php" method="post">
            <!--Hidden Inputs-->
            <input type="hidden" name="productName" id="productName" value="Protein Bar">
            <input type="hidden" name="productPrice" id="productPrice" value="50">
            <div class="form-control">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="name" required>
            </div>
            <div class="form-control">
                <label for="address">Shipping Address</label>
                <textarea id="address" name="address" class="address" rows="4" required></textarea>
            </div>
            <div class="form-control">
                <label for="quantityInput">Quantity</label>
                <input type="number" id="quantityInput" class="quantityInput" name="quantityInput" min="1" value="1" required>
                <span id="stockCount" class="stock-count">Stock: <?php echo $totalFreshMilkStock; ?></span>
            </div>
            <div class="payment__types">
                <div class="payment__type active" data-method="cod">
                    <img src="../images/cod.png" alt="COD Icon">
                </div>
                <div class="payment__type" data-method="maya">
                    <img src="../images/maya.png" alt="Maya Icon">
                </div>
                <div class="payment__type" data-method="gcash">
                    <img src="../images/gcash.png" alt="Gcash Icon">
                </div>
                <div class="payment__type" data-method="paypal">
                    <img src="../images/paypal.png" alt="Paypal Icon">
                </div>
            </div>
            <br>
            <div id="additional-fields">
                <div id="cod-fields">
                    <!-- Additional fields for Cash on Delivery -->
                    <div class="form-control">
                        <label for="contact-number">Contact Number</label>
                        <input type="text" id="contact-number" class="contact-number" name="contact-number" required>
                    </div>
                </div>
                <div id="gcash-fields" style="display: none;">
                    <!-- Additional fields for GCash -->
                    <div class="form-control">
                        <label for="gcash-reference">GCash Reference Number</label>
                        <input type="text" id="gcash-reference" name="gcash_reference">
                    </div>
                    <div class="form-control">
                        <label for="contact-number">Contact Number</label>
                        <input type="text" id="contact-number" name="contact_number">
                    </div>
                </div>
                <div id="maya-fields" style="display: none;">
                    <!-- Additional fields for Maya -->
                    <div class="form-control">
                        <label for="maya-reference">Maya Reference Number</label>
                        <input type="text" id="maya-reference" name="maya_reference">
                    </div>
                    <div class="form-control">
                        <label for="contact-number">Contact Number</label>
                        <input type="text" id="contact-number" name="contact_number">
                    </div>
                </div>
                <div id="paypal-fields" style="display: none;">
                    <!-- Additional fields for PayPal -->
                    <div class="form-control">
                        <label for="paypal-reference">PayPal Reference Number</label>
                        <input type="text" id="paypal-reference" name="paypal_reference">
                    </div>
                    <div class="form-control">
                        <label for="contact-number">Contact Number</label>
                        <input type="text" id="contact-number" name="contact_number">
                    </div>
                </div>
            </div>
            <button type="submit" id="placeOrderBtn" class="action__submit">Place Order</button>
        </form>
    </div>

    <!-- The Modal -->
    <div id="qrModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p>Scan the QR code using your app.</p>
            <img id="qrCodeImage" src="../images/qr.png" alt="QR Code">
        </div>
    </div>

    <script>
        const paymentTypes = document.querySelectorAll('.payment__type');
        const quantityInput = document.getElementById('quantityInput');
        const stockCount = document.getElementById('stockCount');
        const productPriceLabel = document.getElementById('productPrice');
        const placeOrderBtn = document.getElementById('placeOrderBtn');
        const modal = document.getElementById('qrModal');
        const span = document.getElementsByClassName('close')[0];
        const qrCodeImage = document.getElementById('qrCodeImage');
        const additionalFields = document.querySelectorAll('#additional-fields > div');
    
        let stock = 99;
        const pricePerUnit = 50;
    
        function updatePrice() {
            const quantity = parseInt(quantityInput.value, 10);
            const totalPrice = pricePerUnit * quantity;
            productPriceLabel.textContent = `Price: ₱${totalPrice.toFixed(2)}`;
        }
    
        function decreaseStock(quantity) {
            stock -= quantity;
            stockCount.textContent = `Stock: ${stock}`;
        }
    
        paymentTypes.forEach(type => {
            type.addEventListener('click', () => {
                paymentTypes.forEach(t => t.classList.remove('active'));
                type.classList.add('active');
    
                additionalFields.forEach(field => field.style.display = 'none');
    
                const selectedMethod = type.dataset.method;
                document.getElementById(`${selectedMethod}-fields`).style.display = 'block';
            });
        });
    
        paymentTypes.forEach(type => {
            if (type.dataset.method !== 'cod') {
                type.addEventListener('click', () => {
                    modal.style.display = "block";
                    const selectedPaymentType = type.dataset.method;
                    if (selectedPaymentType === 'gcash') {
                        qrCodeImage.src = "../images/qr.png";
                    } else if (selectedPaymentType === 'maya') {
                        qrCodeImage.src = "../images/qr.png";
                    } else if (selectedPaymentType === 'paypal') {
                        qrCodeImage.src = "../images/qr.png";
                    }
                });
            }
        });
    
        placeOrderBtn.addEventListener('click', () => {
            const selectedPaymentType = document.querySelector('.payment__type.active').dataset.method;
            const quantity = parseInt(quantityInput.value, 10);
    
            if (quantity > stock) {
                alert('Not enough stock available!');
                return;
            }
    
            if (selectedPaymentType === 'cod') {
                decreaseStock(quantity);
            }
        });
    
        span.addEventListener('click', () => {
            modal.style.display = "none";
        });
    
        window.addEventListener('click', (event) => {
            if (event.target === modal) {
                modal.style.display = "none";
            }
        });
    
        quantityInput.addEventListener('input', updatePrice);
        updatePrice();

        window.onload = function() {
            const username = sessionStorage.getItem('loggedInUser');
            if (username) {
                const storedUser = localStorage.getItem(username);
                if (storedUser) {
                    const user = JSON.parse(storedUser);
                    document.getElementById('name').value = user.name;
                    document.getElementById('address').value = user.address;
                    // Assuming you have an email field in your checkout form
                    document.getElementById('email').value = user.email;
                    // Assuming you have a username field in your checkout form
                    document.getElementById('username').value = user.username;
                }
            } else {
                alert('No user is logged in. Redirecting to login page.');
                window.location.href = 'login.html';
            }
        };
    </script>
    
</body>
</html>
