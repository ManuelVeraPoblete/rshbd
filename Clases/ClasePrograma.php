<?php
require_once("ClaseConeccion.php");
class Programa extends  Coneccion
{
    private $dbh            ;    private $programa    ;
    public function __construct()
    {
        $this->dbh=parent::conecta();
        $this->programa      =   array();
    }
    private function set_names()
    {
        return $this->dbh->query("SET NAMES 'utf8'");    
    }
    
    /****************Perfiles***************/
    public function edit_programa()
    {
        if(empty($_POST["Programa"]))         {
            header("Location: Programa.php?m=1&id=".$_POST["id"]);exit;
        }
        $id=$_POST["id"];
        self::set_names();
        $sql="UPDATE programa SET
                     Programa        =   ?       
            where
                     id     =?";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["Programa"]         ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$_POST["Resumen"]         ,   PDO::PARAM_STR);
        $stmt->bindValue(3,$_POST["id"]            ,   PDO::PARAM_STR);
        $stmt->execute();
        $this->dbh=null;
        header("Location: EditPrograma.php?m=2&id=".$_POST["id"]);exit;
    }
    public function add_programa()
    {
        if(empty($_POST["Programa"]) )
        {
            header("Location: AddPrograma.php?m=1");exit;
        }
        //insertar el registro en la tabla clientes
        self::set_names();
        $sql="INSERT INTO programa
                     values ( NULL , ?, ?);";

        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["Programa"]        ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$_POST["Resumen"]        ,   PDO::PARAM_STR);
        $stmt->execute();
        //$id=mysql_insert_id();
        $id= $this->dbh->lastInsertId();
        $this->dbh=null;
        header("Location: AddPrograma.php?m=2");exit;
    }
    public function get_programas()
    {
        self::set_names();
        $sql="SELECT  programa.*  
              from programa;";
        foreach ($this->dbh->query($sql) as $row)
        {
            $this->programa[]=$row;
        }  
        return $this->programa;
        $this->dbh=null;
    }
    public function get_programa_por_id($id)
    {
         if(isset($id))
        {
            self::set_names();
            $sql="SELECT * FROM programa
                  WHERE id=?;";
            $stmt=$this->dbh->prepare($sql);
            if($stmt->execute( array($id) ) )
            {
                while($row = $stmt->fetch())
                {
                    $this->programa[]=$row;
                }
                return $this->programa;
                $this->dbh=null;
            }
        }else
        {
            header("Location: error.php");
        }
    }
    /*************Fin Programa***************/
}
?>