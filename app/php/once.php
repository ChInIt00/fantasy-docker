<?php
include '../header.php'; // Header general

$mysqli = new mysqli("db", "admin", "test", "database");
if ($mysqli->connect_errno) {
    die("Error al conectar a la base de datos: " . $mysqli->connect_error);
}

// Tomamos el slug del equipo de la URL
$slug = isset($_GET['team']) ? trim($_GET['team']) : '';

if (!$slug) {
    echo "<main style='padding:20px'><h2>Equipo no especificado</h2></main>";
    exit;
}

// Buscamos el equipo por slug
$sql_team = "SELECT id, name, slug FROM teams WHERE slug = ? LIMIT 1";
$stmt = $mysqli->prepare($sql_team);
$stmt->bind_param('s', $slug);
$stmt->execute();
$res = $stmt->get_result();
$team = $res->fetch_assoc();
$stmt->close();

if (!$team) {
    echo "<main style='padding:20px'><h2>Equipo no encontrado</h2></main>";
    exit;
}

$team_id = (int)$team['id'];
$team_name = $team['name'];
$team_slug = $team['slug'];

// Obtenemos los 11 jugadores más valiosos del equipo (simulando el once probable)
$sql_once = "
SELECT p.id, p.name
FROM players p
INNER JOIN market_values mv ON mv.player_id = p.id
WHERE p.team_id = ?
  AND p.name IS NOT NULL
  AND mv.date = (SELECT MAX(date) FROM market_values)
ORDER BY mv.value_eur DESC
LIMIT 11
";
$stmt_once = $mysqli->prepare($sql_once);
$stmt_once->bind_param('i', $team_id);
$stmt_once->execute();
$res_once = $stmt_once->get_result();
$once_players = $res_once->fetch_all(MYSQLI_ASSOC);
$stmt_once->close();

// Mapeo de slugs a imágenes reales
$img_map = [
    'athletic-club' => 'athletic',
    'atletico-madrid' => 'atletico',
    'celta-vigo' => 'celta',
    'real-betis' => 'betis',
    'rayo-vallecano' => 'rayo'
];

$escudo_img = $img_map[$team_slug] ?? $team_slug;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Once probable: <?php echo htmlspecialchars($team_name); ?></title>
    <link rel="stylesheet" href="/css/styles.css">
    <style>
        main { padding: 18px; max-width: 1100px; margin: 0 auto; }
        .team-header { display:flex; align-items:center; gap:16px; margin-bottom:18px; }
        .team-header h1 { margin:0; font-size:28px; }
        .tabs { margin-bottom:18px; }
        .tabs a { display:inline-block; padding:8px 14px; margin-right:8px; background:#eee; color:#111; text-decoration:none; border-radius:6px; }
        .tabs a.active { background:#1e73be; color:white; }
        .players-table { width:100%; border-collapse:collapse; background:#242424; }
        .players-table th, .players-table td { padding:10px; border-bottom:1px solid #2a2a2a; text-align:left; }
        .players-table th { background:#009846; color:white; }
    </style>
</head>
<body>
<main>
    <div class="team-header">
        <img src="/images/escudos/<?php echo htmlspecialchars($escudo_img); ?>.png"
             alt="<?php echo htmlspecialchars($team_name); ?>"
             style="width:72px;height:72px;object-fit:contain">
        <div>
            <h1><?php echo htmlspecialchars($team_name); ?></h1>
            <p style="margin:4px 0;color:#666">Once probable</p>
        </div>
    </div>

    <div class="tabs">
        <a href="/php/equipos.php?team=<?php echo urlencode($team_slug); ?>">Plantilla</a>
        <a href="/php/partidos.php?team=<?php echo urlencode($team_slug); ?>">Calendario</a>
        <a href="/php/once.php?team=<?php echo urlencode($team_slug); ?>" class="active">Once probable</a>
    </div>

    <section>
        <?php if (count($once_players) === 0): ?>
            <p>No se han encontrado jugadores para <?php echo htmlspecialchars($team_name); ?>.</p>
        <?php else: ?>
            <table class="players-table">
                <thead>
                    <tr>
                        <th>Posición</th>
                        <th>Jugador</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $pos = 1; foreach ($once_players as $pl): ?>
                        <tr>
                            <td><?php echo $pos++; ?></td>
                            <td><?php echo htmlspecialchars($pl['name']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </section>
</main>
</body>
</html>
