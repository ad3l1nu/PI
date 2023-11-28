<?php
include 'conexiune.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Colectează datele din formular
    $clinicEmail = $_POST['clinicEmail'];
    $clinicPassword = $_POST['clinicPassword'];

    // Validează și filtrează datele
    $clinicEmail = filter_var($clinicEmail, FILTER_SANITIZE_EMAIL);

    // Verifică datele de autentificare în baza de date
    $sql = "SELECT * FROM clinici WHERE clinicEmail=? LIMIT 1";
    $stmt = $conn->prepare($sql);

    // Verifică dacă declarația pregătită s-a realizat cu succes
    if ($stmt) {
        // Leagă variabilele la declarația pregătită
        $stmt->bind_param("s", $clinicEmail);

        // Execută declarația pregătită
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Verifică parola
            if (password_verify($clinicPassword, $row['clinicPassword'])) {
                session_start(); // Începe o sesiune (dacă nu este deja începută)
                    $_SESSION['loggedin_clinica'] = true; // Setează o variabilă de sesiune pentru a indica autentificarea
                    header('Location: index.php'); // Redirecționează către pagina după autentificare
            } else {
                echo "Parolă incorectă.";
            }
        } else {
            echo "Clinică inexistentă.";
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
