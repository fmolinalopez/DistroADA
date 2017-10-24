<?php

include_once 'config.php';
include_once 'connectDb.php';

$id = $_POST['deletedistro'];

print_r($id);

$sql = "DELETE FROM `distroinfo` WHERE `id` = :valor LIMIT 1";

print_r($sql);

$result = $pdo->prepare($sql);

$result->execute([
    'valor' => $id
]);


header('Location: index.php');