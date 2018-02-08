<?php
require_once("ClaseConeccion.php");
class Respuesta extends  Coneccion
{
    private $dbh            ;    private $respuestas    ;
    public function __construct()
    {
        $this->dbh=parent::conecta();
        $this->respuestas      =   array();
    }
    private function set_names()
    {
        return $this->dbh->query("SET NAMES 'utf8'");    
    }
    
    /****************Perfiles***************/
    public function edit_respuestas()
    {
        if(empty($_POST["Respuesta_Corta"]) OR empty($_POST["Respuesta_Larga"]))         
        {
            header("Location: Respuesta.php?m=1&id=".$_POST["id"]);exit;
        }
        $id=$_POST["id"];
        self::set_names();
        $sql="UPDATE respuestas SET
                     Respuesta_Corta        =   ?       ,
                     Respuesta_Larga        =   ?       
            where
                     id     =?";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["Respuesta_Corta"]     ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$_POST["Respuesta_Larga"]     ,   PDO::PARAM_STR);
        $stmt->bindValue(3,$_POST["id"]            ,   PDO::PARAM_STR);
        $stmt->execute();
        $this->dbh=null;
        header("Location: EditRespuesta.php?m=2&id=".$_POST["id"]);exit;
    }
    public function add_respuestas()
    {
        if(empty($_POST["Respuesta_Corta"]) OR empty($_POST["Respuesta_Larga"]))
        {
            header("Location: AddRespuesta.php?m=1");exit;
        }
        //insertar el registro en la tabla clientes
        self::set_names();
        $sql="INSERT INTO respuestas
                     values ( NULL , ? , ?);";

        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["Respuesta_Larga"]        ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$_POST["Respuesta_Corta"]        ,   PDO::PARAM_STR);
        $stmt->execute();
        //$id=mysql_insert_id();
        $id= $this->dbh->lastInsertId();
        $this->dbh=null;
        header("Location: AddRespuesta.php?m=2");exit;
    }
    public function get_respuestas()
    {
        self::set_names();
        $sql="SELECT  respuestas.*  
              from respuestas;";
        foreach ($this->dbh->query($sql) as $row)
        {
            $this->respuestas[]=$row;
        }  
        return $this->respuestas;
        $this->dbh=null;
    }
    public function get_respuestas_por_id($id)
    {
         if(isset($id))
        {
            self::set_names();
            $sql="SELECT * FROM respuestas
                  WHERE id=?;";
            $stmt=$this->dbh->prepare($sql);
            if($stmt->execute( array($id) ) )
            {
                while($row = $stmt->fetch())
                {
                    $this->respuestas[]=$row;
                }
                return $this->respuestas;
                $this->dbh=null;
            }
        }else
        {
            header("Location: error.php");
        }
    }
    /*************Fin Respuesta***************/
}
?>