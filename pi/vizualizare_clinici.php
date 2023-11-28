<?php
include 'conexiune.php'; // include fișierul de conexiune

// Verificăm dacă a fost furnizat un ID valid pentru clinică în parametrul URL-ului
if (isset($_GET['clinic_id']) && is_numeric($_GET['clinic_id'])) {
    $clinicId = $_GET['clinic_id'];

    // Interogare pentru a obține detalii despre clinica specificată
    $sql = "SELECT * FROM clinici WHERE id = $clinicId";
    $result = $conn->query($sql);

    // Verificăm dacă există rezultate pentru interogare
    if ($result !== null && $result->num_rows > 0) {
        // Extragem datele clinicii
        $clinicData = $result->fetch_assoc();
    } else {
        // Afisăm un mesaj dacă nu există clinică cu ID-ul specificat
        echo '<p>Clincă inexistentă sau ID clinică invalid.</p>';
        exit(); // Întrerupem execuția scriptului
    }
} else {
    // Afisăm un mesaj dacă nu a fost furnizat un ID valid pentru clinică
    echo '<p>Parametru clinic_id lipsă sau invalid.</p>';
    exit(); // Întrerupem execuția scriptului
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediCarePlus - Pagina Principală</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 1em;
            text-align: center;
        }

        nav {
            background-color: #444;
            padding: 1em;
            text-align: center;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            margin: 0 15px;
            transition: color 0.3s ease-in-out;
        }

        nav a:hover {
            color: #ffcc00;
        }

        section {
            padding: 20px;
            background-color: #fff;
            margin: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form {
            max-width: 400px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        button {
            background-color: #333;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #555;
        }

        #access-options {
            text-align: center;
        }

        .access-option {
            margin: 20px;
            padding: 15px;
            background-color: #eee;
            border-radius: 8px;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
        }

        .access-option a {
            text-decoration: none;
            color: #333;
        }

        .access-option h4 {
            margin-top: 0;
        }

        .access-option p {
            margin-bottom: 0;
        }

        footer {
            margin-top: auto;
            background-color: #333;
            color: #fff;
            padding: 1em;
            text-align: center;
        }
    </style>
</head>
<body>
    <header>
        <h1>MediCareHub</h1>
    </header>

    <nav>
        <a href="index.php">Acasă</a>
        <?php if (!(isset($_SESSION['loggedin']) || isset($_SESSION['loggedin_clinica'])))
        { ?>
        <a href="clinica.php">Clinică</a>
        <a href="pacient.php">Pacient</a>
        <?php } ?>

        <a href="guest.php">Vizitator</a>
        <?php if (isset($_SESSION['loggedin']) || isset($_SESSION['loggedin_clinica']))
        { ?>
        <a href="logout.php">Deconectare</a>
        <?php } ?>
    </nav>

    <section>
        <h2>Detalii Clinică</h2>

        <?php
        // Afisăm detaliile clinicii
        echo '<div class="clinic-info">';
        echo '<img src="' . $clinicData['logo_path'] . '" alt="Logo Clinică" class="clinic-logo">';
        echo '<h3>' . $clinicData['nume'] . '</h3>';
        echo '<p>' . $clinicData['detalii'] . '</p>';
        // Alte informații despre clinică pot fi adăugate aici
        echo '</div>';
        ?>

        <a href="vizualizare_clinici.php">Înapoi la toate clinicile</a>

    </section>

    <div class="footer">
        <p>&copy; 2023 MediCarePlus. Toate drepturile rezervate.</p>
    </div>
</body>
</html>

<?php
// Închide conexiunea la baza de date
$conn->close();
?>
