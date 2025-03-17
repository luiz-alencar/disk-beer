<?php
class Mercadoria
{

    private $id;
    private $nome;
    private $preco;
    private $quantidade;

    public function __construct($id, $nome, $preco, $quantidade)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->preco = $preco;
        $this->quantidade = $quantidade;
    }

    public function __get($atributo)
    {
      return $this->$atributo;
    }
  
    public function __set($atributo, $valor)
    {
      $this->$atributo = $valor;
    }
}