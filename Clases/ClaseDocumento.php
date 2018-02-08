<?php
require_once("ClaseConeccion.php");
class Documento extends  Coneccion
{
    private $dbh            ;    private $documento    ;
    public function __construct()
    {
        $this->dbh=parent::conecta();
        $this->documento      =   array();
    }
    private function set_names()
    {
        return $this->dbh->query("SET NAMES 'utf8'");    
    }
    
    /****************Perfiles***************/
    public function edit_documento()
    {
        if(empty($_POST["Documento"]))         {
            header("Location: EditDocumento.php?m=1&id=".$_POST["id"]);exit;
        }
        $id=$_POST["id"];
        self::set_names();
        $sql="UPDATE documentos SET
                     Documento        =   ?       
            where
                     id     =?";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["Documento"]         ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$_POST["id"]            ,   PDO::PARAM_STR);
        $stmt->execute();
        $this->dbh=null;
        header("Location: EditDocumento.php?m=2&id=".$_POST["id"]);exit;
    }
    public function add_documento()
    {
        if(empty($_POST["Documento"]) )
        {
            header("Location: AddDocumento.php?m=1");exit;
        }
        //insertar el registro en la tabla clientes
        self::set_names();
        $sql="INSERT INTO documentos
                     values ( NULL , ?);";

        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["Documento"]        ,   PDO::PARAM_STR);
        $stmt->execute();
        //$id=mysql_insert_id();
        $id= $this->dbh->lastInsertId();
        $this->dbh=null;
        header("Location: AddDocumento.php?m=2");exit;
    }
    public function get_documentos()
    {
        self::set_names();
        $sql="SELECT  documentos.*  
              from documentos;";
        foreach ($this->dbh->query($sql) as $row)
        {
            $this->documento[]=$row;
        }  
        return $this->documento;
        $this->dbh=null;
    }
    public function get_documento_por_id($id)
    {
         if(isset($id))
        {
            self::set_names();
            $sql="SELECT * FROM documentos
                  WHERE id=?;";
            $stmt=$this->dbh->prepare($sql);
            if($stmt->execute( array($id) ) )
            {
                while($row = $stmt->fetch())
                {
                    $this->documento[]=$row;
                }
                return $this->documento;
                $this->dbh=null;
            }
        }else
        {
            header("Location: error.php");
        }
    }
    /*************Fin Documento***************/
}
?>