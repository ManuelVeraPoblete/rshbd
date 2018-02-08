<?php
require_once("ClaseConeccion.php");
class Nivel extends  Coneccion
{
    private $dbh            ;    private $nivel    ;
    public function __construct()
    {
        $this->dbh=parent::conecta();
        $this->nivel      =   array();
    }
    private function set_names()
    {
        return $this->dbh->query("SET NAMES 'utf8'");    
    }
    
    /****************Perfiles***************/
    public function edit_nivel()
    {
        if(empty($_POST["Nivel"]))         {
            header("Location: Nivel.php?m=1&id=".$_POST["id"]);exit;
        }
        $id=$_POST["id"];
        self::set_names();
        $sql="UPDATE nivel SET
                     Nivel        =   ?       
            where
                     id     =?";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["Nivel"]         ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$_POST["id"]            ,   PDO::PARAM_STR);
        $stmt->execute();
        $this->dbh=null;
        header("Location: EditNivel.php?m=2&id=".$_POST["id"]);exit;
    }
    public function add_nivel()
    {
        if(empty($_POST["Nivel"]) )
        {
            header("Location: AddNivel.php?m=1");exit;
        }
        //insertar el registro en la tabla clientes
        self::set_names();
        $sql="INSERT INTO nivel
                     values ( NULL , ?);";

        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["Nivel"]        ,   PDO::PARAM_STR);
        $stmt->execute();
        //$id=mysql_insert_id();
        $id= $this->dbh->lastInsertId();
        $this->dbh=null;
        header("Location: AddNivel.php?m=2");exit;
    }
    public function get_niveles()
    {
        self::set_names();
        $sql="SELECT  nivel.*  
              from nivel;";
        foreach ($this->dbh->query($sql) as $row)
        {
            $this->nivel[]=$row;
        }  
        return $this->nivel;
        $this->dbh=null;
    }
    public function get_nivel_por_id($id)
    {
         if(isset($id))
        {
            self::set_names();
            $sql="SELECT * FROM nivel
                  WHERE id=?;";
            $stmt=$this->dbh->prepare($sql);
            if($stmt->execute( array($id) ) )
            {
                while($row = $stmt->fetch())
                {
                    $this->nivel[]=$row;
                }
                return $this->nivel;
                $this->dbh=null;
            }
        }else
        {
            header("Location: error.php");
        }
    }
    /*************Fin Nivel***************/
}
?>