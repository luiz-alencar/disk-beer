<?php 
if(!isset($_SESSION)){
    session_start();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../view/estilo.css">
    <title>Login</title>
</head>
<body>
    <th co></th>
    <?
        require_once '../model/usuario.php';

        if (isset($_SESSION['verifica_login'])) {
            $usuario = unserialize($_SESSION['verifica_login']);
        } else {
            $usuario = new Usuario(0, '', '', '', '', '', '', '', '');
        }
    ?>
    <div class="field">
        
        <form class="formulario" method="post" action="../controller/verificar_login.php">
            <h2> <center> Bem vindo a Disk Beer! </center></h2>
            <label for="email">Login:</label>
            <br>
            <input type="search" id="login" name="login" value="<?= $usuario->login ?>" placeholder="Digite aqui o seu login" required>
            <br><br>
            <label for="senha">Senha:</label>
            <br>
            <input type="password" id="senha" name="senha" value="<?= $usuario->senha ?>" placeholder="Digite aqui a sua senha" required>
            <br><br>
            <?php if(isset($_SESSION['msg'])){
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }?><br>
            <input type="submit" class="botao" value="Entrar">
        
        </form>
    </div>
</body>
</html>