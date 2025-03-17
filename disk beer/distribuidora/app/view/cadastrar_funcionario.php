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
    <title>Funcionario</title>
</head>
<body>
    
    <?
        require_once '../model/funcionario.php';
        require_once '../model/usuario.php';

        if (isset($_SESSION['cadastro_funcionario'])) {
            $funcionario = unserialize($_SESSION['cadastro_funcionario']);
        } else {
            $funcionario = new Funcionario(0, '', new Usuario(0, '', '', '', '', '', '', '', ''));
        }
    ?>

    <div class="field">
      
        <form  class="formulario" method="post" action="../controller/inserir_funcionario.php">

            <h2> Cadastro de funcionários de forma rápida e fácil é com a gente! :)</h2>
            <label for="cargo">Cargo:</label>
            <br>
            <input type="text" id="cargo" value="<?= $funcionario->cargo ?>"  name="cargo" placeholder="Digite aqui o cargo de seu funcionário" required>
            <br><br>

            <label for="nome">Nome Completo:</label>
            <br>
            <input type="text" id="nome"  value="<?= $funcionario->usuario->nome ?>" name="nome" placeholder="Digite aqui o seu nome completo" required>
            <br><br>

            <label for="cpf">CPF:</label>
            <br>
            <input type="text" id="cpf" value="<?= $funcionario->usuario->cpf ?>" name="cpf" maxlength="14" placeholder="Digite aqui o seu CPF" required>
            <br><br>

            <label for="data_nascimento">Data de Nascimento:</label>
            <br>
            <input type="date" id="data_nascimento"  value="<?= $funcionario->usuario->data_nascimento ?>" name="data_nascimento" placeholder="Escolha sua data de nascimento" required>
            <br><br>

            <label for="telefone">Telefone:</label>
            <br>
            <input type="text" id="telefone"  value="<?= $funcionario->usuario->telefone ?>" name="telefone" maxlength="16" placeholder="Digite aqui o seu telefone" required>
            <br><br>

            <label for="email">Email:</label>
            <br>
            <input type="text" id="email"  value="<?= $funcionario->usuario->email ?>" name="email" placeholder="Digite aqui o seu email" required>
            <br><br>

            <label for="endereco">Endereço:</label>
            <br>
            <input type="text" id="endereco"  value="<?= $funcionario->usuario->endereco ?>" name="endereco" placeholder="Digite aqui o seu endereço" required>
            <br><br>

            <label for="login">Login:</label>
            <br>
            <input type="text" id="login"  value="<?= $funcionario->usuario->login ?>" name="login" placeholder="Digite aqui o login escolhido" required>
            <br><br>

            <label for="senha">Senha:</label>
            <br>
            <input type="password" id="senha" name="senha" placeholder="Digite aqui a senha escolhida" required>
            <br><br>
            <?php if(isset($_SESSION['msg_erro'])){
                echo $_SESSION['msg_erro'];
                unset($_SESSION['msg_erro']);
            }?><br>
            
            <input type="submit" value="Enviar"> <br><br>

            <? if(isset($_SESSION['msg'])){ ?>
                <p style="color: red"><?=$_SESSION['msg']?></p>
                <? unset($_SESSION['msg']) ?>
            <? } ?> <br>

            <button><a href="../public/pag_cadastro.php" class="botao">Voltar</a></button>
        </form>
    </div>

</body>
</html>