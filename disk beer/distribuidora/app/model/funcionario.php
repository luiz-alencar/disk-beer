<?php
class Funcionario
{
    private $id;
    private $cargo;
    private $usuario;

    public function __construct($id, $cargo, $usuario)
    {
        $this->id = $id;
        $this->cargo = $cargo;
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