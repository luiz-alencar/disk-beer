<?php

require_once '../dao/usuario_dao.php';

rodar_testes();

// Descomente os testes que deseja rodar
function rodar_testes(){
    $usuarioDao = new usuarioDao();
    //testa_inserir($usuarioDao);
    //testa_listar($usuarioDao);
    //testa_buscar_id($usuarioDao);
    //testa_atualizar($usuarioDao);
    testa_buscar_cpf($usuarioDao);
    testa_buscar_login($usuarioDao);
}

function testa_inserir($usuarioDao) {
    echo "<h2>Teste inserir:</h2>";
    $usuario = new Usuario(0, "Leo", "123.123.123-12", "2002-02-25", 
        "062912312312", "email@email.com", "Rua 23", "leo", password_hash('123', PASSWORD_DEFAULT));
    $usuarioDao->inserir($usuario);
    echo '<h2 style="color:green">O Teste Passou!</h2>';
}

function testa_listar($usuarioDao){
    echo "<h2>Teste listar:</h2>";
    $usuarios = $usuarioDao->listar();

    echo " - Número de usuarios: " . count($usuarios) . "<br><br>";

    if($usuarios){
        echo " - Primeiro cliente: <br>";
        echo "<pre>";
        print_r($usuarios[0]);
        echo "</pre>";
    }

    echo '<h2 style="color:green">O Teste Passou!</h2>';
}

function testa_buscar_id($usuarioDao){
    echo "<h2>Teste buscar:</h2>";
    $usuario = new Usuario(1, "Leo", "123.123.123-12", date("Y-m-d"), 
        "062912312312", "email@email.com", "Rua 23", "leo", password_hash('123', PASSWORD_DEFAULT));

    $usuarios = $usuarioDao->buscar_id($usuario->id);

    echo "<pre>";
    print_r($usuarios);
    echo "</pre>";

    echo '<h2 style="color:green">O Teste Passou!</h2>'; 
}

function testa_atualizar($usuarioDao) {
    echo "<h2>Teste atualizar:</h2>";
    $usuario = new Usuario(1, "Leo", "123.123.123-12", "2002-02-25", 
        "062912312312", "email@email.com", "Rua 23", "leo", password_hash('123', PASSWORD_DEFAULT));
    $usuarioDao->atualizar($usuario);

    $usuarios = $usuarioDao->listar();
    echo "<pre>";
    print_r($usuarios);
    echo "</pre>";

    echo '<h2 style="color:green">O Teste Passou!</h2>';
}

function testa_buscar_cpf($usuarioDao)
{
    echo "<h2>Teste buscar_cpf:</h2>";
    $cpf = "999.999.999-99";
    $usuario = $usuarioDao->buscar_cpf($cpf);
    echo "<pre>";
    print_r($usuario);
    echo "</pre>";

    echo '<h2 style="color:green">O Teste Passou!</h2>';
}

function testa_buscar_login($usuarioDao)
{
    echo "<h2>Teste buscar_login:</h2>";
    $login = "admin";
    $usuario = $usuarioDao->buscar_login($login);
    echo "<pre>";
    print_r($usuario);
    echo "</pre>";

    echo '<h2 style="color:green">O Teste Passou!</h2>';
}