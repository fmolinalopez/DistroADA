<?php
include_once 'config.php';
include_once 'connectDB.php';

$id = $_GET['id'];

echo $id;

$errors = [];

if (!empty($_POST)){
    $nombre = $_POST['nombre'];
    $ostype = $_POST['ostype'];
    $basadoen = $_POST['basadoen'];
    $origen = $_POST['origen'];
    $escritorio = $_POST['escritorio'];
    $arquitectura = $_POST['arquitectura'];
    $categoria = $_POST['categoria'];
    $id = $_POST['id'];

    echo $nombre.$ostype.$basadoen;
    //if (empty($errors)){

    $sql = "UPDATE distroinfo SET nombre = :nombre, ostype = :ostype, basadoen = :basadoen, origen = :origen, escritorio = :escritorio, arquitectura = :arquitectura, categoria = :categoria WHERE id = :id";

    $result = $pdo->prepare($sql);

    $result->execute([
        'nombre' => $nombre,
        'ostype' => $ostype,
        'basadoen' => $basadoen,
        'origen' => $origen,
        'arquitectura' => $arquitectura,
        'escritorio' => $escritorio,
        'categoria' => $categoria,
        'id' => $id,
    ]);

    header('Location: index.php');
    //}

}else {
    $distro = dameDistro($pdo, $id);
}

function dameDistro($pdo, $id){
    $queryResult = $pdo->prepare("SELECT * from distroinfo where id = :id");

    $queryResult->execute([
        'id' => $id,
    ]);

    return $queryResult->fetch(PDO::FETCH_ASSOC);
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
    <h1>Editar distribucion</h1>

    <ul>
        <li><a class="btn btn-primary" href="index.php">Inicio</a> </li>
    </ul>

    <form action="editdistro.php" method="post">
        <input type="hidden" name="id" value="<?=$distro['id']?>">
        <div class="form-group">
            <label for="nombre">Nombre de la distribucion</label>
            <input class="form-control" type="text" id="nombre" name="nombre" value="<?=$distro['nombre'];?>" required>
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

        <div class="form-group">
            <label for="basadoen">Basado en</label>
            <input class="form-control" type="text" id="basadoen" name="basadoen" value="<?=$distro['basadoen']?>" required>
        </div>

        <div class="form-group">
            <label for="origen">Origen</label>
            <input class="form-control" type="text" id="origen" name="origen" value="<?=$distro['origen']?>" required>
        </div>

        <div class="form-group">
            <label for="arquitectura">Arquitectura</label>
            <input class="form-control" type="text" id="arquitectura" name="arquitectura" value="<?=$distro['arquitectura']?>" required>
        </div>

        <div class="form-group">
            <label for="escritorio">Escritorio</label>
            <input class="form-control" type="text" id="escritorio" name="escritorio" value="<?=$distro['escritorio']?>" required>
        </div>

        <div class="form-group">
            <label for="categoria">Categoria</label>
            <input class="form-control" type="text" id="categoria" name="categoria" value="<?=$distro['categoria']?>" required>
        </div>

        <div class="form-group">
            <input class="btn btn-success" type="submit" value="Guardar">
        </div>
    </form>
</div>
</body>
</html>

