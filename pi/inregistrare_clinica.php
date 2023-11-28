<?php
include 'conexiune.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $clinicName = $_POST['clinicName'];
    $clinicEmail = $_POST['clinicEmail'];
    $clinicPassword = password_hash($_POST['clinicPassword'], PASSWORD_DEFAULT);

    // Folosește declarații pregătite pentru securitate
    $sql = "INSERT INTO clinici (clinicName, clinicEmail, clinicPassword) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Verifică dacă declarația pregătită s-a realizat cu succes
    if ($stmt) {
        // Leagă variabilele la declarația pregătită
        $stmt->bind_param("sss", $clinicName, $clinicEmail, $clinicPassword);

        // Execută declarația pregătită
        if ($stmt->execute()) {
            session_start(); // Începe o sesiune (dacă nu este deja începută)
                    $_SESSION['loggedin_clinica'] = true; // Setează o variabilă de sesiune pentru a indica autentificarea
                    header('Location: index.php'); // Redirecționează către pagina după autentificare
        } else {
            echo "Eroare la înregistrare: " . $stmt->error;
        }

        // Închide declarația pregătită
        $stmt->close();
    } else {
        echo "Eroare la pregătirea declarației: " . $conn->error;
    }
}

// Închide conexiunea la baza de date
$conn->close();
?>