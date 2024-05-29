<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userID = $_POST["userID"] ?? '';
    $name = $_POST["name"] ?? '';
    $carabaoCount = $_POST["carabao-count"] ?? 0;

    if (!empty($userID) && !empty($name) && is_numeric($carabaoCount)) {
        $xml = simplexml_load_file("../XML-File/userData.xml") ?: new SimpleXMLElement('<data/>');//Creating XML File

        $user = $xml->addChild('user');
        $user->addChild('userID', $userID);
        $user->addChild('name', $name);
        $user->addChild('carabaoCount', $carabaoCount);

        if ($xml->asXML("../XML-File/userData.xml")) {
            header("Location: ../HTML-File/index.html?status=success");
        } else {
            header("Location: ../HTML-File/index.html?status=error&message=Failed+to+write+XML+file.");
        }
    } else {
        header("Location: ../HTML-File/index.html?status=error&message=Invalid+form+data.");
    }
    exit;
} else {
    header("Location: ../HTML-File/index.html");
    exit;
}
?>

