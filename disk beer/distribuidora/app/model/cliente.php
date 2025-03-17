<?php
class Cliente
{

    private $id;
    private $usuario;
    

    public function __construct($id, $usuario)
    {
        $this->id = $id;
        $this->usuario = $usuario;
        
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