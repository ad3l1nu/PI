
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediCarePlus - Pagina Pacient</title>
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
        <h2>Autentificare Pacient</h2>
        <p>Autentifică-te pentru a accesa serviciile MediCareHub.</p>
        
        <div id="access-options">
            <div class="access-option">
                <h4>Autentificare</h4>
                <p>Accesează contul tău MediCareHub.</p>
                <form method="post" action="login_pacient.php">
                    <label for="username">Email:</label>
                    <input type="text" id="username" name="username" required>

                    <label for="password">Parolă:</label>
                    <input type="password" id="password" name="password" required>

                    <button type="submit">Autentificare</button>
                </form>
            </div>
            <div class="access-option">
                <h4>Înregistrare</h4>
                <p>Creează-ți un cont MediCareHub.</p>
                
                <form method="post" action="inregistrare_pacient.php">
                    <label for="nume">Nume:</label>
                    <input type="text" id="nume" name="nume" required>

                    <label for="prenume">Prenume:</label>
                    <input type="text" id="prenume" name="prenume" required>

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>

                    <label for="nume_utilizator">Nume Utilizator:</label>
                    <input type="text" id="nume_utilizator" name="nume_utilizator" required>

                    <label for="parola">Parolă:</label>
                    <input type="password" id="parola" name="parola" required>

                    <button type="submit">Înregistrare</button>
                </form>
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; 2023 MediCarePlus. Toate drepturile rezervate.</p>
    </footer>
</body>
</html>