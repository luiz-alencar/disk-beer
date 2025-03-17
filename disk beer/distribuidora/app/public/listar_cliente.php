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
    <title>Página Inicial Funcionário</title>
</head>
<body>
    <div class="tabela">
        <center>
            <h2>Lista de Clientes</h2>
                   
            <?php
                require_once '../dao/cliente_dao.php';

                $clienteDao = new ClienteDao();
                $clientes = $clienteDao->listar();

                foreach($clientes as $cliente) {
                    echo "<br>";
                    echo "<table>";
                    echo"<table border='1'>
                    <th>Nome do cliente</th> 
                    <th>CPF</th>
                    <th>Telefone</th>
                    <th>Endereço</th>
                    <th>E-mail</th>";
            
                    echo "<tr>";
            
                    echo "<td>".$cliente->usuario->nome."</td>"; 
                    echo "<td>".$cliente->usuario->cpf."</td>"; 
                    echo "<td>".$cliente->usuario->telefone."</td>"; 
                    echo "<td>".$cliente->usuario->endereco."</td>"; 
                    echo "<td>".$cliente->usuario->email."</td>"; 
                    echo "</table>";
                }
                echo "<br>";
            ?>

            <form action="pag_listagem.php">
                <input type="submit" value="Voltar" />
            </form>
            
        </center> 
    </div>
</body>
</html>
                    