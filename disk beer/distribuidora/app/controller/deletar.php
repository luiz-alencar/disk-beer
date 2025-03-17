<?php

    if(!empty($_GET['id'])){
        require_once '../config/conexao.php';
        require_once '../dao/entrega_dao.php';

        $id = $_GET['id'];
        $entregaDao = new EntregaDao();

        $entrega = $entregaDao->buscar_id($id);

        if(!empty($entrega)){
            $entregaDao->excluir($id);
        }
    }
    header('Location: ../public/listar_entrega.php');
?>