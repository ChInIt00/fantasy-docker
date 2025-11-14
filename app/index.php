<?php
// index.php: Home Page
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>King Fantasy</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<?php include 'header.php'; ?>

<main>
    <section class="hero">
        <div class="hero-content">
            <h2>👑 ¡Bienvenido a King Fantasy!</h2>
            <p>Donde los reyes del fútbol se forjan.</p>
        </div>
    </section>

    <section class="sections-overview">
        <div class="section-card">
            <h3>Subidas/Bajadas de Valor</h3>
            <p>Mira qué jugadores están aumentando y decreciendo su valor en el mercado.</p>
            <a href="php/subidas_bajadas.php">Ver subidas/bajadas</a>
        </div>
        <div class="section-card">
            <h3>Jugadores</h3>
            <p>Lista completa de jugadores y sus valores actuales.</p>
            <a href="pages/players.php">Ver jugadores</a>
        </div>
        <div class="section-card">
            <h3>Equipos</h3>
            <p>Información sobre los equipos participantes y sus jugadores.</p>
            <a href="pages/teams.php">Ver equipos</a>
        </div>
    </section>
</main>

<footer>
    <p>&copy; <?php echo date('Y'); ?> King Fantasy ⚽👑</p>
</footer>

</body>
</html>
