<?php

$host = 'mariadb-server';
$db = 'distribuidora';
$user = 'root';
$password = '123';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $password);
    echo 'Conectado com sucesso!';
} catch (PDOException $e) {
    echo $e->getMessage();
    echo 'Erro ao conectar!';
}