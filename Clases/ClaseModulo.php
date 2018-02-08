<?php
require_once("ClaseConeccion.php");
class Modulo extends  Coneccion
{
    private $dbh            ;    private $modulo    ;
    public function __construct()
    {
        $this->dbh=parent::conecta();
        $this->modulo      =   array();
    }
    private function set_names()
    {
        return $this->dbh->query("SET NAMES 'utf8'");    
    }
    
    /****************Perfiles***************/
    public function edit_modulo()
    {
        if(empty($_POST["Modulo"]))         {
            header("Location: Modulos.php?m=1&id=".$_POST["id"]);exit;
        }
        $id=$_POST["id"];
        self::set_names();
        $sql="UPDATE modulo SET
                     Modulo        =   ?       
            where
                     id     =?";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["Modulo"]         ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$_POST["id"]            ,   PDO::PARAM_STR);
        $stmt->execute();
        $this->dbh=null;
        header("Location: EditModulo.php?m=2&id=".$_POST["id"]);exit;
    }
    public function add_modulo()
    {
        if(empty($_POST["Modulo"]) )
        {
            header("Location: AddModulo.php?m=1");exit;
        }
        //insertar el registro en la tabla clientes
        self::set_names();
        $sql="INSERT INTO modulo
                     values ( NULL , ?);";

        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["Modulo"]        ,   PDO::PARAM_STR);
        $stmt->execute();
        //$id=mysql_insert_id();
        $id= $this->dbh->lastInsertId();
        $this->dbh=null;
        header("Location: AddModulo.php?m=2");exit;
    }
    public function get_modulos()
    {
        self::set_names();
        $sql="SELECT  modulo.*  
              from modulo;";
        foreach ($this->dbh->query($sql) as $row)
        {
            $this->modulo[]=$row;
        }  
        return $this->modulo;
        $this->dbh=null;
    }
    public function get_modulo_por_id($id)
    {
         if(isset($id))
        {
            self::set_names();
            $sql="SELECT * FROM modulo
                  WHERE id=?;";
            $stmt=$this->dbh->prepare($sql);
            if($stmt->execute( array($id) ) )
            {
                while($row = $stmt->fetch())
                {
                    $this->modulo[]=$row;
                }
                return $this->modulo;
                $this->dbh=null;
            }
        }else
        {
            header("Location: error.php");
        }
    }
    /*************Fin Modulo***************/
}
?>