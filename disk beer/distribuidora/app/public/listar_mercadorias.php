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
            <h2>Lista de Mercadorias</h2>
                   
            <?php
                require_once '../dao/mercadoria_dao.php';

                $mercadoriaDao = new MercadoriaDao();
                $mercadorias = $mercadoriaDao->listar();

                foreach($mercadorias as $mercadoria) {
                    echo "<br>";
                    echo "<table>";
                    echo"<table border='1'>
                    <th>Nome da Mercadoria</th> 
                    <th>Preço</th> 
                    
                    ";
            
                    echo "<tr>";
            
                    echo "<td>".$mercadoria->nome."</td>";
                    echo "<td>".$mercadoria->preco."</td>";
            
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
                    