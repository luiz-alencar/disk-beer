<?php

require_once '../config/conexao.php';
require_once '../model/funcionario.php';
require_once 'usuario_dao.php';
require_once 'idao.php';

class FuncionarioDao implements IDao {

    private $conexao;

    public function __construct()
    {
        $conexao = new Conexao();
        $this->conexao = $conexao->conectar();   
    }

    public function inserir(object $funcionario)
    {
        $usuario_dao = new UsuarioDao();
        $usuario_id = $usuario_dao->inserir($funcionario->usuario);
        
        $sql = "INSERT INTO funcionario (cargo, usuario_id) VALUES (:cargo, :usuario_id)";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':cargo', $funcionario->cargo);
        $stmt->bindValue(':usuario_id', $usuario_id);
        
        $stmt->execute();
    }

    public function listar(){
        $sql = "SELECT * FROM funcionario";

        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_OBJ);
        
        $funcionarios = array();

        foreach($resultados as $resultado){
            $usuario_dao = new UsuarioDao();
            $usuario = $usuario_dao->buscar_id($resultado->usuario_id);
            $funcionario = new Funcionario($resultado->id, $resultado->cargo, $usuario);
            $funcionarios[] = $funcionario;
        }
        return $funcionarios;
    }

    public function buscar_id(int $id){

        $sql = 'SELECT * FROM funcionario WHERE id = :id';
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_OBJ);
        
        // buscar usuario
        $usuarioDao = new UsuarioDao();
        $usuario = $usuarioDao->buscar_id($resultado->usuario_id);

        $funcionario = new Funcionario($resultado->id, $resultado->cargo,$usuario);

        return $funcionario;
    }
}