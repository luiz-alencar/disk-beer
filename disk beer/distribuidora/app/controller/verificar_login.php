<?php
if(!isset($_SESSION)){
    session_start();
}
require_once '../dao/usuario_dao.php';

$login = $_POST['login'];
$senha = $_POST['senha'];

$usuarioDao = new usuarioDao();
$usuario = new Usuario(0, null, null, null, 
    null, null, null, $login, $senha);

$result = $usuarioDao->validar($usuario);

if(($result instanceof Funcionario) && password_verify($usuario->senha, $result->usuario->senha)){
    $_SESSION['cliente'] = null;
    $_SESSION['funcionario'] = $result;
    $_SESSION['logado'] = true;
    header('Location: ../public/inicial_funcionario.php');
}else if(($result instanceof Cliente) && password_verify($usuario->senha, $result->usuario->senha)){
    $_SESSION['funcionario'] = null;
    $_SESSION['cliente'] = $result;
    $_SESSION['logado'] = true;
    header('Location: ../public/inicial_cliente.php');
}else{
    $_SESSION['verifica_login'] = serialize($usuario);
    $_SESSION['msg'] = "<p style='color: red'>Login ou Senha incorretos</p>";
    header('Location: ../public/index.php');
}
?>