<?php

if(!isset($_SESSION)){
    session_start();
}

require_once '../model/funcionario.php';
require_once '../model/usuario.php';
require_once '../dao/funcionario_dao.php';
require_once '../dao/usuario_dao.php';

if(empty($_POST['cargo']) || empty($_POST['nome']) || empty($_POST['cpf']) || empty($_POST['data_nascimento']) || empty($_POST['telefone']) || empty($_POST['email']) || empty($_POST['endereco']) || empty($_POST['login']) || empty($_POST['senha'])){
    $_SESSION['msg_erro'] = "<p style='color: red'>Todos os campos tem que estar preenchidos antes de enviar</p>";
    
    $usuario = new Usuario(0, $_POST['nome'], $_POST['cpf'], $_POST['data_nascimento'], $_POST['telefone'], $_POST['email'], $_POST['endereco'], $_POST['login'], password_hash($_POST['senha'], PASSWORD_DEFAULT));
    $funcionario = new Funcionario(0, $_POST['cargo'], $usuario);

    $_SESSION['cadastro_funcionario'] = serialize($funcionario);

    header('Location: ../view/cadastrar_funcionario.php');
}else{
    $cargo = $_POST['cargo'];
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $data_nascimento = $_POST['data_nascimento'];
    $telefone =  $_POST['telefone'];
    $email = $_POST['email'];
    $endereco = $_POST['endereco'];
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    $usuario = new Usuario(0, $nome, $cpf, $data_nascimento, $telefone, $email, $endereco, $login, password_hash($senha, PASSWORD_DEFAULT));
    $funcionario = new Funcionario(0, $cargo, $usuario);

    $_SESSION['cadastro_funcionario'] = serialize($funcionario);

    $usuario_dao = new UsuarioDao();
    $funcionarioDao = new FuncionarioDao();

    if ($usuario_dao->buscar_cpf($cpf)){
        $_SESSION['msg'] = 'CPF já cadastrado!';
        header('Location: ../view/cadastrar_funcionario.php');
    }

    if ($usuario_dao->buscar_login($login)){
        $_SESSION['msg'] = 'Login já cadastrado!';
        header('Location: ../view/cadastrar_funcionario.php');
    }

    $funcionarioDao->inserir($funcionario);

    unset($_SESSION['cadastro_funcionario']);
    header('Location: ../public/pag_cadastro.php');
}