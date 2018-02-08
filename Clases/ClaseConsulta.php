<?php
require_once("ClaseConeccion.php");
class Consulta extends  Coneccion
{
    private $dbh            ;    private $consulta    ;
    public function __construct()
    {
        $this->dbh=parent::conecta();
        $this->consulta      =   array();
    }
    private function set_names()
    {
        return $this->dbh->query("SET NAMES 'utf8'");    
    }
    
    /****************Perfiles***************/
    public function edit_consulta()
    {
        if(empty($_POST["Consulta"]))         {
            header("Location: Consulta.php?m=1&id=".$_POST["id"]);exit;
        }
        $id=$_POST["id"];
        self::set_names();
        $sql="UPDATE consulta SET
                     Consulta        =   ?       
                     Resumen         =   ?       
            where
                     id     =?";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["Consulta"]         ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$_POST["Resumen"]         ,   PDO::PARAM_STR);
        $stmt->bindValue(3,$_POST["id"]            ,   PDO::PARAM_STR);
        $stmt->execute();
        $this->dbh=null;
        header("Location: EditConsulta.php?m=2&id=".$_POST["id"]);exit;
    }
    public function add_consulta()
    {
        if(empty($_POST["Consulta"]) )
        {
            header("Location: AddConsulta.php?m=1");exit;
        }
        //insertar el registro en la tabla clientes
        self::set_names();
        $sql="INSERT INTO consulta
                     values ( NULL , ?, ?);";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["Consulta"]        ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$_POST["Resumen"]         ,   PDO::PARAM_STR);
        $stmt->execute();
        //$id=mysql_insert_id();
        $id= $this->dbh->lastInsertId();
        $this->dbh=null;
        header("Location: AddConsulta.php?m=2");exit;
    }
    public function get_consultas()
    {
        self::set_names();
        $sql="SELECT  consulta.*  
              from consulta;";
        foreach ($this->dbh->query($sql) as $row)
        {
            $this->consulta[]=$row;
        }  
        return $this->consulta;
        $this->dbh=null;
    }
    public function get_consulta_por_id($id)
    {
         if(isset($id))
        {
            self::set_names();
            $sql="SELECT * FROM consulta
                  WHERE id=?;";
            $stmt=$this->dbh->prepare($sql);
            if($stmt->execute( array($id) ) )
            {
                while($row = $stmt->fetch())
                {
                    $this->consulta[]=$row;
                }
                return $this->consulta;
                $this->dbh=null;
            }
        }else
        {
            header("Location: error.php");
        }
    }
    public function get_consulta_por_requerimiento($id)
    {
         if(isset($id))
        {
            self::set_names();
            $sql="SELECT * FROM consulta
                  WHERE Requerimiento_Id=?;";
            $stmt=$this->dbh->prepare($sql);
            if($stmt->execute( array($id) ) )
            {
                while($row = $stmt->fetch())
                {
                    $this->consulta[]=$row;
                }
                return $this->consulta;
                $this->dbh=null;
            }
        }else
        {
            header("Location: error.php");
        }
    }

    public function get_nombre_consula($id)
    {
        if(isset($id))
        {
            self::set_names();
            $sql="SELECT consulta.Consulta FROM consulta
                  WHERE id=?;";
            $stmt=$this->dbh->prepare($sql);
            if($stmt->execute( array($id) ) )
            {
                while($row = $stmt->fetch())
                {
                    $this->consulta[]=$row;
                }
                return $this->consulta;
                $this->dbh=null;
            }
        }else
        {
            header("Location: error.php");
        }
    }
    /*************Fin Consulta***************/
}
?>