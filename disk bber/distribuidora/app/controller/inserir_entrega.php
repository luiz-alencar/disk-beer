<?php
if(!isset($_SESSION)){
    session_start();
}
require_once '../model/situacao_entrega.php';
require_once '../model/mercadoria.php';
require_once '../model/cliente.php';
require_once '../model/entrega.php';
require_once '../dao/entrega_dao.php';


if(empty($_POST['cliente']) || empty($_POST['mercadorias']) || empty($_POST['quantidades'])){
    $_SESSION['msg_erro'] = "<p style='color: red'>Todos os campos tem que estar preenchidos antes de enviar</p>";
    header('Location: ../view/cadastrar_entrega.php');
}else{
    $observacao = $_POST['mensagem'];
    $situacao = SituacaoEntrega::PENDENTE;
    $cliente_id = $_POST['cliente'];
    $ids_mercadorias = $_POST['mercadorias'];
    $quantidades = $_POST['quantidades'];


    $mercadorias = array();
    for ($i=0; $i < count($ids_mercadorias); $i++) { 
        $mercadoria = new Mercadoria($ids_mercadorias[$i], null, null, $quantidades[$i]);
        $mercadorias[] = $mercadoria;
    }

    $cliente = new Cliente($cliente_id, null);
    $entrega = new Entrega(0, $observacao, $situacao, $cliente, $mercadorias);

    $entregaDao = new EntregaDao();
    $entregaDao->inserir($entrega);

    header('Location: ../public/listar_entrega.php');
}