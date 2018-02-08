<?php
abstract class Coneccion
{
    private $dbh;
    public function Conecta()
    {   
        // local
        return $this->dbh=new PDO('mysql:host=127.0.0.1;dbname=rshbd', "root","");
        // server muni
        //return $this->dbh=new PDO('mysql:host=localhost;dbname=rshbd', "root", "#FX"."$"."sclW01");
    }
} 
