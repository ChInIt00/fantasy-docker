<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erregistratu - Bideoklub</title>
    <link rel="stylesheet" href="../css/styles.css"> 
</head>
<body>
    <header>
        <div class="logo">
        <a href="../index.php">
            <img src="../images/logo.png" alt="Logo Videoclub"> <!-- Logo del Videoclub -->
        </a>        </div>
        <h1>Registro de Usuario</h1>
        <nav>
            <ul>
                <li><a href="register.php">Erregistratu</a></li>
                <li><a href="login.php">Saioa Hasi</a></li>
            </ul>
        </nav>
    </header>

    <div class="hero"> 
        <main>
            <form id="register_form" action="/php/register_process.php" method="POST">
                <div>
                    <label for="DNI">NAN:</label>
                    <input type="text" id="DNI" name="DNI" placeholder="12345678-X" required>
                </div>

                <div>
                    <label for="nombre">Izena:</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Izena Abizena" required>
                </div>

                <div>
                    <label for="telefonoa">Telefonoa:</label>
                    <input type="text" id="telefonoa" name="telefonoa" placeholder="123456789" required>
                </div>

                <div>
                    <label for="jaiotze_data">Jaiotze Data:</label>
                    <input type="date" id="jaiotze_data" name="jaiotze_data" required>
                </div>

                <div>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" placeholder="adibidea@zerbitzaria.extensioa" required>
                </div>

                <div>
                    <label for="pasahitza">Pasahitza:</label>
                    <input type="password" id="pasahitza" name="pasahitza" required>
                </div>

                <button type="submit" id="register_submit">Erregistratu</button>
            </form>

            <div id="error-message" style="color: red;"></div>
        </main>
    </div>

    <footer>
        <p>&copy; 2024 Bideokluba</p>
    </footer>
</body>
</html>
