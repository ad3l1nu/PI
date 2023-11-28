<?php
session_start(); // Începe sesiunea (dacă nu este deja începută)

if (isset($_SESSION['loggedin_clinica']) && $_SESSION['loggedin_clinica'] === true) {
    // Clinica este autentificată, afișează conținutul dorit pentru clinica autentificată
    echo "Bine ați venit pe pagina după autentificare pentru clinici!";
} else {
    // Clinica nu este autentificată, poți afișa un mesaj sau redirecționa către pagina de autentificare pentru clinici
    header('Location: autentificare_clinica.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina După Autentificare pentru Clinici</title>
    <!-- Alte elemente head pot fi adăugate aici -->
</head>
<body>
    <!-- Conținutul paginii după autentificare pentru clinici poate fi adăugat aici -->
    <h1>Bine ați venit pe pagina după autentificare pentru clinici!</h1>
    <p>Aici poți adăuga conținut specific clinicilor autentificate.</p>
</body>
</html>