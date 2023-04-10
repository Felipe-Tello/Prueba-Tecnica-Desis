function cargarComunas() {
    var region_id = document.getElementById("region").value;
    console.log(region_id);
    
    // Crea un objeto XMLHttpRequest para hacer la petición AJAX
    var xhr = new XMLHttpRequest();

    // Define la función que manejará la respuesta de la petición AJAX
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
        // Reemplaza el contenido del elemento "comunas" con las opciones obtenidas
        document.getElementById("comuna").innerHTML = xhr.responseText;
        }
    };

    // Envía la petición AJAX para obtener las comunas de la región seleccionada
    xhr.open("GET", "carga-comunas.php?region_id=" + region_id, true);
    xhr.send();
    }

// Asigna la función "cargarComunas" como manejador del evento "change" en el elemento "region"
document.getElementById("region").addEventListener("change", cargarComunas);
