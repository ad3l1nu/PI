<?php session_start(); ?>

<?php
include 'conexiune.php';

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

// Verificăm dacă este setată sesiunea pentru personalul medical
$personalMedical = false;
if (isset($_SESSION['personal_medical_id'])) {
    // Obținem detalii despre personalul medical din baza de date
    $personalMedicalId = $_SESSION['personal_medical_id'];
    $sqlPersonal = "SELECT * FROM personal_medical WHERE id = $personalMedicalId";
    $resultPersonal = $conn->query($sqlPersonal);

    if ($resultPersonal !== null && $resultPersonal->num_rows > 0) {
        $personalMedical = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediCareHub - Detalii Clinică</title>
    <link rel="stylesheet" href="styles.css"> <!-- Includeți fișierul CSS global -->
    <style>
        /* Stiluri specifice pentru această pagină */
        /* Stiluri generale */
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

        .clinic-info {
            margin-bottom: 20px;
            padding: 20px;
            background-color: #eee;
            border-radius: 8px;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
        }

        .clinic-logo {
            max-width: 100%;
            height: auto;
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

        .footer {
            margin-top: auto;
            background-color: #333;
            color: #fff;
            padding: 1em;
            text-align: center;
        }

        /* Stiluri specifice pentru secțiunile adăugate */
        .programare-section {
            margin-top: 20px;
        }

        .review-section {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <header>
        <h1>MediCareHub</h1>
    </header>

    <nav>
    <a href="index.php">Acasă</a>
        <?php if (!isset($_SESSION['loggedin']))
        { ?>
        <a href="clinica.php">Clinică</a>
        <a href="pacient.php">Pacient</a>
        <?php } ?>

        <a href="guest.php">Vizitator</a>
        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true)
        { ?>
        <a href="logout.php">Deconectare</a>
        <?php } ?>
    </nav>

    <section>
        <h2>Detalii Clinică</h2>

        <?php
        // Afisăm detaliile clinicii
        echo '<div class="clinic-info">';
        echo '<h3>' . $clinicData['clinicName'] . '</h3>';
        echo '<p>' . $clinicData['detali'] . '</p>';
        // Alte informații despre clinică pot fi adăugate aici
        echo '</div>';
        ?>

        <?php
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
            // Obțineți informațiile despre pacient din sesiune sau din baza de date
            $pacientId = isset($_SESSION['pacient_id']) ? $_SESSION['pacient_id'] : null;

            // Verificați dacă a fost trimis formularul de programare
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'programare') {
                // Filtrați și salvați datele primite din formular pentru programare
                $dataProgramare = mysqli_real_escape_string($conn, $_POST['data']);
                $oraProgramare = mysqli_real_escape_string($conn, $_POST['ora']);
                $clinicIdProgramare = mysqli_real_escape_string($conn, $_POST['clinic']);
        
                // Alte acțiuni necesare pentru validare pot fi adăugate aici
        
                // Adăugăm codul pentru inserarea programării în baza de date
                $sqlInserareProgramare = "INSERT INTO programari (pacient_id, clinic_id, data_programare, ora_programare) VALUES (?, ?, ?, ?)";
                $stmtInserareProgramare = $conn->prepare($sqlInserareProgramare);
        
                if ($stmtInserareProgramare) {
                    $stmtInserareProgramare->bind_param("iiss", $pacientId, $clinicIdProgramare, $dataProgramare, $oraProgramare);
                    $stmtInserareProgramare->execute();
        
                    // Verificați dacă inserarea a avut succes
                    if ($stmtInserareProgramare->execute()) {
                        echo "Programarea a fost realizată cu succes!";
                        echo "Data programării: " . $dataProgramare . "<br>";
                        echo "Ora programării: " . $oraProgramare . "<br>";
                        echo "ID Clinic: " . $clinicIdProgramare . "<br>";

                    } else {
                        echo "Eroare la programare. Detalii eroare: " . $stmtInserareProgramare->error;
                    }                    
                    
                    $stmtInserareProgramare->close();
                } else {
                    echo "Eroare la pregătirea declarației: " . $conn->error;
                }
            }
        
            // Afișați formularul pentru programare
            echo '<div class="programare-section">';
            echo '<h3>Programare</h3>';

            echo '<form method="get" action="detalii_clinica.php">';
            echo '<input type="hidden" name="action" value="programare">';
            echo '<input type="hidden" name="clinic_id" value="' . $clinicId . '">'; 

            echo '<label for="data">Data programării:</label>';
            echo '<input type="date" id="data" name="data" required><br>';

            echo '<label for="ora">Ora programării:</label>';
            echo '<input type="time" id="ora" name="ora" required><br>';

            echo '<button type="submit">Programează</button>';
            echo '</form>';
            echo '</div>';
        
            // Afișați formularul pentru review
            echo '<div class="review-section">';
            echo '<h3>Review-uri</h3>';
        
            echo '<form method="post" action="proceseaza_review.php">';
            echo '<label for="review_text">Textul review-ului:</label>';
            echo '<textarea id="review_text" name="review_text" rows="4" cols="50" required></textarea><br>';
        
            echo '<label for="nota">Nota (de la 1 la 10):</label>';
            echo '<input type="number" id="nota" name="nota" min="1" max="10" required><br>';
        
            echo '<button type="submit">Trimite Review</button>';
            echo '</form>';
            echo '</div>';
        } else {
            // Afișați un mesaj dacă pacientul nu este autentificat
            echo '<p>Autentifică-te ca pacient pentru a face o programare sau pentru adăuga un review.</p>';
        }
        ?>

        <a href="guest.php">Înapoi la toate clinicile</a>

    </section>

    <div class="footer">
        <p>&copy; 2023 MediCareHub. Toate drepturile rezervate.</p>
    </div>
</body>
</html>

<?php
// Închide conexiunea la baza de date
$conn->close();
?>
