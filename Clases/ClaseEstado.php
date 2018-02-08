<?php
require_once("ClaseConeccion.php");
class Estado extends  Coneccion
{
    private $dbh            ;    private $estado    ;
    public function __construct()
    {
        $this->dbh=parent::conecta();
        $this->estado      =   array();
    }
    private function set_names()
    {
        return $this->dbh->query("SET NAMES 'utf8'");    
    }
    
    /****************Perfiles***************/
    public function edit_estado()
    {
        if(empty($_POST["Estado"]))         {
            header("Location: Estado.php?m=1&id=".$_POST["id"]);exit;
        }
        $id=$_POST["id"];
        self::set_names();
        $sql="UPDATE estado SET
                     Estado        =   ?       
            where
                     id     =?";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["Estado"]         ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$_POST["id"]            ,   PDO::PARAM_STR);
        $stmt->execute();
        $this->dbh=null;
        header("Location: EditEstado.php?m=2&id=".$_POST["id"]);exit;
    }
    public function add_estado()
    {
        if(empty($_POST["Estado"]) )
        {
            header("Location: AddEstado.php?m=1");exit;
        }
        //insertar el registro en la tabla clientes
        self::set_names();
        $sql="INSERT INTO estado
                     values ( NULL , ?);";

        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["Estado"]        ,   PDO::PARAM_STR);
        $stmt->execute();
        //$id=mysql_insert_id();
        $id= $this->dbh->lastInsertId();
        $this->dbh=null;
        header("Location: AddEstado.php?m=2");exit;
    }
    public function get_estados()
    {
        self::set_names();
        $sql="SELECT  estado.*  
              from estado;";
        foreach ($this->dbh->query($sql) as $row)
        {
            $this->estado[]=$row;
        }  
        return $this->estado;
        $this->dbh=null;
    }
    public function get_estado_por_id($id)
    {
         if(isset($id))
        {
            self::set_names();
            $sql="SELECT * FROM estado
                  WHERE id=?;";
            $stmt=$this->dbh->prepare($sql);
            if($stmt->execute( array($id) ) )
            {
                while($row = $stmt->fetch())
                {
                    $this->estado[]=$row;
                }
                return $this->estado;
                $this->dbh=null;
            }
        }else
        {
            header("Location: error.php");
        }
    }
    /*************Fin Estado***************/
}
?>