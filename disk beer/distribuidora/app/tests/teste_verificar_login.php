<?php
if(!isset($_SESSION)){
    session_start();
}
require_once '../dao/usuario_dao.php';

$usuarioDao = new usuarioDao();
$usuario = new Usuario(0, null, null, null, 
    null, null, null, "leo", 12345);
$result = $usuarioDao->validar($usuario);


if(($result instanceof Funcionario) && password_verify($usuario->senha, $result->usuario->senha)){
    echo "É funcionario";
    $_SESSION['funcionario'] = $result;
}else if(($result instanceof Cliente) && password_verify($usuario->senha, $result->usuario->senha)){
    echo "É cliente";
    $_SESSION['cliente'] = $result;
}else{
    echo "Não é funcionario";
    echo "</br>E não é cliente";
    $result = null;
}

echo "<pre>";
print_r($result);
echo "</pre>";