<?php
session_start(); // Începe sesiunea (dacă nu este deja începută)

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // Utilizatorul este autentificat, afișează conținutul dorit pentru utilizatorul autentificat
    echo "Bine ați venit pe pagina după autentificare!";
} else {
    // Utilizatorul nu este autentificat, poți afișa un mesaj sau redirecționa către pagina de autentificare
    header('Location: autentificare_pacient.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina După Autentificare</title>
    <!-- Alte elemente head pot fi adăugate aici -->
</head>
<body>
    <!-- Conținutul paginii după autentificare poate fi adăugat aici -->
    <h1>Bine ați venit pe pagina după autentificare!</h1>
    <p>Aici poți adăuga conținut specific utilizatorilor autentificați.</p>
</body>
</html>
