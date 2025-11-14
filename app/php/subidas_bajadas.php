<?php
$mysqli = new mysqli("db", "admin", "test", "database");
if ($mysqli->connect_errno) {
    die("Error al conectar: " . $mysqli->connect_error);
}

// ---- BUSCADOR ----
$search = isset($_GET['search']) ? $mysqli->real_escape_string($_GET['search']) : "";

// ---- ORDENADO ----
$allowedSort = [
    'value_asc' => "current_value ASC",
    'value_desc' => "current_value DESC",
    'change_asc' => "change_value ASC",
    'change_desc' => "change_value DESC"
];

$sort = isset($_GET['sort']) && isset($allowedSort[$_GET['sort']])
    ? $allowedSort[$_GET['sort']]
    : "current_value DESC"; // Orden por defecto

// ---- CONSULTA DE SUBIDAS/BAJADAS ----
$query = "
SELECT 
    p.name,
    t.name AS team_name,
    mv.value_eur AS current_value,
    (
        SELECT mv2.value_eur 
        FROM market_values mv2
        WHERE mv2.player_id = p.id 
        ORDER BY mv2.date DESC
        LIMIT 1 OFFSET 1
    ) AS previous_value,
    (mv.value_eur - COALESCE(
        (SELECT mv2.value_eur 
        FROM market_values mv2
        WHERE mv2.player_id = p.id 
        ORDER BY mv2.date DESC
        LIMIT 1 OFFSET 1), mv.value_eur)) AS change_value
FROM players p
LEFT JOIN teams t ON p.team_id = t.id
LEFT JOIN market_values mv ON mv.player_id = p.id
WHERE mv.date = (SELECT MAX(date) FROM market_values)
AND p.team_id IS NOT NULL
" . ($search ? "AND p.name LIKE '%$search%'" : "") . "
ORDER BY $sort;
";

$result = $mysqli->query($query);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Subidas y Bajadas</title>
    <link rel="stylesheet" href="../css/styles.css">
    <style>
        table { width: 100%; border-collapse: collapse; background: #2a2a2a; }
        th, td { padding: 12px; text-align: center; }
        th { background: #009846; }
        tr:nth-child(even) { background: #242424; }
        .up { color: #00ff6a; font-weight: bold; }
        .down { color: #ff3f3f; font-weight: bold; }
        .search-box { text-align: center; margin: 15px 0; }
        .search-box input { padding: 6px; width: 250px; }
        .filters { text-align: center; margin-bottom: 15px; }
        .filters a { color: white; margin: 0 10px; text-decoration: none; }
        .filters a:hover { text-decoration: underline; }
    </style>
</head>
<body>

<?php include '../header.php'; ?>

<h2 style="text-align:center;">📈 Subidas y Bajadas del Mercado</h2>

<div class="search-box">
    <form method="GET">
        <input type="text" name="search" placeholder="Buscar jugador..." value="<?= htmlspecialchars($search) ?>">
        <button type="submit">Buscar</button>
    </form>
</div>

<div class="filters">
    Ordenar por:
    <a href="?sort=value_asc">Valor ascendente</a>
    <a href="?sort=value_desc">Valor descendente</a>
    |
    <a href="?sort=change_desc">Mayor subida</a>
    <a href="?sort=change_asc">Mayor bajada</a>
</div>

<table>
<tr>
    <th>Jugador</th>
    <th>Equipo</th>
    <th>Valor Actual (€)</th>
    <th>Cambio</th>
</tr>

<?php while ($row = $result->fetch_assoc()):
    $current = $row['current_value'];
    $prev = $row['previous_value'];

    if ($prev === null) {
        $changeText = "-";
        $class = "";
    } else {
        $diff = $current - $prev;
        if ($diff > 0) { $changeText = "+" . number_format($diff, 0, ',', '.'); $class = "up"; }
        elseif ($diff < 0) { $changeText = number_format($diff, 0, ',', '.'); $class = "down"; }
        else { $changeText = "0"; $class = ""; }
    }
?>
<tr>
    <td><?= htmlspecialchars($row['name']) ?></td>
    <td><?= htmlspecialchars($row['team_name']) ?></td>
    <td><?= number_format($current, 0, ',', '.') ?> €</td>
    <td class="<?= $class ?>"><?= $changeText ?></td>
</tr>
<?php endwhile; ?>

</table>

</body>
</html>
