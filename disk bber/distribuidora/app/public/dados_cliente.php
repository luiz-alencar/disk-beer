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
    <title>Meus dados</title>
</head>
<body>
    <div class="tabela">
        <center>
            <h1>Dados cadastrais</h1>
            <table border="1">
                <tr>
                <th>Nome</th>
                <th>CPF</th>
                <th>Data de nascimento</th>
                <th>Telefone</th>
                <th>E-mail</th>
                <th>Endereço</th>
                <th>Ação</th>
                </tr>
                <?php
                    $cliente_dao = new ClienteDao();
                    $cliente = $cliente_dao->buscar_id($_SESSION['cliente']->id);
                    echo "<tr>";
                    echo "<td>" . $cliente->usuario->nome . "</td>";
                    echo "<td>" . $cliente->usuario->cpf . "</td>";
                    echo "<td>" . $cliente->usuario->data_nascimento . "</td>";
                    echo "<td>" . $cliente->usuario->telefone . "</td>";
                    echo "<td>" . $cliente->usuario->email . "</td>";
                    echo "<td>" . $cliente->usuario->endereco . "</td>";
                    echo "<td><a href='alteracao_dados_cliente.php?id=" . $cliente->id . "'><button>Editar</button></a></td>";
                    echo "</tr>";
                ?>
            </table> <br>
            <form action="inicial_cliente.php">
                <input type="submit" value="Voltar" />
            </form>
        </center>
    </div>
</body>
</html>
