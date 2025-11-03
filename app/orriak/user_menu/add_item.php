<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Film bat gehitu - Bideoklub</title>
    <link rel="stylesheet" href="../../css/styles.css"> <!-- Enlace a tu archivo CSS -->
</head>
<body>
    <header>
        <div class="logo">
            <a href="user_menu.php">
                <img src="../../images/logo.png" alt="Logo Videoclub"> <!-- Logo del Videoclub -->
            </a>
        </div>
        <h1>Film bat gehitu</h1>
        <nav>
            <ul>
                <li><a href="/php/logout.php">Cerrar sesión</a></li>
            </ul>
        </nav>
    </header>

    <div class="hero"> 
    <main>
        <form id="item_add_form" action="../../php/add_item_process.php" method="POST">
            <label for="izenburua">Izenburua:</label>
            <input type="text" id="izenburua" name="izenburua" required>

            <label for="zuzendaria">Zuzenendaria:</label>
            <input type="text" id="zuzendaria" name="zuzendaria" required>

            <label for="estrenaldi_urtea">Estrenaldi Urtea:</label>
            <input type="text" id="estrenaldi_urtea" name="estrenaldi_urtea" required>

            <label for="generoa">Generoa:</label>
            <input type="text" id="generoa" name="generoa" required>

            <button type="submit" id="item_add_submit">Filmea Gehitu</button>
        </form>
    </main>
    </div>

    <footer>
        <p>&copy; 2024 Bideokluba.</p>
    </footer>
</body>
</html>
