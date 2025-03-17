<?php

if(!isset($_SESSION)){
  session_start();
}

require_once '../model/cliente.php';
require_once '../model/usuario.php';
require_once '../dao/cliente_dao.php';
require_once '../dao/usuario_dao.php';
if(empty($_POST['senha']) && isset($_SESSION['funcionario'])){
  $_SESSION['msg_erro'] = "<p style='color: red'>Todos os campos tem que estar preenchidos antes de enviar</p>";

  $usuario = new Usuario(0, $_POST['nome'], $_POST['cpf'], $_POST['data_nascimento'], $_POST['telefone'], $_POST['email'], $_POST['endereco'], $_POST['login'], $_POST['senha']);
  $cliente = new Cliente(0, $usuario);

  $_SESSION['cadastro_cliente'] = serialize($cliente);
  
  header('Location: ../view/cadastrar_cliente.php');
}else{
  if(empty($_POST['nome']) || empty($_POST['cpf']) || empty($_POST['data_nascimento']) || empty($_POST['telefone']) || empty($_POST['email']) || empty($_POST['endereco']) || empty($_POST['login'])){
    $_SESSION['msg_erro'] = "<p style='color: red'>Todos os campos tem que estar preenchidos antes de enviar</p>";

    $usuario = new Usuario(0, $_POST['nome'], $_POST['cpf'], $_POST['data_nascimento'], $_POST['telefone'], $_POST['email'], $_POST['endereco'], $_POST['login'], password_hash($_POST['senha'], PASSWORD_DEFAULT));
    $cliente = new Cliente(0, $usuario);

    $_SESSION['cadastro_cliente'] = serialize($cliente);

    header('Location: ../view/cadastrar_cliente.php');
  }else{
    $id_usuario = isset($_POST['id_usuario']) ? $_POST['id_usuario'] : null;
    $id_cliente = isset($_POST['id_cliente']) ? $_POST['id_cliente'] : null;
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $data_nascimento = $_POST['data_nascimento'];
    $telefone =  $_POST['telefone'];
    $email = $_POST['email'];
    $endereco = $_POST['endereco'];
    $login = $_POST['login'];
    $senha = isset($_POST['senha']) ? $_POST['senha'] : '';

    $usuario = new Usuario($id_usuario, $nome, $cpf, $data_nascimento, $telefone, $email, $endereco, $login, password_hash($senha, PASSWORD_DEFAULT));
    $cliente = new Cliente($id_cliente, $usuario);

    $_SESSION['cadastro_cliente'] = serialize($cliente);

    $usuario_dao = new UsuarioDao();
    $cliente_dao = new ClienteDao();

    if($cliente->id == null){
      
      if($usuario_dao->buscar_cpf($cpf)){
        $_SESSION['msg'] = 'CPF já cadastrado!';
        header('Location: ../view/cadastrar_cliente.php');
      }

      if($usuario_dao->buscar_login($login)){
        $_SESSION['msg'] = 'Login já cadastrado!';
        header('Location: ../view/cadastrar_cliente.php');
      }

      $cliente_dao->inserir($cliente);
    } else {

      $usuario_cpf = $usuario_dao->buscar_cpf($cpf);
      if (isset($usuario_cpf) and $usuario_cpf->id != $id_usuario){
        $_SESSION['msg'] = 'CPF já cadastrado!';
        header('Location: ../public/alteracao_dados_cliente.php?id=' . $id_cliente);
      }

      $usuario_login = $usuario_dao->buscar_login($login);
      if (isset($usuario_login) and $usuario_login->id != $id_usuario){
        $_SESSION['msg'] = 'Login já cadastrado!';
        header('Location: ../public/alteracao_dados_cliente.php?id=' . $id_cliente);
      }
      
      $cliente_dao->atualizar($cliente);

    }

    unset($_SESSION['cadastro_cliente']);

    if (isset($_SESSION['funcionario'])){
      header('Location: ../public/pag_cadastro.php');
    } else if (isset($_SESSION['cliente'])){
      header('Location: ../public/dados_cliente.php');
    } else {
      header('Location: ../public/index.php');
    }
  }
}