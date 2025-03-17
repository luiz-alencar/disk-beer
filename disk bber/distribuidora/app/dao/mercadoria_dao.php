<?php

require_once '../config/conexao.php';
require_once '../model/mercadoria.php';
require_once 'idao.php';

class MercadoriaDao implements IDao {
    private $conexao;

    public function __construct()
    {
        $conexao = new Conexao();
        $this-> conexao = $conexao->conectar();
    }

    public function inserir(object $mercadoria){
        $sql = 'INSERT INTO mercadoria (nome, preco) VALUES (:nome, :preco)';
        $stmt = $this -> conexao -> prepare($sql);
        $stmt -> bindValue(':nome', $mercadoria-> nome);
        $stmt -> bindValue(':preco', $mercadoria-> preco);
        $stmt -> execute();
    }

    public function listar(){
        $sql = 'SELECT * FROM mercadoria';
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();

        $resultados = $stmt->fetchAll(PDO::FETCH_OBJ);
        $mercadorias = array();

        foreach ($resultados as $item) {

            $nova_mercadoria = new Mercadoria($item->id, $item->nome, $item->preco, 0);

            $mercadorias[] = $nova_mercadoria;
        }
        return $mercadorias;
    }
    
    public function buscar_id(int $id){
        $sql = 'SELECT * FROM mercadoria WHERE id = :id';
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        $resultado = $stmt->fetch(PDO::FETCH_OBJ);

        $mercadoria = new Mercadoria($resultado->id, $resultado->nome, $resultado->preco, 0);
        return $mercadoria;
    }
}
?>