<?php
require_once("ClaseConeccion.php");
class Anulacion extends  Coneccion
{
    private $dbh            ;    private $anulacion    ;
    public function __construct()
    {
        $this->dbh=parent::conecta();
        $this->anulacion      =   array();
    }
    private function set_names()
    {
        return $this->dbh->query("SET NAMES 'utf8'");    
    }
    
    /****************Perfiles***************/
    public function edit_anulacion()
    {
        if(empty($_POST["Anulacion_Motivo"]))         {
            header("Location: EditAnulacion.php?m=1&id=".$_POST["id"]);exit;
        }
        $id=$_POST["id"];
        self::set_names();
        $sql="UPDATE anulacion SET
                     Anulacion_Motivo        =   ?       
            where
                     id     =?";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["Anulacion_Motivo"]         ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$_POST["id"]            ,   PDO::PARAM_STR);
        $stmt->execute();
        $this->dbh=null;
        header("Location: EditAnulacion.php?m=2&id=".$_POST["id"]);exit;
    }
    public function add_anulacion()
    {
        if(empty($_POST["Anulacion_Motivo"]) )
        {
            header("Location: AddAnulacion.php?m=1");exit;
        }
        //insertar el registro en la tabla clientes
        self::set_names();
        $sql="INSERT INTO anulacion
                     values ( NULL , ?);";

        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["Anulacion_Motivo"]        ,   PDO::PARAM_STR);
        $stmt->execute();
        //$id=mysql_insert_id();
        $id= $this->dbh->lastInsertId();
        $this->dbh=null;
        header("Location: AddAnulacion.php?m=2");exit;
    }
    public function get_anulaciones()
    {
        self::set_names();
        $sql="SELECT  anulacion.*  
              from anulacion;";
        foreach ($this->dbh->query($sql) as $row)
        {
            $this->anulacion[]=$row;
        }  
        return $this->anulacion;
        $this->dbh=null;
    }
    public function get_anulacion_por_id($id)
    {
         if(isset($id))
        {
            self::set_names();
            $sql="SELECT * FROM anulacion
                  WHERE id=?;";
            $stmt=$this->dbh->prepare($sql);
            if($stmt->execute( array($id) ) )
            {
                while($row = $stmt->fetch())
                {
                    $this->anulacion[]=$row;
                }
                return $this->anulacion;
                $this->dbh=null;
            }
        }else
        {
            header("Location: error.php");
        }
    }
    /*************Fin Anulacion***************/
}
?>