<?php
require_once '../dao/funcionario_dao.php';
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
    <title>Página Inicial Funcionário</title>
</head>
<body>
    <div class="formulario">
        <center>
        <h1>Bem vindo <?php
        
        echo $_SESSION['funcionario']->usuario->nome;
        ?>, a Disk Beer! </h1>

        <h2>Cadastrar mercadorias:</h2>
        <form action="../view/cadastrar_mercadoria.php">
            <input type="submit" value="Cadastro mercadorias" />
        </form> <br> <br>

        <h2>Cadastrar entregas:</h2>
        <form action="../view/cadastrar_entrega.php">
            <input type="submit" value="Cadastrar entregas" />
        </form> <br> <br>
        
        <form action="../public/inicial_funcionario.php">
            <input type="submit" value="Voltar" />
        </form>
        </center>
    </div>
</body>
</html>

