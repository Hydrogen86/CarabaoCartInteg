
<?php //NEW PHP CODE
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $txtName = htmlspecialchars($_POST['txtName']);
    $txtPhone = htmlspecialchars($_POST['txtPhone']);
    $txtEmail = htmlspecialchars($_POST['txtEmail']);
    $txtMessage = htmlspecialchars($_POST['txtMessage']);

    if (!empty($txtName) && !empty($txtEmail) && !empty($txtMessage)) {
        $xml = simplexml_load_file("../XML/contact.xml") ?: new SimpleXMLElement('<contact/>');//Creating XML File

        $messages = $xml->addChild('messages');
        $messages->addChild('txtName', $txtName);
        $messages->addChild('txtPhone', $txtPhone);
        $messages->addChild('txtEmail', $txtEmail);
        $messages->addChild('txtMessage', $txtMessage);

        if ($xml->asXML("../XML/contact.xml")) {
            header("Location: ../webpages/contact.html?status=success");
        } else {
            header("Location: ../webpages/contact.html?status=error&message=Failed+to+write+XML+file.");
        }
    } else {
        header("Location: ../webpages/contact.html?status=error&message=Invalid+form+data.");
    }
    exit;
} else {
    header("Location: ../webpages/contact.html");
    exit;
}
?>