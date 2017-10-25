<?php
include_once 'config.php';
include_once 'connectDB.php';

$id = $_POST['lista'];

$queryResult = $pdo->prepare("SELECT * from distroinfo where id = :valor");

$queryResult->execute([
        'valor' => $id,
]);

$row = $queryResult->fetch(PDO::FETCH_ASSOC);
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
    <link rel="stylesheet" href="css/app.css">
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
    <h1>Informacion de la distribucion</h1>

    <h2>· Nombre: <?=$row['nombre']; ?></h2>

    <ul>
        <li><h3>Os type: <?=$row['ostype']; ?></h3></li>
        <li><h3>Basado en: <?=$row['basadoen']; ?></h3></li>
        <li><h3>Basado en: <?=$row['basadoen']; ?></h3></li>
        <li><h3>Arquitectura: <?=$row['arquitectura']; ?></h3></li>
        <li><h3>Escritorio: <?=$row['escritorio']; ?></h3></li>
        <li><h3>Categoría: <?=$row['categoria']; ?></h3></li>
    </ul>
</div>
</body>
</html>
