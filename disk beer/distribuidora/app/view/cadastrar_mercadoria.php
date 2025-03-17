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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="estilo.css">
    <title>Cliente</title>
</head>
<body>
    
    <?
        require_once '../model/mercadoria.php';

        if (isset($_SESSION['cadastro_mercadoria'])) {
            $mercadoria = unserialize($_SESSION['cadastro_mercadoria']);
        } else {
            $mercadoria = new Mercadoria(0, '', '', '');
        }
    ?>
    <div class="field">
      
      
        <form method="post"  class="formulario" action="../controller/inserir_mercadoria.php">

            <h2> Cadastro de mercadorias :)</h2>

            <label for="nome">Descrição:</label>
            <br>
            <input type="text" id="nome"  name="nome" placeholder="Digite aqui a descrição do produto" value="<?= $mercadoria->nome ?>" required>
            <br><br>

            <label for="preco">Preço:</label>
            <br>
            <input input type="number" min="0.01" step="0.01" id="preco"  name="preco" value="<?= $mercadoria->preco ?>" required>
            <br><br>

            <?php if(isset($_SESSION['msg_erro'])){
                echo $_SESSION['msg_erro'];
                unset($_SESSION['msg_erro']);
            }?><br>

            <input type="submit" value="Enviar"> <br><br>

            <button><a href="../public/pag_cadastro.php" class="botao">Voltar</a></button>
            
        </form>
    </div>
      

</body>
</html>