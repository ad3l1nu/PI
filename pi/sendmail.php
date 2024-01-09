<?php
include('src/functions.php');
session_start();
$id = $_SESSION['id'];
$name = $_POST['nam'];
$from = $_POST['from'];
$sub = $_POST['sub'];
$mess = $_POST['mess'];
$to = "cristian.aldea03@e-uvt.ro";
$head = 'From: ' . $name . "\r\n" .
    'Reply-To: ' . $from . "\r\n" . // Note the corrected header name
    'X-Mailer: PHP/' . phpversion();

if (mail($to, $sub, $mess, $head)) {
    alert_and_redirect("Sent Successfully", "index.php");
} else {
    alert_and_redirect("Failed to send email. Please try again.", "contact.php");
}
?>
