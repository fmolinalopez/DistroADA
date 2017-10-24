<?php
include_once 'config.php';
include_once 'connectDB.php';

$errors = [];

if (!empty($_POST)){
    $nombre = $_POST['nombre'];
    $ostype = $_POST['ostype'];
    $basadoen = $_POST['basadoen'];
    $origen = $_POST['origen'];
    $escritorio = $_POST['escritorio'];
    $arquitectura = $_POST['arquitectura'];
    $categoria = $_POST['categoria'];

    //Validar que elija algun sistema operativo
//    if ($ostype = ''){
//        $errors['ostype_vacio'] = 'Debes elegir un sistema operativo';
//    }

    if (empty($errors)){

        $sql = "INSERT INTO `distroinfo` (`id`, `nombre`, `ostype`, `basadoen`, `origen`, `arquitectura`, `escritorio`, `categoria`) VALUES (NULL, :nombre, :ostype, :basadoen, :origen, :escritorio, :arquitectura, :categoria)";

        $result = $pdo->prepare($sql);

        $result->execute([
            'nombre' => $nombre,
            'ostype' => $ostype,
            'basadoen' => $basadoen,
            'origen' => $origen,
            'arquitectura' => $arquitectura,
            'escritorio' => $escritorio,
            'categoria' => $categoria,
        ]);

        header('Location: index.php');
    }
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DistroADA</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h1>Añadir distribucion</h1>

    <ul>
        <li><a class="btn btn-primary" href="index.php">Inicio</a> </li>
    </ul>

    <form action="adddistro.php" method="post">
        <div class="form-group">
            <label for="nombre">Nombre de la distribucion</label>
            <input class="form-control" type="text" id="nombre" name="nombre" required>
        </div>

        <div class="form-group">
            <label for="ostype">Tipo de sistema operativo</label><br>
            <select name="ostype" id="ostype" required>
                <option value="" disabled selected></option>
                <option value="Linux">Linux</option>
                <option value="Bsd">BSD</option>
                <option value="Linux/bsd">Linux, BSD</option>
            </select>
        </div>

<!--        --><?php //if (isset($errors['ostype_vacio'])): ?>
<!--            --><?php //foreach ($errors['ostype_vacio'] as $clave => $valor): ?>
<!--                <p class="bg-danger">· --><?//=$valor;?><!--</p>-->
<!--            --><?php //endforeach; ?>
<!--        --><?php //endif; ?>

        <div class="form-group">
            <label for="basadoen">Basado en</label>
            <input class="form-control" type="text" id="basadoen" name="basadoen" required>
        </div>

        <div class="form-group">
            <label for="origen">Origen</label>
            <input class="form-control" type="text" id="origen" name="origen" required>
        </div>

        <div class="form-group">
            <label for="arquitectura">Arquitectura</label>
            <input class="form-control" type="text" id="arquitectura" name="arquitectura" required>
        </div>

        <div class="form-group">
            <label for="escritorio">Escritorio</label>
            <input class="form-control" type="text" id="escritorio" name="escritorio" required>
        </div>

        <div class="form-group">
            <label for="categoria">Categoria</label>
            <input class="form-control" type="text" id="categoria" name="categoria" required>
        </div>

        <div class="form-group">
            <input class="btn btn-success" type="submit" value="Añadir">
        </div>
    </form>
</div>
</body>
</html>
