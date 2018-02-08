<?php
require_once("ClaseConeccion.php");
class Poblacion extends  Coneccion
{
    private $dbh            ;    private $poblacion    ;
    public function __construct()
    {
        $this->dbh=parent::conecta();
        $this->poblacion      =   array();
    }
    private function set_names()
    {
        return $this->dbh->query("SET NAMES 'utf8'");    
    }
    
    /****************Perfiles***************/
    public function edit_poblacion()
    {
        if(empty($_POST["Poblacion"]))         {
            header("Location: Poblacion.php?m=1&id=".$_POST["id"]);exit;
        }
        $id=$_POST["id"];
        self::set_names();
        $sql="UPDATE poblacion SET
                     Poblacion        =   ?       
            where
                     id     =?";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["Poblacion"]         ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$_POST["id"]            ,   PDO::PARAM_STR);
        $stmt->execute();
        $this->dbh=null;
        header("Location: EditPoblacion.php?m=2&id=".$_POST["id"]);exit;
    }
    public function add_poblacion()
    {
        if(empty($_POST["Poblacion"]) )
        {
            header("Location: AddPoblacion.php?m=1");exit;
        }
        //insertar el registro en la tabla clientes
        self::set_names();
        $sql="INSERT INTO poblacion
                     values ( NULL , ?);";

        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["Poblacion"]        ,   PDO::PARAM_STR);
        $stmt->execute();
        //$id=mysql_insert_id();
        $id= $this->dbh->lastInsertId();
        $this->dbh=null;
        header("Location: AddPoblacion.php?m=2");exit;
    }
    public function get_poblaciones()
    {
        self::set_names();
        $sql="SELECT  poblacion.*  
              from poblacion
              ORDER BY poblacion.Poblacion;";
        foreach ($this->dbh->query($sql) as $row)
        {
            $this->poblacion[]=$row;
        }  
        return $this->poblacion;
        $this->dbh=null;
    }
    public function get_poblacion_por_id($id)
    {
         if(isset($id))
        {
            self::set_names();
            $sql="SELECT * FROM poblacion
                  WHERE id=?;";
            $stmt=$this->dbh->prepare($sql);
            if($stmt->execute( array($id) ) )
            {
                while($row = $stmt->fetch())
                {
                    $this->poblacion[]=$row;
                }
                return $this->poblacion;
                $this->dbh=null;
            }
        }else
        {
            header("Location: error.php");
        }
    }
    /*************Fin Poblacion***************/
}
?>