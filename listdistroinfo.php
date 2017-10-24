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
</head>
<body>
<div class="container">
    <h1>Informacion de la distribucion</h1>

    <h2>· Nombre: <?=$row['nombre']; ?></h2>

    <li>Os type: <?=$row['ostype']; ?></li>
    <li>Basado en: <?=$row['basadoen']; ?></li>
    <li>Origen: <?=$row['origen']; ?></li>
    <li>Arquitectura: <?=$row['arquitectura']; ?></li>
    <li>Escritorio: <?=$row['escritorio']; ?></li>
    <li>Categoría: <?=$row['categoria']; ?></li>

</div>
</body>
</html>
