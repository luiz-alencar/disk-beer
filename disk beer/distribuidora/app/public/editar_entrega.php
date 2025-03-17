<?php
if(!isset($_SESSION)){
    session_start();
}
if(empty($_SESSION['funcionario']) or empty($_SESSION['logado'])){
    header('Location: ../public/index.html');
}

if (isset($_GET['id'])) {
    require_once '../dao/entrega_dao.php';
    require_once '../model/entrega.php';

    $entregaDao = new EntregaDao();
    $entrega = $entregaDao->buscar_id($_GET['id']);
} else {
    header('Location: ../public/listar_entrega.php');
}      
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../view/estilo.css">
    <title>Página de Edição de Entrega</title>
</head>
<body onload="nomearItens()">
   <div class="field">
    <form class="formulario" method="post" action="../controller/alterar_entrega.php"> 
        <h2> Modifique abaixo os dados <br> de sua entrega! :)</h2>
      
        <input type="hidden" name="id" value="<?= $entrega->id ?>">
        <label for="selecao">Cliente:</label><br>
        <select name="cliente" id="cliente">
            <option disabled value="">Selecione</option>  
            <?php
                require_once '../dao/cliente_dao.php';
                $clienteDao = new ClienteDao();
    
                $clientes = $clienteDao->listar();
    
                foreach ($clientes as $cliente) {
                    if($cliente->id == $entrega->cliente->id){
                        echo "<option selected value='" . $cliente->id . "'>" . $cliente->usuario->nome . "</option>";
                    }else{
                        echo "<option value='" . $cliente->id . "'>" . $cliente->usuario->nome . "</option>";
                    }
                }
            ?>
        </select> <br><br>

        <label for="selecao">Situacão:</label><br>
        <select name="situacao" id="situacao">
            <option disabled value="">Selecione</option>   
            <?php
                require_once '../model/situacao_entrega.php';
                
                foreach (SituacaoEntrega::cases() as $situacao) {
                    if ($situacao->value == $entrega->situacao){
                        echo "<option selected value='" . $situacao->value . "'>" . $situacao->value . "</option>";
                    } else{
                        echo "<option value='" . $situacao->value . "'>" . $situacao->value . "</option>";
                    }
                }
            ?>
        </select> <br><br>

        <label for="mensagem">Observações sobre a entrega:</label><br>
        <textarea name="mensagem" id="mensagem" placeholder="Mensagem" value="<?= $entrega->observacao?>"><?=$entrega->observacao?></textarea><br><br>
         
        <div id = "produtos">
            <label>Mercadorias:</label>
            <div id="itens">
                <? foreach ($entrega->mercadorias as $mercadoria_entrega) {?>
                    <div id="item">
                        <br>
                        <select id="mercadorias" name="mercadorias[]" onchange="validarProdutos()" required>
                            <option disabled value="">Selecione</option>
                            <?php
                                require_once '../dao/mercadoria_dao.php';
                                $mercadoriaDao = new MercadoriaDao();
                    
                                $mercadorias = $mercadoriaDao->listar();
                                
                                foreach ($mercadorias as $mercadoria) {
                                    if ($mercadoria->id == $mercadoria_entrega->id){
                                        echo "<option selected value='" . $mercadoria->id . "'>" . $mercadoria->nome . "</option>";
                                    }else{
                                        echo "<option value='" . $mercadoria->id . "'>" . $mercadoria->nome . "</option>";
                                    }
                                }
                            ?>
                        </select>
                        <input id="quantidade" name="quantidades[]" type="number" value="<?= $mercadoria_entrega->quantidade ?>" min="1" max="100"/>
                        <button type="button" id="remover" onclick="removerProduto(this);">-</button><br>
                    </div>
                <?}?>
            </div>
            <br><button type="button" id="adicionar" onclick="adicionarProduto();">+</button> 
		</div>

        <br><br>
        
        <?php if(isset($_SESSION['msg_erro'])){
        echo $_SESSION['msg_erro'];
        unset($_SESSION['msg_erro']);
        }?><br>
        <input type="submit" name="acao" value="Enviar"> <br> <br>

        <button><a href="listar_entrega.php" class="botao">Voltar</a></button>

    </form>
   </div>
                                
    <script src="../view/js/produtos_entrega.js"></script>
</body>
</html>
       
     		
</body>
</html>