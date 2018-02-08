<?php

abstract class Conectar
{
    private $mysqli;
    public function conectar()
    {
        //$this->mysqli = new mysqli('localhost', 'root', '#FX'.'$'.'sclW01','rshbd');
        $this->mysqli = new mysqli('127.0.0.1', 'root', '','rshbd');
        return $this->mysqli;
        
    }
    public function setNames()
    {
        $this->mysqli->query("SET NAMES 'utf8'");
    }
} 
