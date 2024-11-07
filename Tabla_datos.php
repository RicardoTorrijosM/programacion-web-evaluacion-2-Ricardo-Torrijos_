<?php
$_server = "localhost";
$db = "registro_evento_torrijos";
$user = "root";
$pass = "";

$connection = mysqli_connect($_server, $user, $pass, $db);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_errno());
}

$sql = "SELECT nombre, rut, email, telefono, fecha_registro FROM asistentes";
$result = mysqli_query($connection, $sql);

if (!$result) {
    echo "Error: " . mysqli_error($connection);
} 

mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  </head>
<body>
  <div class="container">
    <h1>Lista de Asistentes</h1>
    <?php
    if ($result->num_rows > 0) {
      echo "<table>";
      echo "<tr><th>Nombre</th><th>Rut</th><th>Email</th><th>Teléfono</th><th>fecha</th></tr>";
      while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["nombre"] . "</td>";
        echo "<td>" . $row["rut"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["telefono"] . "</td>";
        echo "<td>" . $row["fecha_registro"] . "</td>";
        echo "</tr>";
      }
      echo "</table>";
    } else {
      echo "No se encontraron registros.";
    }
    ?>
    </div>
</body>
</html>