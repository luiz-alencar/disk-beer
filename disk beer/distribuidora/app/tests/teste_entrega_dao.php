<?php

require_once '../dao/entrega_dao.php';
require_once '../model/mercadoria.php';
require_once '../model/situacao_entrega.php';

rodar_testes();

// Descomente os testes que deseja rodar
function rodar_testes(){
    $entregaDao = new EntregaDao();
    testa_inserir($entregaDao);
    //testa_listar($entregaDao);
    //testa_listar_situacao($entregaDao);
    //testa_buscar_id($entregaDao);
    testa_atualizar($entregaDao);
    //testa_excluir($entregaDao);

}

function testa_inserir($entregaDao) {
    echo "<h2>Teste inserir:</h2>";

    $usuario = new Usuario(1, "Leo", "123.123.123-12", date("Y-m-d"), 
        "062912312312", "email@email.com", "Rua 23", "leo", "123");
    $cliente = new Cliente(1, $usuario);
    $mercadorias = array(
        new Mercadoria(1, "Carro", 100.0, 3)
    );
    $entrega = new Entrega(0, "Sem observação", SituacaoEntrega::PENDENTE, $cliente, $mercadorias);

    $entregaDao->inserir($entrega);

    echo '<h2 style="color:green">O Teste Passou!</h2>';
}

function testa_listar($entregaDao){
    echo "<h2>Teste listar:</h2>";
    $entregas = $entregaDao->listar();

    echo " - Número de entregas: " . count($entregas) . "<br><br>";

    if($entregas){
        echo " - Primeira entrega: <br>";
        echo "<pre>";
        print_r($entregas[0]);
        echo "</pre>";
    }

    echo '<h2 style="color:green">O Teste Passou!</h2>';
}

function testa_listar_situacao($entregaDao){
    echo "<h2>Teste listar_situacao:</h2>";
    $entregas = $entregaDao->listar_situacao(SituacaoEntrega::ENTREGUE);

    echo " - Número de entregas: " . count($entregas) . "<br><br>";

    if($entregas){
        echo " - Primeira entrega: <br>";
        echo "<pre>";
        print_r($entregas[0]);
        echo "</pre>";
    }

    echo '<h2 style="color:green">O Teste Passou!</h2>';
}

function testa_buscar_id($entregaDao){
    echo "<h2>Teste buscar_id:</h2>";
    $usuario = new Usuario(1, "Leo", "123.123.123-12", date("Y-m-d"), 
        "062912312312", "email@email.com", "Rua 23", "leo", "123");
    $cliente = new Cliente(1, $usuario);
    $mercadorias = array(
        new Mercadoria(1, "Celular", 100.0, 10),
        new Mercadoria(2, "Carro", 199.99, 10),
        new Mercadoria(3, "Moto", 150.0, 10)
    );

    $entrega = new Entrega(1, "Status", "Entregue", $cliente, $mercadorias);

    $entregas = $entregaDao->buscar_id($entrega->id);

    echo "<pre>";
    print_r($entregas);
    echo "</pre>";

    echo '<h2 style="color:green">O Teste Passou!</h2>'; 
}

function testa_atualizar($entregaDao){
    echo "<h2>Teste atualizar:</h2>";
    $usuario = new Usuario(1, "Leo", "123.123.123-12", date("Y-m-d"), 
        "062912312312", "email@email.com", "Rua 23", "leo", "123");
    $cliente = new Cliente(1, $usuario);
    $mercadorias = array(
        new Mercadoria(1, "Celular", 100.0, 10),
    );

    $entrega = new Entrega(1, "Status", SituacaoEntrega::ENTREGUE, $cliente, $mercadorias);

    $entregaDao->atualizar($entrega);

    $entrega = $entregaDao->buscar_id($entrega->id);
    echo "<pre>";
    print_r($entrega);
    echo "</pre>";

    echo '<h2 style="color:green">O Teste Passou!</h2>'; 
}

function testa_excluir($entregaDao){
    echo "<h2>Teste excluir:</h2>";
    $usuario = new Usuario(1, "Leo", "123.123.123-12", date("Y-m-d"), 
        "062912312312", "email@email.com", "Rua 23", "leo", "123");
    $cliente = new Cliente(1, $usuario);
    $mercadorias = array(
        new Mercadoria(1, "Celular", 100.0, 10),
        new Mercadoria(2, "Carro", 199.99, 10),
        new Mercadoria(3, "Moto", 150.0, 10)
    );

    $entrega = new Entrega(1, "Status", "Entregue", $cliente, $mercadorias);

    $entregaDao->excluir($entrega->id);

    $entregas = $entregaDao->listar();
    echo "<pre>";
    print_r($entregas);
    echo "</pre>";

    echo '<h2 style="color:green">O Teste Passou!</h2>'; 
}