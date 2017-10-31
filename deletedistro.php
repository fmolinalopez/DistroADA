<?php

include_once 'config.php';
include_once 'connectDb.php';

$id = $_REQUEST['id'];

$sql = "DELETE FROM `distroinfo` WHERE `id` = :id LIMIT 1";

$result = $pdo->prepare($sql);

$result->execute([
    'id' => $id
]);


header('Location: index.php');