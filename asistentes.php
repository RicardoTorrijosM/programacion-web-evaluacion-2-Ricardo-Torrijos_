
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="estilos/estilos.css">

    <style>
        .formulario-contenedor {
            margin: 0 auto;
            height: 415px;
        }

        form {
            max-width: 500px;
            background-color: #f2f2f2;
            padding: 150px;
            border-radius: 30px;
            margin: 0 auto;
        }

    </style>
</head>

<body>
<form  action="ver_asistentes.php" method="POST" enctype="multipart/form-data">
    <div class="formulario-contenedor">
        
        <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label" for="form2Example1">Nombre</label>
            <input type="text" name="nombre" class="form-control" />
        </div>

        <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label" for="form2Example1">Rut</label>
            <input type="text" name="rut" class="form-control" />    
        </div>

        <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label" for="form2Example1">Email</label>
            <input type="email" name="email" class="form-control" />
        </div>

        <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label" for="form2Example1">Telefono</label>
            <input type="text" name="telefono" class="form-control" />
        </div>

        <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label" for="imagen">Imagen</label>
            <input type="file" name="imagen" class="form-control"  />
        </div>
        <button  type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4">Enviar</button>
        <?php
        if (empty($_POST['nombre']) || empty($_POST['rut']) || empty($_POST['email']) || empty($_POST['telefono'])) {
        echo '<p class="text-danger">Debe ingresar  los datos.</p>';
        }
        ?>

        
    </div>
</form>

</body>

</html>