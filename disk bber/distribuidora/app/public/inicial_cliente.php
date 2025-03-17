<?php
require_once '../dao/cliente_dao.php';
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
        <h1>Bem vindo <?php
        
        echo $_SESSION['cliente']->usuario->nome;
        ?>, ao Sistema de entregas ANA & CIA</h1> <br>

        <h2>Minhas entregas</h2>
        <a href="lista_entrega_cliente.php">Visualizar entregas</a> <br><br>

        <h2>Alterar Dados pessoais:</h2>
        <a href="dados_cliente.php">Meus dados pessoais</a> <br><br><br>

        <form action="../controller/encerrar_sessao.php">
            <input type="submit" value="Sair" />
        </form>


        </center>
    </div>
</body>
</html>