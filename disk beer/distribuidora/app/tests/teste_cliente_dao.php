<?php

require_once '../dao/cliente_dao.php';

rodar_testes();

// Descomente os testes que deseja rodar
function rodar_testes(){
    $clienteDao = new ClienteDao();
    //testa_inserir($clienteDao);
    //testa_listar($clienteDao);
    testa_buscar_id($clienteDao);
    //testa_atualizar($clienteDao);
}

function testa_inserir($clienteDao) {
    echo "<h2>Teste inserir:</h2>";
    $usuario = new Usuario(1, "Leo", "123.123.123-12", date("Y-m-d"), 
        "062912312312", "email@email.com", "Rua 23", "leo", password_hash('123', PASSWORD_DEFAULT));
    $cliente = new Cliente(1, $usuario);
    $clienteDao->inserir($cliente);
    echo '<h2 style="color:green">O Teste Passou!</h2>';
}

function testa_listar($clienteDao){
    echo "<h2>Teste listar:</h2>";
    $clientes = $clienteDao->listar();

    echo " - Número de clientes: " . count($clientes) . "<br><br>";

    if($clientes){
        echo " - Primeiro cliente: <br>";
        echo "<pre>";
        print_r($clientes[0]);
        echo "</pre>";
    }

    echo '<h2 style="color:green">O Teste Passou!</h2>';

}

function testa_buscar_id($clienteDao){
    echo "<h2>Teste buscar_id:</h2>";
    
    $cliente = new Cliente(1, null);

    $cliente = $clienteDao->buscar_id($cliente->id);

    echo "<pre>";
    print_r($cliente);
    echo "</pre>";

    echo '<h2 style="color:green">O Teste Passou!</h2>'; 
}

function testa_atualizar($clienteDao) {
    echo "<h2>Teste atualizar:</h2>";
    $usuario = new Usuario(3, "Nome Atualizado", "123.123.123-01", date("Y-m-d"), 
        "062912312777", "email_atualizado@email.com", "Rua Atualizada", "leo", password_hash('4321', PASSWORD_DEFAULT));
    $cliente = new Cliente(2, $usuario);
    $clienteDao->atualizar($cliente);
    echo '<h2 style="color:green">O Teste Passou!</h2>';
}