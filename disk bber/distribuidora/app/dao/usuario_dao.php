<?php

require_once '../config/conexao.php';
require_once '../model/usuario.php';
require_once '../dao/cliente_dao.php';
require_once '../dao/funcionario_dao.php';
require_once 'idao.php';

class UsuarioDao implements IDao {

    private $conexao;

    public function __construct()
    {
        $conexao = new Conexao();
        $this-> conexao = $conexao->conectar();
    }

    public function inserir(object $usuario)
    {
        $sql = 'INSERT INTO usuario (nome, cpf, data_nascimento, telefone, email, endereco, login, senha) VALUE (:nome, :cpf, :data_nascimento, :telefone, :email, :endereco, :login, :senha)';
        $stmt = $this->conexao->prepare($sql);
        $stmt -> bindValue(':nome', $usuario->nome);        
        $stmt -> bindValue(':cpf',$usuario->cpf);
        $stmt -> bindValue(':data_nascimento',$usuario->data_nascimento);
        $stmt -> bindValue(':telefone',$usuario->telefone);
        $stmt -> bindValue(':email',$usuario->email);
        $stmt -> bindValue(':endereco',$usuario->endereco);
        $stmt -> bindValue(':login',$usuario->login);
        $stmt -> bindValue(':senha',$usuario->senha);
        $stmt -> execute();

        $usuario_id = $this->conexao->lastInsertId();
        return $usuario_id;

    }

    public function listar()
    {
        $sql = 'SELECT * FROM usuario';
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();

        $resultados = $stmt->fetchAll(PDO::FETCH_OBJ);
        $usuarios = array();

        foreach ($resultados as $resultado) {

            $novo_usuario = $this->preencher_usuario($resultado);

            $usuarios[] = $novo_usuario;
        }
        return $usuarios;
    }

    public function buscar_id(int $id)
    {
        $sql = 'SELECT * FROM usuario WHERE id = :id';
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        
        $resultado = $stmt->fetch(PDO::FETCH_OBJ);
        $usuario = $this->preencher_usuario($resultado);
        return $usuario;
    }

    public function validar(Usuario $usuario)
    {
        $sql = 'select  u.id, u.nome, u.cpf, u.data_nascimento,	u.telefone, u.email, u.endereco, u.login, u.senha, f.id as id_funcionario, f.cargo, c.id as id_cliente from usuario as u left join funcionario as f on u.id = f.usuario_id left join cliente as c on u.id = c.usuario_id where u.login = :login';
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':login', $usuario->login);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_OBJ);
        if(!empty($resultado->id_funcionario)){
            $funcionario = $this->novo_funcionario_join($resultado);
            return $funcionario;
        }else if(!empty($resultado->id_cliente)){
            $cliente = $this->novo_cliente_join($resultado);
            return $cliente;
        }else{
            return false;
        }
    }
    
    public function atualizar(Usuario $usuario)
    {
        $sql = 'UPDATE usuario SET nome = :nome, cpf = :cpf, data_nascimento = :data_nascimento, 
            telefone = :telefone, email = :email, endereco = :endereco, login = :login WHERE id = :id';
        $stmt = $this->conexao->prepare($sql);
        $stmt -> bindValue(':nome', $usuario->nome);        
        $stmt -> bindValue(':cpf',$usuario->cpf);
        $stmt -> bindValue(':data_nascimento',$usuario->data_nascimento);
        $stmt -> bindValue(':telefone',$usuario->telefone);
        $stmt -> bindValue(':email',$usuario->email);
        $stmt -> bindValue(':endereco',$usuario->endereco);
        $stmt -> bindValue(':login',$usuario->login);
        $stmt -> bindValue(':id',$usuario->id);

        $stmt -> execute();
    }

    public function buscar_cpf(string $cpf)
    {
        $sql = 'SELECT * FROM usuario WHERE cpf = :cpf';
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':cpf', $cpf);
        $stmt->execute();

        $resultado = $stmt->fetch(PDO::FETCH_OBJ);

        if (!empty($resultado)) {
            return $this->preencher_usuario($resultado);
        }

        return null;
    }

    public function buscar_login(string $login)
    {
        $sql = 'SELECT * FROM usuario WHERE login = :login';
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':login', $login);
        $stmt->execute();
        
        $resultado = $stmt->fetch(PDO::FETCH_OBJ);

        if (!empty($resultado)) {
            return $this->preencher_usuario($resultado);
        }

        return null;
    }

    private function preencher_usuario($resultado)
    {
        $usuario = new Usuario($resultado->id, $resultado->nome, $resultado->cpf, $resultado->data_nascimento, $resultado->telefone, $resultado->email, $resultado->endereco, $resultado->login, $resultado->senha);
        
        return $usuario;
    }

    private function novo_funcionario_join($resultado)
    {
        $usuario = $this->preencher_usuario($resultado);

        $funcionario = new Funcionario($resultado->id_funcionario, $resultado->cargo, $usuario);

        return $funcionario;
    }

    private function novo_cliente_join($resultado)
    {
        $usuario = $this->preencher_usuario($resultado);

        $cliente = new Cliente($resultado->id_cliente, $usuario);

        return $cliente;
    }
}