<?php
if(!isset($_SESSION)){
    session_start();
}
if(empty($_SESSION['funcionario']) or empty($_SESSION['logado'])){
    header('Location: ../public/index.php');
}

$situacao = $_GET['situacao'];
header("Location: ../public/listar_entrega.php?situacao=" . $situacao);
