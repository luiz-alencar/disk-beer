<?php

interface IDao {

    public function inserir(object $objeto);
    public function listar();
    public function buscar_id(int $id);
    
}