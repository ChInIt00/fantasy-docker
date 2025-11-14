<?php
$equipos = [
    'Alaves' => 'alaves',
    'Athletic' => 'athletic',
    'Atletico' => 'atletico',
    'Barcelona' => 'barcelona',
    'Betis' => 'betis',
    'Celta' => 'celta',
    'Elche' => 'elche',
    'Espanyol' => 'espanyol',
    'Getafe' => 'getafe',
    'Girona' => 'girona',
    'Levante' => 'levante',
    'Mallorca' => 'mallorca',
    'Osasuna' => 'osasuna',
    'Rayo Vallecano' => 'rayo',
    'Real Oviedo' => 'oviedo',
    'Real Madrid' => 'real-madrid',
    'Real Sociedad' => 'real-sociedad',
    'Sevilla' => 'sevilla',
    'Valencia' => 'valencia',
    'Villarreal' => 'villarreal'
];
?>
<header>
    <div class="logo">
        <a href="/index.php">
            <img src="/images/logo.png" alt="King Fantasy">
        </a>
    </div>

    <nav class="escudos">
        <?php foreach ($equipos as $nombre => $slug): ?>
            <a href="/php/equipos.php?team=<?php echo $slug; ?>" title="<?php echo $nombre; ?>">
                <img src="/images/escudos/<?php echo $slug; ?>.png" alt="<?php echo $nombre; ?>" class="escudo">
            </a>
        <?php endforeach; ?>
    </nav>

    <nav class="links">
        <ul>
            <li><a href="/php/subidas_bajadas.php">Subidas/Bajadas</a></li>
            <li><a href="/php/players.php">Jugadores</a></li>
        </ul>
    </nav>
</header>
