<?php
if(!isset($_SESSION)){
    session_start();
}
if(empty($_SESSION['cliente']) or empty($_SESSION['logado'])){
    header('Location: ../public/index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../view/estilo.css">
    <title>Página Inicial Funcionário</title>
</head>
<body>
    <div class="formulario">
        <center>
        <h1>Bem vindo ao Sistema de entregas ANA & CIA</h1> <br>

        <h2>Cadastrar Cliente</h2>
        <a href="../view/cadastrar_cliente.php">cadastrar cliente</a> <br><br>

        <h2>Cadastrar Funcionário</h2>
        <a href="../view/cadastrar_funcionario.php">Cadastrar Funcionário</a><br><br>

        <h2>Cadastrar Mercadoria</h2>
        <a href="../view/cadastrar_mercadoria.php">Cadastrar Mercadoria</a> <br><br>

        <h2>Cadastrar Entrega</h2>
        <a href="../view/cadastrar_entrega.php">Cadastrar Entrega</a> <br><br>

        <form action="javascript:history.go(-1)">
            <input type="submit" value="Voltar" />
        </form>
        </center>
    </div>
</body>
</html>
