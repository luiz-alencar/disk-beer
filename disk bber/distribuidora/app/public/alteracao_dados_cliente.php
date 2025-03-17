<?php
    require_once '../model/cliente.php';

    if(!isset($_SESSION)){
        session_start();
    }

    if(empty($_SESSION['cliente']) or empty($_SESSION['logado'])){
        header('Location: ../public/index.php');
    }
    if (isset($_GET['id']) and $_SESSION['cliente']->id == $_GET['id']){
        require_once '../dao/cliente_dao.php';
        require_once '../dao/usuario_dao.php';
        $cliente_dao = new ClienteDao();
        $cliente = $cliente_dao->buscar_id($_GET['id']);
    } else {
        header('Location: ../public/dados_cliente.php');
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../view/estilo.css">
    <title>Alteração de dados</title>
</head>
<body>
        <div class="formulario">  
      
            <form method="post" action="../controller/inserir_cliente.php">

                <h2>Alterar meus dados pessoais</h2>
                <input type="hidden" name="id_cliente" value="<?= $cliente->id ?>">
                <input type="hidden" name="id_usuario" value="<?= $cliente->usuario->id ?>">
                <label for="nome">Nome Completo:</label>
                <br>
                <input type="text" id="nome"  name="nome" placeholder="Digite aqui o seu nome completo" value="<?php echo $cliente->usuario->nome?>" required>
                <br><br>

                <label for="cpf">CPF:</label>
                <br>
                <input type="text" id="cpf"  name="cpf" maxlength="14" placeholder="Digite aqui o seu CPF" value="<?= $cliente->usuario->cpf?>" >
                <br><br>

                <label for="data_nascimento">Data de Nascimento:</label>
                <br>
                <input type="date" id="data_nascimento"  name="data_nascimento" placeholder="Escolha sua data de nascimento" value="<?= $cliente->usuario->data_nascimento?>" required>
                <br><br>

                <label for="telefone">Telefone:</label>
                <br>
                <input type="text" id="telefone"  name="telefone" maxlength="16" placeholder="Digite aqui o seu telefone" value="<?= $cliente->usuario->telefone?>" required>
                <br><br>

                <label for="email">Email:</label>
                <br>
                <input type="text" id="email"  name="email" placeholder="Digite aqui o seu email" value="<?= $cliente->usuario->email?>" required>
                <br><br>

                <label for="endereco">Endereço:</label>
                <br>
                <input type="text" id="endereco"  name="endereco" placeholder="Digite aqui o seu endereço" value="<?= $cliente->usuario->endereco?>" required>
                <br><br>

                <label for="endereco">Login:</label>
                <br>
                <input type="text" id="login"  name="login" placeholder="Digite aqui o seu endereço" value="<?= $cliente->usuario->login?>" required>
                <br><br>

                <input type="submit" value="Enviar"> <br> <br>

                <? if(isset($_SESSION['msg'])){ ?>
                    <p style="color: red"><?=$_SESSION['msg']?></p>
                    <? unset($_SESSION['msg']) ?>
                <? } ?> <br>
           
                <button><a href="javascript:history.go(-1)" class="botao">Voltar</a></button>
            </form>
        </div>
</body>
</html>