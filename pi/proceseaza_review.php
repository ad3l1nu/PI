<?php
include 'conexiune.php';

session_start();

// Verificăm dacă utilizatorul este autentificat ca pacient
if (isset($_SESSION['pacient_id'])) {
    // Colectăm datele din formularul de review
    $clinicId = isset($_POST['clinic_id']) ? $_POST['clinic_id'] : '';
    $reviewText = isset($_POST['review_text']) ? $_POST['review_text'] : '';
    $nota = isset($_POST['nota']) ? $_POST['nota'] : '';

    // Validează și filtrează datele
    $clinicId = filter_var($clinicId, FILTER_VALIDATE_INT);
    $reviewText = filter_var($reviewText, FILTER_SANITIZE_STRING);
    $nota = filter_var($nota, FILTER_VALIDATE_INT);

    // Verificăm dacă datele sunt valide
    if ($clinicId && $reviewText && $nota && $nota >= 1 && $nota <= 10) {
        // Inserează review-ul în baza de date
        $sql = "INSERT INTO reviewuri (clinic_id, pacient_id, review_text, nota) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $pacientId = $_SESSION['pacient_id'];
            $stmt->bind_param("iisi", $clinicId, $pacientId, $reviewText, $nota);

            if ($stmt->execute()) {
                echo "Review-ul a fost adăugat cu succes!";
                // Poți adăuga orice altă acțiune necesară după adăugarea review-ului
            } else {
                echo "Eroare la adăugarea review-ului: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Eroare la pregătirea declarației: " . $conn->error;
        }
    } else {
        echo "Datele introduse pentru review nu sunt valide.";
    }
} else {
    echo "Acces nepermis! Utilizatorul nu este autentificat ca pacient.";
}

// Închide conexiunea la baza de date
$conn->close();
?>
