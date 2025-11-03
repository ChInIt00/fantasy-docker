<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Bideoklub</title>
    <link rel="stylesheet" href="../css/styles.css"> 
</head>
<body>
    <header>
        <div class="logo">
        <a href="../index.php">
            <img src="../images/logo.png" alt="Logo Videoclub"> <!-- Logo del Videoclub -->
        </a>
        </div>
        <h1>Saioa Hasi</h1>
        <nav>
            <ul>
                <li><a href="register.php">Erregistratu</a></li>
                <li><a href="login.php">Saioa Hasi</a></li>
            </ul>
        </nav>
    </header>


    <div class="hero"> 
        <main>
            <form id="login_form" action="/php/login_process.php" method="POST">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="pasahitza">Pasahitza:</label>
                <input type="password" id="pasahitza" name="pasahitza" required>

                <button type="submit" id="login_submit">Saioa Hasi</button>
            </form>
        </main>
    </div>
    
    <footer>
        <p>&copy; 2024 Bideokluba</p>
    </footer>
</body>
</html>
