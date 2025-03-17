<?php
if(!isset($_SESSION)){
    session_start();
}
if(empty($_SESSION['funcionario']) or empty($_SESSION['logado'])){
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
    <title>Tela de Listagens</title>
</head>
<body>
    <div class="formulario">
        <center>
        <h1>Bem vindo a Disk Beer!</h1> <br>

        <!-- <h2>Listar Clientes</h2>
        <a href="../public/listar_cliente.php">Listar Clientes</a> <br><br>

        <h2>Listar Funcionários</h2>
        <a href="../public/listar_funcionario.php">Listar Funcionários</a><br><br> -->

        <h2>Listar Mercadorias</h2>
        <form action="../public/listar_mercadorias.php">
            <input type="submit" value="Listar mercadorias" />
        </form> <br> <br>

        <h2>Listar Entregas</h2>
        <form action="../public/listar_entrega.php">
            <input type="submit" value="Listar entregas" />
        </form> <br> <br>
        
        <form action="../public/inicial_funcionario.php">
            <input type="submit" value="Voltar" />
        </form>
        </center>
    </div>
</body>
</html>