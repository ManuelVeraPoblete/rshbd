<?php
require_once("ClaseConeccion.php");
class Requerimiento extends  Coneccion
{
    private $dbh            ;    private $requerimiento    ;
    public function __construct()
    {
        $this->dbh=parent::conecta();
        $this->requerimiento      =   array();
    }
    private function set_names()
    {
        return $this->dbh->query("SET NAMES 'utf8'");    
    }
    
    /****************Perfiles***************/
    
    public function get_requerimientos()
    {
        self::set_names();
        $sql="SELECT  requerimientos.*  
              from requerimientos;";
        foreach ($this->dbh->query($sql) as $row)
        {
            $this->consulta[]=$row;
        }  
        return $this->consulta;
        $this->dbh=null;
    }
}
?>