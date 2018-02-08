<?php
require_once("ClaseConeccion.php");
class Calle extends  Coneccion
{
    private $dbh      ;    
    private $calle    ;
    public function __construct()
    {
        $this->dbh=parent::conecta();
        $this->calle      =   array();
    }
    private function set_names()
    {
        return $this->dbh->query("SET NAMES 'utf8'");    
    }
   
    
    /****************Perfiles***************/
    public function edit_calle()
    {
        if(empty($_POST["Calle"]))         {
            header("Location: Calle.php?m=1&id=".$_POST["id"]);exit;
        }
        $id=$_POST["id"];
        self::set_names();
        $sql="UPDATE calle SET
                     Calle        =   ?       
            where
                     id     =?";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["Calle"]         ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$_POST["id"]            ,   PDO::PARAM_STR);
        $stmt->execute();
        $this->dbh=null;
        header("Location: EditCalle.php?m=2&id=".$_POST["id"]);exit;
    }
    public function add_calle()
    {
        if(empty($_POST["Calle"]) )
        {
            header("Location: AddCalle.php?m=1");exit;
        }
        //insertar el registro en la tabla clientes
        self::set_names();
        $sql="INSERT INTO calle
                     values ( NULL , ?);";

        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["Calle"]        ,   PDO::PARAM_STR);
        $stmt->execute();
        //$id=mysql_insert_id();
        $id= $this->dbh->lastInsertId();
        $this->dbh=null;
        header("Location: AddCalle.php?m=2");exit;
    }
    public function get_calles()
    {
        self::set_names();
        $sql="SELECT  calle.*  
              from calle
              ORDER BY calle.Calle ASC;";
        foreach ($this->dbh->query($sql) as $row)
        {
            $this->calle[]=$row;
        }  
        return $this->calle;
        $this->dbh=null;
    }
    public function get_calle_por_id($id)
    {
         if(isset($id))
        {
            self::set_names();
            $sql="SELECT * FROM calle
                  WHERE id=?;";
            $stmt=$this->dbh->prepare($sql);
            if($stmt->execute( array($id) ) )
            {
                while($row = $stmt->fetch())
                {
                    $this->calle[]=$row;
                }
                return $this->calle;
                $this->dbh=null;
            }
        }else
        {
            header("Location: error.php");
        }
    }
    /*************Fin Calle***************/
}
?>