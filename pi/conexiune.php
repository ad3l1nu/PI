<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nume_baza_de_date"; // înlocuiește cu numele real al bazei de date

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexiune eșuată: " . $conn->connect_error);
}
?>
