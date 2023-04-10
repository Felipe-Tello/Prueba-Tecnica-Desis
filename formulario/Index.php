<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <form class="form-box" method="post" action="form.php">
            <div>
                <h3>FORMULARIO DE VOTACIÓN:</h3>
            </div>
            <div class="form-section">
                <label for="nombre">Nombre y Apellido:</label>
                <input type="text" name="nombre" id="nombre" oninvalid="this.setCustomValidity('Nombre no debe estar en blanco')" oninput="setCustomValidity('')" required>
            </div>
            <div class="form-section">
                <label for="alias">Alias:</label>
                <input type="text" name="alias" id="alias" minlength="5" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]+$" title="El Alias debe tener al menos 5 caracteres y contener letras y números." required>
            </div>
            <div class="form-section">
                <label for="rut">RUT:</label>
                <input type="text" name="rut" id="rut" pattern="^\d{1,2}\.\d{3}\.\d{3}-[\dKk]$|^[\dKk]\.\d{3}\.\d{3}-[\dKk]$" title="El RUT debe tener este formato XX.XXX.XXX-X" required>
            </div>
            <div class="form-section">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="form-section">
                <label for="region">Región:</label>
                <select name="region" id="region" onchange="cargarComunas()" required>
                <!----------------- Quary para la carga de "regiones"----------------->
                <?php include('carga-regiones.php'); ?>
                <!---------------------------------------------------------------------->
                </select>
            </div>
            <div class="form-section">
                <label for="comuna">Comuna:</label>
                <select name="comuna" id="comuna" required>
                    <option selected disabled value="">Selecciona una Region</option>
                </select>
            </div>
            <div class="form-section">
                <label for="candidato">Candidato:</label>
                <select name="candidato" name="candidato" required>
                <!----------------- Quary para la carga de "candidatos"----------------->
                <?php include('carga-candidatos.php'); ?>
                <!---------------------------------------------------------------------->
                </select>
            </div>
            <div class="form-section">
                <label>¿Cómo se enteró de nosotros?</label>
                <div style="display:flex;">
                    <div class="check">
                        <input type="checkbox" name="contacto[]" id="Web" value="Web">    
                        <label for="Web">Web</label>
                    </div>
                    <div class="check">
                        <input type="checkbox" name="contacto[]" id="TV" value="TV">
                        <label for="TV">TV</label>
                    </div>
                    <div class="check">
                        <input type="checkbox" name="contacto[]" id="Redes Sociales" value="Redes Sociales">
                        <label for="Redes Sociales">Redes Sociales</label>
                    </div>
                    <div class="check">
                        <input type="checkbox" name="contacto[]" id="Amigo" value="Amigo">
                        <label for="Amigo">Amigo</label>
                    </div>
                </div>
            </div>
            <p id="contacto-error" style="color: red; display: none;">Selecciona al menos 2 opciones</p>
            <input class="btn btn-primary" type="submit" value="Votar">
        </form>
    </div>
    <!----------------- Verificar que almenos existan 2 checkbox seleccionados ----------------->
    <script src="js/verificarCheckbox.js"></script>
    <!------------------------------------------------------------------------------------------->

    <!---------------------- Realizar Peticion Ajax para conseguir comunas ---------------------->
    <script src="js/cargarComunas.js"></script>
    <!------------------------------------------------------------------------------------------->
</body>
</html>
