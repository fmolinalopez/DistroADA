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
</head>
<body>
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
                <td>
                    <form action="listdistroinfo.php" method="post">
                        <input type="hidden" name="lista" value="<?=$row['id']; ?>">
                        <input class="btn btn-primary" type="submit" value="Info">
                    </form>
                </td>
                <td><a href="editdistro.php?id=<?=$row['id']?>" class="btn btn-warning">Editar</a></td>
                <td>
                    <form action="deletedistro.php" method="post">
                        <input type="hidden" name="deletedistro" value="<?=$row['id']; ?>">
                        <input class="btn btn-danger" type="submit" value="Borrar">
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <a class="btn btn-success" href="adddistro.php">Añadir distro</a>
</div>
</body>
</html>
