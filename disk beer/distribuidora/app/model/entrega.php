<?php
class Entrega
{

    private $id;
    private $observacao;
    private $situacao;
    private $cliente;
    private $mercadorias;

    public function __construct($id, $observacao, $situacao, $cliente, $mercadorias)
    {
        $this->id = $id;
        $this->observacao = $observacao;
        $this->situacao = $situacao;
        $this->cliente = $cliente;
        $this->mercadorias = $mercadorias;
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