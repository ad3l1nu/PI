<?php
include 'conexiune.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifică dacă sunt setate toate câmpurile necesare
    if (isset($_POST['data'], $_POST['ora'], $_POST['clinic'])) {
        // Filtrați și salvați datele primite din formular
        $dataProgramare = mysqli_real_escape_string($conn, $_POST['data']);
        $oraProgramare = mysqli_real_escape_string($conn, $_POST['ora']);
        $clinicIdProgramare = mysqli_real_escape_string($conn, $_POST['clinic']);

        // Alte acțiuni necesare pentru validare pot fi adăugate aici

        // Verificăm dacă pacientul este autentificat
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
            // Obținem informațiile despre pacient din sesiune sau din baza de date
            $pacientId = $_SESSION['pacient_id']; // Modificați acest lucru în funcție de cum v-ați setat sesiunea

            // Adăugăm codul pentru inserarea programării în baza de date
            $sqlInserareProgramare = "INSERT INTO programari (pacient_id, clinic_id, data_programare, ora_programare) VALUES (?, ?, ?, ?)";
            $stmtInserareProgramare = $conn->prepare($sqlInserareProgramare);

            if ($stmtInserareProgramare) {
                $stmtInserareProgramare->bind_param("iiss", $pacientId, $clinicIdProgramare, $dataProgramare, $oraProgramare);
                $stmtInserareProgramare->execute();

                // Verificați dacă inserarea a avut succes
                if ($stmtInserareProgramare->affected_rows > 0) {
                    echo "Programarea a fost realizată cu succes!";
                } else {
                    echo "Eroare la programare. Vă rugăm să încercați din nou.";
                }

                $stmtInserareProgramare->close();
            } else {
                echo "Eroare la pregătirea declarației: " . $conn->error;
            }
        } else {
            // Afișați un mesaj dacă pacientul nu este autentificat
            echo "Trebuie să fiți autentificat pentru a face o programare.";
        }
    } else {
        // Afișați un mesaj dacă nu sunt setate toate câmpurile necesare
        echo "Completați toate câmpurile pentru a face o programare.";
    }
} else {
    // Afișați un mesaj dacă formularul nu a fost trimis prin metoda POST
    echo "Acces neautorizat.";
}

// Închideți conexiunea la baza de date
$conn->close();
?>
