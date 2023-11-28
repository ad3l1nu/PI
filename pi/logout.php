<?php
// Începe sau reia sesiunea
session_start();

// Distrug sesiunea existentă (dacă există)
session_destroy();

// Redirecționează către pagina de autentificare
header('Location: index.php');
exit();
?>
