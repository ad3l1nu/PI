<?php
include 'conexiune.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    $username = filter_var($username, FILTER_SANITIZE_STRING);
    $password = filter_var($password, FILTER_SANITIZE_STRING);

    $sql = "SELECT * FROM pacienti WHERE email = ? AND parola = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ss", $username, $password);

        if ($stmt->execute()) {
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo "Autentificare reușită!";
                if ($result->num_rows > 0) {
                    // Utilizator autentificat cu succes
                    session_start(); // Începe o sesiune (dacă nu este deja începută)
                    $_SESSION['loggedin'] = true; // Setează o variabilă de sesiune pentru a indica autentificarea
                    header('Location: index.php'); // Redirecționează către pagina după autentificare
                    exit(); // Asigură-te că scriptul se încheie aici pentru a evita continuarea execuției
                } else {
                    echo "Date de autentificare incorecte!";
                    header('Location: index.php'); // Redirecționează către pagina după autentificare
                }
                // Aici poți redirecționa către pagina principală a pacientului sau să adaugi orice altă acțiune
            }
        } else {
            echo "Eroare la autentificare: " . $stmt->error;
        }



        $stmt->close();
    } else {
        echo "Eroare la pregătirea declarației: " . $conn->error;
    }
} else {
    echo "Acces nepermis!";
}

$conn->close();
?>
