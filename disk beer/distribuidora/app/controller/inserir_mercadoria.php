<?php
if(!isset($_SESSION)){
    session_start();
}
require_once '../model/mercadoria.php';
require_once '../dao/mercadoria_dao.php';

$nome = $_POST['nome'];
$preco = $_POST['preco'];


if(empty($nome) || empty($preco)){
    $mercadoria = new Mercadoria(0, $_POST['nome'], $_POST['preco'], null);

    $_SESSION['cadastro_mercadoria'] = serialize($mercadoria);
    $_SESSION['msg_erro'] = "<p style='color: red'>Todos os campos tem que estar preenchidos antes de enviar</p>";
    header('Location: ../view/cadastrar_mercadoria.php');
}else{
    $mercadoria = new Mercadoria(0, $nome, $preco, null);

    $mercadoriaDao = new MercadoriaDao();
    $mercadoriaDao->inserir($mercadoria);

    header('Location: ../public/pag_cadastro.php');
}