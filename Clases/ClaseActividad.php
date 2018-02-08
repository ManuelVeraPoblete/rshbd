<?php
require_once("ClaseConeccion.php");
class Actividades extends  Coneccion
{
    private $dbh            ;    private $actividades    ;
    public function __construct()
    {
        $this->dbh=parent::conecta();
        $this->actividades      =   array();
    }
    private function set_names()
    {
        return $this->dbh->query("SET NAMES 'utf8'");    
    }
    
    /****************Perfiles***************/
    public function edit_actividades()
    {
        if(empty($_POST["Actividades"]))         {
            header("Location: Actividades.php?m=1&id=".$_POST["id"]);exit;
        }
        $id=$_POST["id"];
        self::set_names();
        $sql="UPDATE actividades SET
                     Actividades        =   ?       
            where
                     id     =?";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["Actividades"]         ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$_POST["id"]            ,   PDO::PARAM_STR);
        $stmt->execute();
        $this->dbh=null;
        header("Location: EditActividades.php?m=2&id=".$_POST["id"]);exit;
    }
    public function add_actividades_diarias()
    {
        self::set_names();
        $sql="INSERT INTO actividad_diaria
                     values ( NULL , ?, ?, ?, ?);";
        $stmt=$this->dbh->prepare($sql);

        $stmt->bindValue(1,$_POST["Usuario_Id"]         ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$_POST["Fecha_Actividad"]    ,   PDO::PARAM_STR);
        $stmt->bindValue(3,$_POST["Actividad_Id"]       ,   PDO::PARAM_STR);
        $stmt->bindValue(4,$_POST["Cantidad"]           ,   PDO::PARAM_STR);   
        $stmt->execute();
        //$id=mysql_insert_id();
        $this->dbh=null;
        header("Location: Actividades_Diarias.php");exit;
    }
    public function add_actividades()
    {
        if(empty($_POST["Actividades"]) )
        {
            header("Location: AddActividades.php?m=1");exit;
        }
        //insertar el registro en la tabla clientes
        self::set_names();
        $sql="INSERT INTO actividades
                     values ( NULL , ?);";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["Actividades"]        ,   PDO::PARAM_STR);
        $stmt->execute();
        //$id=mysql_insert_id();
        $id= $this->dbh->lastInsertId();
        $this->dbh=null;
        header("Location: AddActividades.php?m=2");exit;
    }
    public function get_actividades()
    {
        self::set_names();
        $sql="SELECT  actividades.*  
              from actividades
              ORDER BY actividades.Actividades ASC ;";
        foreach ($this->dbh->query($sql) as $row)
        {
            $this->actividades[]=$row;
        }  
        return $this->actividades;
        $this->dbh=null;
    }
    public function get_actividades_por_id($id)
    {
        if(isset($id))
        {
            self::set_names();
            $sql="SELECT * FROM actividades
                  WHERE id=?;";
            $stmt=$this->dbh->prepare($sql);
            if($stmt->execute( array($id) ) )
            {
                while($row = $stmt->fetch())
                {
                    $this->actividades[]=$row;
                }
                return $this->actividades;
                $this->dbh=null;
            }
        }else
        {
            header("Location: error.php");
        }
    }
    /*************Fin Actividades***************/
}
?>