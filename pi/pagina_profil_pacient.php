<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pacient</title>
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
            padding: 10px 20px;
            font-size: 16px;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #2980b9;
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
        <h1>Profil Pacient</h1>
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
        <h2>Informații Profil</h2>

        <p>Nume: <span id="nume"></span></p>
        <p>Prenume: <span id="prenume"></span></p>
        <p>Email: <span id="email"></span></p>
        <!-- Alte informații despre profil pot fi adăugate aici -->

        <a href="modifica_profil_pacient.php">Modifică Profil</a>
    </section>

    <a href="logout.php">Deconectare</a>

    <footer>
        <p>&copy; 2023 MediCarePlus. Toate drepturile rezervate.</p>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var data = JSON.parse(this.responseText);

                    document.getElementById('nume').innerText = data.nume;
                    document.getElementById('prenume').innerText = data.prenume;
                    document.getElementById('email').innerText = data.email;

                }
            };

            xhr.open("GET", "proceseaza_profil_pacient.php", true);
            xhr.send();
        });

        function modificaProfil() {
            window.location.href = "modifica_profil_pacient.php";
        }
    </script>
</body>
</html>
