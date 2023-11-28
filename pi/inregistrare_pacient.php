<?php
include 'conexiune.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nume = $_POST['nume'];
    $prenume = $_POST['prenume'];
    $email = $_POST['email'];
    $nume_utilizator = $_POST['nume_utilizator'];
    $parola = password_hash($_POST['parola'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO pacienti (nume, prenume, email, nume_utilizator, parola) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sssss", $nume, $prenume, $email, $nume_utilizator, $parola);

        if ($stmt->execute()) {
            session_start(); // Începe o sesiune (dacă nu este deja începută)
                    $_SESSION['loggedin'] = true; // Setează o variabilă de sesiune pentru a indica autentificarea
                    header('Location: index.php'); // Redirecționează către pagina după autentificare
        } else {
            echo "Eroare la înregistrare: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Eroare la pregătirea declarației: " . $conn->error;
    }
}

$conn->close();
?>
