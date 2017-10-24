<?php
try {
    $pdo = new PDO("mysql:host=$server;dbname=$database", $user, $password);
}catch (PDOException $e){
    die("No se puede conectar a la base de datos");
}