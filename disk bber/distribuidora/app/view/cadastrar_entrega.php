<?php
if(!isset($_SESSION)){
    session_start();
}
if(empty($_SESSION['funcionario']) or empty($_SESSION['logado'])){
    header('Location: ../public/index.php');
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>ENTREGA</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
   <div class="field">
    <form class="formulario" method="post" action="../controller/inserir_entrega.php"> 
        <h2> Preencha abaixo os dados <br> de sua entrega! :)</h2>
      

            <label for="selecao">Cliente:</label><br>
            <select name="cliente" id="cliente" required>
            <option selected disabled value="">Selecione</option>    
                <?php
                require_once '../dao/cliente_dao.php';
                $clienteDao = new ClienteDao();
    
                $clientes = $clienteDao->listar();
    
                foreach ($clientes as $cliente) {
                    echo "<option value='" . $cliente->id . "'>" . $cliente->usuario->nome . "</option>";
                }
                ?>
            </select> <br><br>
       
       
     		<label for="mensagem">Observações sobre a entrega:</label><br>
            <textarea name="mensagem" id="mensagem" placeholder="Mensagem"></textarea><br><br>

			<div id = "produtos">
			    <label>Mercadorias:</label>
				<div id="itens">
                    <div id="item">
                        <br>
                        <select id="mercadorias" name="mercadorias[]" onchange="validarProdutos()" required>
                        <option selected disabled value="">Selecione</option>
                            <?php
                                require_once '../dao/mercadoria_dao.php';
                                $mercadoriaDao = new MercadoriaDao();
                    
                                $mercadorias = $mercadoriaDao->listar();
                                
                                foreach ($mercadorias as $mercadoria) {
                                    echo "<option value='" . $mercadoria->id . "'>" . $mercadoria->nome . "</option>";
                                }
                            ?>
                        </select>
                        <input id="quantidade" name="quantidades[]" type="number" value="1" min="1" max="100"/>
                        <button type="button" id="remover" onclick="removerProduto(this);">-</button><br>
                    </div>
                </div>
				<br><button type="button" id="adicionar" onclick="adicionarProduto();">+</button> 
			</div>

	
	<br><br>

    <?php if(isset($_SESSION['msg_erro'])){
        echo $_SESSION['msg_erro'];
        unset($_SESSION['msg_erro']);
    }?><br>
	<input type="submit" name="acao" value="Enviar"> <br> <br>

    <button><a href="../public/pag_cadastro.php" class="botao">Voltar</a></button>
    </form>
   </div>
                                
    <script src="js/produtos_entrega.js"></script>
</body>
</html>