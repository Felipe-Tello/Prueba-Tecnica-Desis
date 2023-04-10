<!-------------- Quary para la carga de "regiones" -------------->

<?php
// datos de conexion
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "php_tecnica";

// Conecta a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar la conexión
if ($conn->connect_error) {
  die("Conexión fallida: " . $conn->connect_error);
}

// Realiza la consulta SQL
$resultado = mysqli_query($conn, 'SELECT id, name FROM php_tecnica.region');

// Crea el elemento "option"
echo '<option selected disabled value="">Selecciona una Region</option>';

// Recorre los resultados y agrega cada fila como una opción del elemento "select"
while ($fila = mysqli_fetch_assoc($resultado)) {
    echo '<option value="' . $fila['id'] . '">' . $fila['name'] . '</option>';
}

// Cierra la conexión a la base de datos
$conn->close();
?>

<!----------------------------------------------------------------------------->