<?php

class Usuario
{
    private $id;
    private $nome;
    private $cpf;
    private $data_nascimento;   
    private $telefone;
    private $email;
    private $endereco;
    private $login;
    private $senha;
    
    public function __construct($id, $nome, $cpf, $data_nascimento, $telefone, $email, $endereco, $login, $senha)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->data_nascimento = $data_nascimento;
        $this->telefone = $telefone;
        $this->email = $email;
        $this->endereco = $endereco;
        $this->login = $login;
        $this->senha = $senha;
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

  