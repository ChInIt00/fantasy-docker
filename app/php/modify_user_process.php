<?php
include 'db_connect.php'; // Incluir la conexión a la base de datos

// Verificar si el método de la solicitud es POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el ID del usuario desde el formulario
    $id_user = intval($_POST['id_user']); // Obteniendo el ID del usuario
    $dni = mysqli_real_escape_string($conn, $_POST['dni']);
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $telefono = mysqli_real_escape_string($conn, $_POST['telefono']);
    $fecha_nacimiento = mysqli_real_escape_string($conn, $_POST['fecha_nacimiento']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Actualizar el usuario en la base de datos
    $sql = "UPDATE usuarios SET DNI='$dni', izen_abizenak='$nombre', telefonoa='$telefono', jaiotze_data='$fecha_nacimiento', email='$email' WHERE id_user='$id_user'";

    if (mysqli_query($conn, $sql)) {
        //echo "Usuario actualizado exitosamente. <a href='show_user.php?user=$id_user'>Ver detalles</a>";
        header("Location: ../orriak/user_menu/user_menu.php?user=$id_user");
    } else {
        echo "Errorea erabiltzailea eguneratzean: " . mysqli_error($conn);
    }
} else {
    echo "Metodo hori ez da onartzen";
}

mysqli_close($conn);
?>