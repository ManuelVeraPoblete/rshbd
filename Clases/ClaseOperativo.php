<?php
require_once("ClaseConeccion.php");
class Operativo extends  Coneccion
{
    private $dbh            ;    private $operativo    ;
    public function __construct()
    {
        $this->dbh=parent::conecta();
        $this->operativo      =   array();
    }
    private function set_names()
    {
        return $this->dbh->query("SET NAMES 'utf8'");    
    }
    /****************Operativoes***************/
    public function edit_operativo()
    {
        if(empty($_POST["Operativo"]))         {
            header("Location: EditOperativo.php?m=1&id=".$_POST["id"]);exit;
        }
        $id=$_POST["id"];
        self::set_names();
        $sql="UPDATE operativo SET
                     Operativo        =   ?       
            where
                     id     =?";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["Operativo"]         ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$_POST["id"]             ,   PDO::PARAM_STR);
        $stmt->execute();
        $this->dbh=null;
        header("Location: EditOperativo.php?m=2&id=".$_POST["id"]);exit;
    }
    public function add_operativo()
    {
        if(empty($_POST["Operativo"]) )
        {
            header("Location: AddOperativo.php?m=1");exit;
        }
        //insertar el registro en la tabla clientes
        self::set_names();
        $sql="INSERT INTO operativo
                     values ( NULL , ?);";

        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["Operativo"]        ,   PDO::PARAM_STR);
        $stmt->execute();
        //$id=mysql_insert_id();
        $id= $this->dbh->lastInsertId();
        $this->dbh=null;
        header("Location: AddOperativo.php?m=2");exit;
    }
    public function get_operativoes()
    {
        self::set_names();
        $sql="SELECT  operativo.*  
              from operativo;";
        foreach ($this->dbh->query($sql) as $row)
        {
            $this->operativo[]=$row;
        }  
        return $this->operativo;
        $this->dbh=null;
    }
    public function get_operativo_por_id($id)
    {
         if(isset($id))
        {
            self::set_names();
            $sql="SELECT * FROM operativo 
                  WHERE id=?;";
            $stmt=$this->dbh->prepare($sql);
            if($stmt->execute( array($id) ) )
            {
                while($row = $stmt->fetch())
                {
                    $this->operativo[]=$row;
                }
                return $this->operativo;
                $this->dbh=null;
            }
        }else
        {
            header("Location: error.php");
        }
    }
    /*************Fin Operativoes***************/
}
?>