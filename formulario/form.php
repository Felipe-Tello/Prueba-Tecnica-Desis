<!---------------- Validaciones de formulario y envio de datos ---------------->

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

// Obtener los datos del formulario
$nombre = $_POST["nombre"];
$alias = $_POST["alias"];
$rut = strtoupper($_POST["rut"]);
$email = $_POST["email"];
$region = $_POST["region"];
$comuna = $_POST["comuna"];
$candidato = $_POST["candidato"];
$contacto = implode(",", $_POST["contacto"]);

// Validar nombre
if (empty($nombre)) {
  echo "<br><br><a href='index.php'>Volver a intentar</a>";
  die ("El campo nombre no puede quedar en blanco");
}

// Validar alias
if (strlen($alias) < 5 || !preg_match('/[a-zA-Z]/', $alias) || !preg_match('/[0-9]/', $alias)) {
  echo "<br><br><a href='index.php'>Volver a intentar</a>";
  die ("El campo alias debe tener al menos 5 caracteres y contener letras y números");
}

// Validar RUT
if (preg_match("/^\d{1,2}\.\d{3}\.\d{3}-[\dK]$/", $rut) || preg_match("/^\d\.\d{3}\.\d{3}-[\dK]$/", $rut)) {
  $sql = "SELECT * FROM votante WHERE rut = '$rut'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    echo "<br><br><a href='index.php'>Volver al formulario</a>";
    die ("El RUT ya está registrado en la base de datos");
  }
} else {
  echo "<br><br><a href='index.php'>Volver a intentar</a>";
  echo $rut;
  die ("RUT válido");
}

// Validar el email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  echo "<br><br><a href='index.php'>Volver a intentar</a>";
  die ("Email inválido");
}

// Validar la region
if (empty($region)) {
  echo "<br><br><a href='index.php'>Volver a intentar</a>";
  die ("El campo region no puede quedar en blanco");
} else {
  $sql = "SELECT * FROM region WHERE id = '$region'";
  $result = $conn->query($sql);

  if ($result->num_rows == 0) {
    echo "<br><br><a href='index.php'>Volver a intentar</a>";
    die ("La región seleccionada no existe");
  }
}

// Validar la comuna
if (empty($comuna)) {
  echo "<br><br><a href='index.php'>Volver a intentar</a>";
  die ("El campo comuna no puede quedar en blanco");
} else {
  $sql = "SELECT * FROM comuna WHERE id = '$comuna'";
  $result = $conn->query($sql);

  if ($result->num_rows == 0) {
    echo "<br><br><a href='index.php'>Volver a intentar</a>";
    die ("La comuna seleccionada no existe");
  }
}

// Validar la candidato
if (empty($candidato)) {
  echo "<br><br><a href='index.php'>Volver a intentar</a>";
  die ("El campo candidato no puede quedar en blanco");
} else {
  $sql = "SELECT * FROM candidato WHERE id = '$candidato'";
  $result = $conn->query($sql);

  if ($result->num_rows == 0) {
    die ("El candidato seleccionada no existe");
  }
}

// Validar el contacto
if (count($_POST["contacto"]) < 2) {
  echo "<br><br><a href='index.php'>Volver a intentar</a>";
  die ("Debe seleccionar al menos dos opciones de contacto");
} else {
  $contacto = implode(",", $_POST["contacto"]);
}

// Insertar los datos en la base de datos
$sql = "INSERT INTO votante (name, alias, rut, email, contacto, region_id, comuna_id, candidato_id) VALUES ('$nombre', '$alias', '$rut', '$email', '$contacto', '$region', '$comuna', '$candidato')";

if ($conn->query($sql) === TRUE) {
  echo "Datos guardados correctamente";
  echo "<br><br><a href='index.php'>Volver a votar</a>";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
  echo "<br><br><a href='index.php'>Volver a intentar</a>";
}

$conn->close();
?>