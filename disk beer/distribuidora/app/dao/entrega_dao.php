<?php

require_once '../config/conexao.php';
require_once '../model/entrega.php';
require_once 'cliente_dao.php';
require_once 'mercadoria_dao.php';
require_once 'idao.php';

class EntregaDao implements IDao {
    private $conexao;

    public function __construct()
    {
        $conexao = new Conexao();
        $this -> conexao = $conexao -> conectar();  
    }

    public function inserir(object $entrega){
        $sql = 'INSERT INTO entrega (observacao, situacao, cliente_id) VALUES (:observacao, :situacao, :cliente_id)';
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':observacao', $entrega->observacao);
        $stmt->bindValue(':situacao', $entrega->situacao->value);
        $stmt->bindValue(':cliente_id', $entrega->cliente->id);  
        $stmt->execute();
        $entrega_id = $this->conexao->lastInsertId();

        foreach ($entrega->mercadorias as $mercadoria) {
            $sql = 'INSERT INTO item (entrega_id, mercadoria_id, quantidade) VALUES (:entrega_id, :mercadoria_id, :quantidade)';
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(':entrega_id', $entrega_id);
            $stmt->bindValue(':mercadoria_id', $mercadoria->id);
            $stmt->bindValue(':quantidade', $mercadoria->quantidade);
            $stmt->execute();
        }
    }

    public function listar(){
        $sql = 'SELECT * FROM entrega';
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();

        $resultados = $stmt->fetchAll(PDO::FETCH_OBJ);
        $entregas = array();

        foreach ($resultados as $item) {
            $clienteDao = new ClienteDao();
            $cliente = $clienteDao->buscar_id($item->cliente_id);
            $mercadorias = $this->buscar_mercadorias($item);

            $nova_entrega = new Entrega($item->id, $item->observacao,$item->situacao, $cliente, $mercadorias);

            $entregas[] = $nova_entrega;
        }
        return $entregas;
    }

    public function listar_situacao(SituacaoEntrega $situacao){
        $sql = 'SELECT * FROM entrega WHERE situacao = :situacao';
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':situacao', $situacao->value);
        $stmt->execute();

        $resultados = $stmt->fetchAll(PDO::FETCH_OBJ);
        $entregas = array();

        foreach ($resultados as $item) {
            $clienteDao = new ClienteDao();
            $cliente = $clienteDao->buscar_id($item->cliente_id);
            $mercadorias = $this->buscar_mercadorias($item);

            $nova_entrega = new Entrega($item->id, $item->observacao,$item->situacao, $cliente, $mercadorias);

            $entregas[] = $nova_entrega;
        }
        return $entregas;
    }

    public function buscar_id(int $id){
        $sql = 'SELECT * FROM entrega WHERE id = :id';
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        $resultado = $stmt->fetch(PDO::FETCH_OBJ);

        $clienteDao = new ClienteDao();
        $cliente = $clienteDao->buscar_id($resultado->cliente_id);
        $mercadorias = $this->buscar_mercadorias($resultado);

        $entrega = new Entrega($resultado->id, $resultado->observacao,$resultado->situacao, $cliente, $mercadorias);
        return $entrega;
    }

    public function atualizar(Entrega $entrega){
        $sql = 'UPDATE entrega SET observacao = :observacao, situacao = :situacao, cliente_id = :cliente_id WHERE id = :id; DELETE FROM item WHERE entrega_id = :id;';
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':id', $entrega->id);
        $stmt->bindValue(':observacao', $entrega->observacao);
        $stmt->bindValue(':situacao', $entrega->situacao->value);
        $stmt->bindValue(':cliente_id', $entrega->cliente->id);  
        $stmt->execute();

        foreach ($entrega->mercadorias as $mercadoria) {
            $sql = 'INSERT INTO item (entrega_id, mercadoria_id, quantidade) VALUES (:entrega_id, :mercadoria_id, :quantidade)';
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(':entrega_id', $entrega->id);
            $stmt->bindValue(':mercadoria_id', $mercadoria->id);
            $stmt->bindValue(':quantidade', $mercadoria->quantidade);
            $stmt->execute();
        }
    }

    public function excluir(int $id){
        $sql = 'DELETE FROM item WHERE entrega_id = :id; DELETE FROM entrega WHERE id = :id;';
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }

    public function buscar_cliente_id(int $cliente_id){
        $sql = 'SELECT * FROM entrega WHERE cliente_id = :cliente_id';
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue('cliente_id', $cliente_id);
        $stmt->execute();

        $resultados = $stmt->fetchAll(PDO::FETCH_OBJ);
        $entregas = array();

        foreach ($resultados as $item) {
            $clienteDao = new ClienteDao();
            $cliente = $clienteDao->buscar_id($item->cliente_id);
            $mercadorias = $this->buscar_mercadorias($item);
            
            $nova_entrega = new Entrega($item->id, $item->observacao, $item->situacao, $cliente, $mercadorias);

            $entregas[] = $nova_entrega;
        }
        return $entregas;
    
    }

    private function buscar_mercadorias($entrega_banco){
        $entrega_id = $entrega_banco->id;
        $sql = 'SELECT * FROM item WHERE entrega_id = :entrega_id';
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':entrega_id', $entrega_id);
        $stmt->execute();
        $itens = $stmt->fetchAll(PDO::FETCH_OBJ);

        $mercadorias = array();
        $mercadoriaDao = new MercadoriaDao();
        foreach ($itens as $item) {
            $resultado = $mercadoriaDao->buscar_id($item->mercadoria_id);

            $mercadoria = new Mercadoria($resultado->id, $resultado->nome, $resultado->preco, $item->quantidade);
            $mercadorias[] = $mercadoria;
        }

        return $mercadorias;
    }
}
?>