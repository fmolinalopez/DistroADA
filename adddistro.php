<?php
include_once 'config.php';
include_once 'connectDB.php';
include_once 'helpers.php';
include_once 'arrays.php';

// Creada variable error por si en el futuro añadimos errores en el formulario
$errors = [];
$error = false;

if (!empty($_POST)){
    $nombre = htmlspecialchars(trim($_POST['nombre']));
    $ostype = $_POST['ostype'] ?? "";
    $basadoen = $_POST['basadoen'] ?? array();
    $origen = $_POST['origen'] ?? "";
    $arquitectura = $_POST['arquitectura'] ?? array();
    $escritorio = $_POST['escritorio'] ?? array();
    $categoria = $_POST['categoria'] ?? array();
    $descripcion = htmlspecialchars(trim($_POST['descripcion']));

    if ($nombre === "" ){
        $errors['name']['required'] = 'Debes introducir un nombre';
    }
    if ($ostype === ""){
        $errors['osType']['required'] = 'Debes seleccionar un sistema operativo';
    }
    if (!isset($_POST['basadoen'])){
        $errors['basedOn']['required'] = 'Debes seleccionar al menos un elemento';
    }
    if ($origen === ""){
        $errors['origin']['required'] = 'Debes seleccionar un lugar de origen';
    }
    if (!isset($_POST['arquitectura'])){
        $errors['arch']['required'] = 'Debes seleccionar al menos una arquitectura';
    }
    if (!isset($_POST['escritorio'])){
        $errors['desktop']['required'] = 'Debes seleccionar al menos un escritorio';
    }
    if (!isset($_POST['categoria'])){
        $errors['category']['required'] = 'Debes seleccionar al menos una categoria';
    }
    if ($descripcion === ""){
        $errors['description']['required'] = 'Debes introducir una descripcion';
    }

    if (empty($errors)){
        $basadoen = arrayToString($basadoen);
        $arquitectura = arrayToString($arquitectura);
        $escritorio = arrayToString($escritorio);
        $categoria = arrayToString($categoria);

        $sql = "INSERT INTO `distroinfo` (`id`, `nombre`, `ostype`, `basadoen`, `origen`, `arquitectura`, `escritorio`, `categoria`, `descripcion`, created_at) VALUES (NULL, :nombre, :ostype, :basadoen, :origen, :escritorio, :arquitectura, :categoria, :descripcion, NOW())";

        $result = $pdo->prepare($sql);

        $result->execute([
            'nombre' => $nombre,
            'ostype' => $ostype,
            'basadoen' => $basadoen,
            'origen' => $origen,
            'arquitectura' => $arquitectura,
            'escritorio' => $escritorio,
            'categoria' => $categoria,
            'descripcion' => $descripcion,
        ]);

        header('Location: index.php');
    }else {
        $error = true;
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
    <link rel="stylesheet" href="appCss/app.css">
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Distro ADA</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="index.php">Inicio</a></li>
                <li><a href="adddistro.php">Añadir Distro</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
<div class="container">
    <h1>Añadir distribucion</h1>

    <form action="adddistro.php" method="post">
        <div class="form-group">
            <label for="nombre">Nombre de la distribucion</label>
            <input class="form-control" type="text" id="nombre" name="nombre" value="<?=$error?$nombre:"";?>" required>
        </div>

        <?php if (isset($errors['name'])): ?>
            <?php foreach ($errors['name'] as $clave => $valor): ?>
                <p class="bg-danger">· <?=$valor;?></p>
            <?php endforeach; ?>
        <?php endif; ?>

        <div class="form-group">
            <label for="ostype">Tipo de sistema operativo</label>
            <?=generarSelect($ostypeList, $ostype ?? "", "ostype", false)?>
        </div>

        <?php if (isset($errors['osType'])): ?>
            <?php foreach ($errors['osType'] as $clave => $valor): ?>
                <p class="bg-danger">· <?=$valor;?></p>
            <?php endforeach; ?>
        <?php endif; ?>

        <div class="form-group">
            <label for="basadoen">Basado en</label>
            <?=generarSelect($basedOnList, $basadoen ?? "", "basadoen", true);?>
        </div>

        <?php if (isset($errors['basedOn'])): ?>
            <?php foreach ($errors['basedOn'] as $clave => $valor): ?>
                <p class="bg-danger">· <?=$valor;?></p>
            <?php endforeach; ?>
        <?php endif; ?>

        <div class="form-group">
            <label for="origen">Origen</label>
            <?=generarSelect($countries, $origen ?? "", "origen", false)?>
        </div>

        <?php if (isset($errors['origin'])): ?>
            <?php foreach ($errors['origin'] as $clave => $valor): ?>
                <p class="bg-danger">· <?=$valor;?></p>
            <?php endforeach; ?>
        <?php endif; ?>

        <div class="form-group">
            <label for="arquitectura">Arquitectura</label>
            <?=generarSelect($architecture, $arquitectura ?? "", "arquitectura", true)?>
        </div>

        <?php if (isset($errors['arch'])): ?>
            <?php foreach ($errors['arch'] as $clave => $valor): ?>
                <p class="bg-danger">· <?=$valor;?></p>
            <?php endforeach; ?>
        <?php endif; ?>

        <div class="form-group">
            <label for="escritorio">Escritorio</label>
            <?=generarSelect($desktops, $escritorio ?? "", "escritorio", true)?>
        </div>

        <?php if (isset($errors['desktop'])): ?>
            <?php foreach ($errors['desktop'] as $clave => $valor): ?>
                <p class="bg-danger">· <?=$valor;?></p>
            <?php endforeach; ?>
        <?php endif; ?>

        <div class="form-group">
            <label for="categoria">Categoria</label>
            <?=generarSelect($categories, $categoria ?? "", "categoria", true)?>
        </div>

        <?php if (isset($errors['category'])): ?>
            <?php foreach ($errors['category'] as $clave => $valor): ?>
                <p class="bg-danger">· <?=$valor;?></p>
            <?php endforeach; ?>
        <?php endif; ?>

        <div class="form-group">
            <label for="descripcion">Description</label>
            <textarea class="form-control" name="descripcion" id="descripcion" rows="5" value="<?=$error?$descripcion:"";?>"></textarea>
        </div>

        <?php if (isset($errors['description'])): ?>
            <?php foreach ($errors['description'] as $clave => $valor): ?>
                <p class="bg-danger">· <?=$valor;?></p>
            <?php endforeach; ?>
        <?php endif; ?>

        <div class="form-group">
            <input class="btn btn-success" type="submit" value="Añadir">
        </div>
    </form>
</div>
</body>
</html>
