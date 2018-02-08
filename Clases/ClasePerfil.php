<?php
require_once("ClaseConeccion.php");
class Perfil extends  Coneccion
{
    private $dbh            ;    private $perfil    ;
    public function __construct()
    {
        $this->dbh=parent::conecta();
        $this->perfil      =   array();
    }
    private function set_names()
    {
        return $this->dbh->query("SET NAMES 'utf8'");    
    }
    /****************Perfiles***************/
    public function edit_perfil()
    {
        if(empty($_POST["Perfil"]))         {
            header("Location: EditPerfil.php?m=1&id=".$_POST["id"]);exit;
        }
        $id=$_POST["id"];
        self::set_names();
        $sql="UPDATE perfil SET
                     Perfil        =   ?       
            where
                     id     =?";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["Perfil"]         ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$_POST["id"]             ,   PDO::PARAM_STR);
        $stmt->execute();
        $this->dbh=null;
        header("Location: EditPerfil.php?m=2&id=".$_POST["id"]);exit;
    }
    public function add_perfil()
    {
        if(empty($_POST["Perfil"]) )
        {
            header("Location: AddPerfil.php?m=1");exit;
        }
        //insertar el registro en la tabla clientes
        self::set_names();
        $sql="INSERT INTO perfil
                     values ( NULL , ?);";

        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["Perfil"]        ,   PDO::PARAM_STR);
        $stmt->execute();
        //$id=mysql_insert_id();
        $id= $this->dbh->lastInsertId();
        $this->dbh=null;
        header("Location: AddPerfil.php?m=2");exit;
    }
    public function get_perfiles()
    {
        self::set_names();
        $sql="SELECT  perfil.*  
              from perfil;";
        foreach ($this->dbh->query($sql) as $row)
        {
            $this->perfil[]=$row;
        }  
        return $this->perfil;
        $this->dbh=null;
    }
    public function get_perfil_por_id($id)
    {
         if(isset($id))
        {
            self::set_names();
            $sql="SELECT * FROM perfil 
                  WHERE id=?;";
            $stmt=$this->dbh->prepare($sql);
            if($stmt->execute( array($id) ) )
            {
                while($row = $stmt->fetch())
                {
                    $this->perfil[]=$row;
                }
                return $this->perfil;
                $this->dbh=null;
            }
        }else
        {
            header("Location: error.php");
        }
    }
    /*************Fin Perfiles***************/
}
?>