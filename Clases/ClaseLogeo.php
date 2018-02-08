<?php
require_once("ClaseConeccion.php");
class Logeo extends  Coneccion
{
    private $dbh            ;    private $logeo    ;
    public function __construct()
    {
        $this->dbh=parent::conecta();
        $this->logeo      =   array();
    }
    private function set_names()
    {
        return $this->dbh->query("SET NAMES 'utf8'");    
    }
    
    /****************Perfiles***************/
    public function add_logeo($Modulo , $Usuario)
    {
        self::set_names();
        $sql="INSERT INTO logeo
                     values ( NULL ,  CURRENT_TIMESTAMP, ? , ? );";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$Modulo          ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$Usuario         ,   PDO::PARAM_STR);

        $stmt->execute();
        //$id=mysql_insert_id();
        $this->dbh=null;
        header("Location: Menu_Sistema.php");exit;
    }
    
    /*************Fin Actividades***************/
}
?>