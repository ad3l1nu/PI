<?php
session_start();
include 'conexiune.php';

if (!isset($_SESSION['pacient_id'])) {
    echo json_encode(["error" => "Pacient neautentificat"]);
    exit();
}

$pacientId = $_SESSION['pacient_id'];

$sqlPacient = "SELECT nume, prenume, email FROM pacienti WHERE id = ?";
$stmtPacient = $conn->prepare($sqlPacient);

if ($stmtPacient) {
    $stmtPacient->bind_param("i", $pacientId);
    $stmtPacient->execute();
    $resultPacient = $stmtPacient->get_result();

    if ($resultPacient->num_rows > 0) {
        $pacientData = $resultPacient->fetch_assoc();
    } else {
        echo json_encode(["error" => "Informații despre pacient indisponibile"]);
        exit();
    }

    $stmtPacient->close();
} else {
    echo json_encode(["error" => "Eroare la pregătirea declarației: " . $conn->error]);
    exit();
}

$conn->close();

$responseData = [
    "nume" => $pacientData['nume'],
    "prenume" => $pacientData['prenume'],
    "email" => $pacientData['email']
];

echo json_encode($responseData);
?>
