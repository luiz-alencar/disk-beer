<?php

require_once '../dao/mercadoria_dao.php';

rodar_testes();

// Descomente os testes que deseja rodar
function rodar_testes(){
    $mercadoriaDao = new MercadoriaDao();
    //testa_inserir($mercadoriaDao);
    testa_listar($mercadoriaDao);
    //testa_buscar_id($mercadoriaDao);
    //testa_atualizar($mercadoriaDao);
}

function testa_inserir($mercadoriaDao) {
    echo "<h2>Teste inserir:</h2>";
    $mercadoria = new Mercadoria(0, "Bateria", 15.36, 25);
    $mercadoriaDao->inserir($mercadoria);
    echo '<h2 style="color:green">O Teste Passou!</h2>';
}

function testa_listar($mercadoriaDao){
    echo "<h2>Teste listar:</h2>";
    $mercadorias = $mercadoriaDao->listar();

    echo " - Número de usuarios: " . count($mercadorias) . "<br><br>";

    if($mercadorias){
        echo " - Primeiro cliente: <br>";
        echo "<pre>";
        print_r($mercadorias[0]);
        echo "</pre>";
    }

    echo '<h2 style="color:green">O Teste Passou!</h2>';
}

function testa_buscar_id($mercadoriaDao){
    echo "<h2>Teste buscar_id:</h2>";
    $mercadoria = new Mercadoria(1, "Bateria", 15.36, 25);

    $mercadorias = $mercadoriaDao->buscar_id($mercadoria->id);

    echo "<pre>";
    print_r($mercadorias);
    echo "</pre>";

    echo '<h2 style="color:green">O Teste Passou!</h2>'; 
}