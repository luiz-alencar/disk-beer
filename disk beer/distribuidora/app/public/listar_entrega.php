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
    <div class="formulario">
        <center>
        <h2>Lista de Entregas</h2> 
        
        <form action="../controller/filtro.php">
            <select name="situacao">
                <option selected value="TODAS">TODAS</option>
                <?php
                    require_once '../model/situacao_entrega.php';
                    foreach (SituacaoEntrega::cases() as $situacao) {
                        if (isset($_GET['situacao']) and $_GET['situacao'] == $situacao->value){
                            echo $_GET['situacao'];
                            echo "<option selected value='" . $situacao->value . "'>" . $situacao->value . "</option>";
                        }else{
                            echo "<option value='" . $situacao->value . "'>" . $situacao->value . "</option>";
                        }
                    }
                ?>
            </select>
            <input type="submit" value="Filtrar" />
        </form>
        
        <?php
            require_once '../dao/entrega_dao.php';
            $entregaDao = new EntregaDao();
            if(!isset($_GET['situacao']) or $_GET['situacao'] == "TODAS"){
                $entregas = $entregaDao->listar();
            }else if ($_GET['situacao'] == "PENDENTE"){
                $entregas = $entregaDao->listar_situacao(SituacaoEntrega::PENDENTE);
            }else if ($_GET['situacao'] == "ENTREGUE"){
                $entregas = $entregaDao->listar_situacao(SituacaoEntrega::ENTREGUE);
            }

            foreach($entregas as $resultado) { 
                echo"<table border='1'>
                <th>Nome do cliente</th> 
                <th>Endereço</th>
                <th>Telefone</th>
                <th>Situação</th>
                <th>Editar Dados</th>
                <th>Ecluir Dados</th>";

                echo "<tr>";

                echo "<td>".$resultado->cliente->usuario->nome."</td>"; 
                echo "<td>".$resultado->cliente->usuario->endereco."</td>"; 
                echo "<td>".$resultado->cliente->usuario->telefone."</td>"; 
                echo "<td>".$resultado->situacao."</td>"; 

                echo "<td><a href='editar_entrega.php?id=$resultado->id'><button>Editar</button></a></td>";
                echo "<td><a href='../controller/deletar.php?id=$resultado->id'><button>Deletar</button></a></td>";
                echo "<br>";
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
            echo "<br><br>";
        ?>
        <form action="pag_listagem.php">
            <input type="submit" value="Voltar" />
        </form>
        </center>
    </div>
       
</body>
</html>
