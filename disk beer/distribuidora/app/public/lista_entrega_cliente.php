<?php
require_once '../dao/cliente_dao.php';
if(!isset($_SESSION)){
    session_start();
}
if(empty($_SESSION['cliente']) or empty($_SESSION['logado'])){
    header('Location: ../public/index.html');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../view/estilo.css">
    <title>Minhas entregas</title>
    
</head>
<body>
    <div class="formulario">
        <center>
        <h1>Lista de Entregas</h1>
        
        <?php
            require_once '../dao/entrega_dao.php';
            $entrega_dao = new EntregaDao();
            $entregas = $entrega_dao->buscar_cliente_id($_SESSION['cliente']->id);

            foreach($entregas as $resultado) {
                echo "<table>";
                echo"<table border='1'>
                <th>Nome do cliente</th> 
                <th>Endereço</th>
                <th>Telefone</th>
                <th>Situação</th>";
                echo "<tr>";

                echo "<td>".$resultado->cliente->usuario->nome."</td>"; 
                echo "<td>".$resultado->cliente->usuario->endereco."</td>"; 
                echo "<td>".$resultado->cliente->usuario->telefone."</td>"; 
                echo "<td>".$resultado->situacao."</td>"; 

                echo "<br>";

                echo "<table border='1'> 
                <th>Mercadoria</th>
                <th>Quantidade</th>
                <th>Valor Unitário</th>";
                
                foreach($resultado->mercadorias as $mercadoria) {
                    echo "<tr>";
                    echo "<td>".$mercadoria->nome."</td>";
                    echo "<td>".$mercadoria->quantidade."</td>";
                    echo "<td>".$mercadoria->preco."</td>";
                }
                echo "</table>";
            }
            echo "<br>";
        ?>
        <form action="inicial_cliente.php">
            <input type="submit" value="Voltar" />
        </form>
        </center>
    </div>
</body>
</html>