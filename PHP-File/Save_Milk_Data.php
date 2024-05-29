<?php
// Set the default timezone to your local timezone
date_default_timezone_set('Asia/Manila');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Create a unique filename based on current timestamp
    $date = date("m-d-Y");
    $index = 0;
    $xmlFileName = "../XML-File/milkData-$date.xml";

    // Check if a file with the current date already exists
    while (file_exists($xmlFileName)) {
        $index++;
        $xmlFileName = "../XML-File/milkData-$date-$index.xml";
    }

    // Create a new XML file with a root element
    $xml = new SimpleXMLElement('<data/>');

    // Load user data to determine the number of users
    $userData = simplexml_load_file("../XML-File/userData.xml");

    // Initialize totals variables
    $totalMilkDeposit = 0;
    $totalMilkRejected = 0;
    $totalMilkAccepted = 0;
    $totalMilkCost = 0;

    // Process each user's milk data
    foreach ($userData->user as $user) {
        $userID = (string)$user->userID;
        $name = (string)$user->name;

        // Check if the user has deposited milk
        $milkDeposit = $_POST["milk_deposit"][$userID] ?? 0;
        if ($milkDeposit > 0) {
            $rejectedMilk = $_POST["rejected_milk"][$userID] ?? 0;

            // Calculate accepted milk and total cost
            $acceptedMilk = $milkDeposit - $rejectedMilk;
            $totalCost = $acceptedMilk * 100; // Assuming cost is 100 per Liter

            // Add to totals
            $totalMilkDeposit += $milkDeposit;
            $totalMilkRejected += $rejectedMilk;
            $totalMilkAccepted += $acceptedMilk;
            $totalMilkCost += $totalCost;

            // Create a new milk record node
            $milkRecord = $xml->addChild('record');
            $milkRecord->addChild('userID', $userID);
            $milkRecord->addChild('name', $name);
            $milkRecord->addChild('milkDeposit', $milkDeposit);
            $milkRecord->addChild('rejectedMilk', $rejectedMilk);
            $milkRecord->addChild('acceptedMilk', $acceptedMilk);
            $milkRecord->addChild('totalCost', $totalCost);
            //$milkRecord->addChild('timeSaved', date('m-d-Y H:i:s'));
            $milkRecord->addChild('timeSaved', date('m-d-Y g:i a'));
        }
    }

    // Create node for totals
    $totalsNode = $xml->addChild('totals');
    $totalsNode->addChild('totalMilkDeposit', $totalMilkDeposit);
    $totalsNode->addChild('totalMilkRejected', $totalMilkRejected);
    $totalsNode->addChild('totalMilkAccepted', $totalMilkAccepted);
    $totalsNode->addChild('totalMilkCost', $totalMilkCost);

    // Save the XML file with the unique filename
    if ($xml->asXML($xmlFileName)) {
        
        // Pass the totalMilkAccepted value to the milkStocks.xml file
        $milkStocksFile = '../CarabaoCart-Elpie-v2/XML/milkStocks.xml';
        
        // Load or create milkStocks.xml
        if (file_exists($milkStocksFile)) {
            $milkStocksXml = simplexml_load_file($milkStocksFile);
        } else {
            $milkStocksXml = new SimpleXMLElement('<stocks/>');
        }

        // Update or add the totalMilkAccepted element in milkStocks.xml
        if (isset($milkStocksXml->totalMilkAccepted)) {
            $milkStocksXml->totalMilkAccepted = $totalMilkAccepted;
        } else {
            $milkStocksXml->addChild('totalMilkAccepted', $totalMilkAccepted);
        }

        // Save the updated milkStocks.xml file
        if ($milkStocksXml->asXML($milkStocksFile)) {
            header("Location: Deposit.php?status=success");
            exit;
        } else {
            header("Location: Deposit.php?status=error&message=Failed+to+update+milkStocks.xml.");
            exit;
        }
    } else {
        header("Location: Deposit.php?status=error&message=Failed+to+write+XML+file.");
        exit;
    }
} else {
    header("Location: Deposit.php");
    exit;
}

?>