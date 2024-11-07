<?php
//validamos datos del servidor
$_server = "LocalHost";
$db = "registro_evento_torrijos";
$user = "root";
$pass = ""; 

$connection = mysqli_connect($_server, $user, $pass, $db );

if (!$connection){
  die("Conexion fallida: " . mysqli_connect_errno());
}
    $nombre = $_POST['nombre'];
    $rut = $_POST['rut'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];

    $imagen ='';
    if(isset($_FILES["imagen"])){
        $file = $_FILES["imagen"];
        $nombre_original = $file["name"];
        $tipo = $file["type"];
        $ruta_temporal = $file["tmp_name"];
        $size = $file["size"];
    
        // Validar el tipo de archivo
        $tipos_permitidos = array('image/jpeg', 'image/png', 'image/gif');
        if (!in_array($tipo, $tipos_permitidos)) {
            echo "Tipo de archivo no permitido.";
        } else if ($size > 3*1024*1024 || $size <= 0) {
            echo "El tamaño de la imagen debe estar entre 0 y 3 MB.";
        } else {
            // Generar un nombre único para evitar sobreescrituras
            $nombre_unico = uniqid() . "_" . $nombre_original;
            $carpeta_destino = "Fotos/";
            $ruta_destino = $carpeta_destino . $nombre_unico;
    
            // Mover el archivo a la carpeta de destino
            if (move_uploaded_file($ruta_temporal, $ruta_destino)) {
                // Imagen subida correctamente
                $imagen = $ruta_destino;
                // Aquí puedes guardar la ruta de la imagen en la base de datos
            } else {
                echo "Error al subir la imagen.";
            }
        }
    }

    $stmt = $connection->prepare("INSERT INTO registro_evento_torrijos.asistentes (nombre, rut, email, telefono, imagen) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nombre, $rut, $email, $telefono, $imagen);
    
    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Datos insertados correctamente.";
    } else {
        echo "Error al insertar datos: " . $stmt->error;
    }
    
    $stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos Ingresados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjX0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1>Datos Ingresados</h1>
        <?php
            // Conexión a la base de datos (asegúrate de tener los mismos datos de conexión)
            $servername = "localhost";
            $dbname = "registro_evento_torrijos";
            $username = "root";
            $password = ""; 
            
            $connection = mysqli_connect($_server, $user, $pass, $db );

            // Verificar la conexión
            if (!$connection){
                die("Conexion fallida: " . mysqli_connect_errno());
            }

            // Obtener 1  el último registro insertado
            try {
                $conn = new mysqli($servername, $username, $password, $dbname);
                // ... resto de tu código
            } catch (mysqli_sql_exception $exception) {
                echo "Error de conexión: " . $exception->getMessage();
            }
            
            $sql = "SELECT * FROM asistentes ORDER BY id DESC LIMIT 1";
            $result = $conn->query($sql);
            
            if (!$result) {
                die("Error en la consulta: " . mysqli_error($conn));
            }

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<table class='table'>";
                    echo "<tr><td>Nombre</td><td>" . $row["nombre"] . "</td></tr>";
                    echo "<tr><td>RUT</td><td>" . $row["rut"] . "</td></tr>";
                    echo "<tr><td>Email</td><td>" . $row["email"] . "</td></tr>";
                    echo "<tr><td>Teléfono</td><td>" . $row["telefono"] . "</td></tr>";
                    echo "<tr><td>Imagen</td><td><img src='" . $row["imagen"] . "' alt='Imagen del asistente'></td></tr>";
                    echo "</table>";
                }
            } else {
                echo "No se encontraron registros.";
            }

            $conn->close();
        ?>
    </div>
</body>
</html>