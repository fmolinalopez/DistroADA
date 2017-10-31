<?php
include_once 'config.php';
include_once 'connectDB.php';

$queryResult = $pdo->query("SELECT id, nombre from distroinfo");
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DistroAda</title>
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
            <a class="navbar-brand" href="#">Distro ADA</a>
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
    <h1>DISTRO ADA</h1>
    <h2>Lista de Distribuciones:</h2>

    <table class="table">
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Informacion</th>
            <th>Editar</th>
            <th>Borrar</th>
        </tr>
        <?php while ($row = $queryResult->fetch(PDO::FETCH_ASSOC)): ?>
            <tr>
                <td><?= $row['id']; ?></td>
                <td><?= $row['nombre']; ?></td>
                <td><a href="listdistroinfo.php?id=<?=$row['id']?>" class="listar">
                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                    </a>
                </td>
                <td><a href="editdistro.php?id=<?=$row['id']?>" class="editar">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                </td>
                <td><a href="deletedistro.php?id=<?=$row['id'];?>" class="borrar">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</div>
</body>
</html>
