<?php

require_once '../dao/funcionario_dao.php';

rodar_testes();

// Descomente os testes que deseja rodar
function rodar_testes(){
    $funcionarioDao = new FuncionarioDao();
    //testa_inserir($funcionarioDao);
    testa_listar($funcionarioDao);
    //testa_buscar_id($funcionarioDao);
}

function testa_inserir($funcionarioDao) {
    echo "<h2>Teste inserir:</h2>";
    $usuario = new Usuario(1, "Leo", "123.123.123-12", date("Y-m-d"), 
        "062912312312", "email@email.com", "Rua 23", "teste", password_hash("123", PASSWORD_DEFAULT));
    $funcionario = new Funcionario(1, "Diretor",$usuario);
    $funcionarioDao->inserir($funcionario);
    echo '<h2 style="color:green">O Teste Passou!</h2>';
}

function testa_listar($funcionarioDao){
    echo "<h2>Teste listar:</h2>";
    $funcionarios = $funcionarioDao->listar();

    echo " - Número de funcionarios: " . count($funcionarios) . "<br><br>";

    if($funcionarios){
        echo " - Primeiro funcionario: <br>";
        echo "<pre>";
        print_r($funcionarios[0]);
        echo "</pre>";
    }

    echo '<h2 style="color:green">O Teste Passou!</h2>';
}

function testa_buscar_id($funcionarioDao){
    echo "<h2>Teste buscar_id:</h2>";
    $usuario = new Usuario(1, "Leo", "123.123.123-12", date("Y-m-d"), 
        "062912312312", "email@email.com", "Rua 23", "leo", "123");
    $funcionario = new Funcionario(1, "Diretor", $usuario);

    $funcionarios = $funcionarioDao->buscar_id($funcionario->id);

    echo "<pre>";
    print_r($funcionarios);
    echo "</pre>";

    echo '<h2 style="color:green">O Teste Passou!</h2>'; 
}