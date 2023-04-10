<!-------------- Quary para la carga de "comunas" dinamicamente -------------->

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

// Obtiene el identificador de la región seleccionada
$region_id = $_GET['region_id'];

// Realiza la consulta SQL para obtener las comunas de la región
$resultado = mysqli_query($conn, 'SELECT comuna.id, comuna.name FROM region JOIN provincia on provincia.region_id = region.id  JOIN comuna on comuna.provincia_id = provincia.id WHERE region_id = ' . $region_id);

// Crea un elemento "select" para mostrar las comunas
echo '<select name="comuna" id="comuna" required>';
  echo '<option selected disabled value="">Selecciona una comuna</option>';
while ($fila = mysqli_fetch_assoc($resultado)) {
  echo '<option value="' . $fila['id'] . '">' . $fila['name'] . '</option>';
}
echo '</select>';

// Cierra la conexión a la base de datos
$conn->close();
?>

<!----------------------------------------------------------------------------->