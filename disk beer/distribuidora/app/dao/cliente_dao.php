<?php

require_once '../config/conexao.php';
require_once '../model/cliente.php';
require_once '../model/usuario.php';
require_once 'usuario_dao.php';
require_once 'idao.php';

class ClienteDao implements IDao {

    private $conexao;

    public function __construct()
    {
        $conexao = new Conexao();
        $this->conexao = $conexao->conectar();   
    }

    public function inserir(object $cliente)
    {
        $usuario_dao = new UsuarioDao();
        $usuario_id = $usuario_dao->inserir($cliente->usuario);

        $sql = "INSERT INTO cliente (usuario_id) VALUES (:usuario_id)";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':usuario_id', $usuario_id);
        
        $stmt->execute();
    }

    public function listar(){
        $sql = "SELECT * FROM cliente";

        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_OBJ);
        
        $clientes = array();

        foreach($resultados as $resultado){
            $usuario_dao = new UsuarioDao();
            $usuario = $usuario_dao->buscar_id($resultado->usuario_id);
            $cliente = new Cliente($resultado->id, $usuario);
            $clientes[] = $cliente;
        }
        return $clientes;
    }

    public function buscar_id(int $id){

        $sql = 'SELECT * FROM cliente WHERE id = :id';
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_OBJ);
        
        // buscar usuario
        $usuarioDao = new UsuarioDao();
        $usuario = $usuarioDao->buscar_id($resultado->usuario_id);

        $cliente = new Cliente($resultado->id, $usuario);

        return $cliente;
    }

    public function atualizar(Cliente $cliente){
        $usuario_dao = new UsuarioDao();
        $usuario_dao->atualizar($cliente->usuario);
    }

}