<?php
require_once("ClaseConeccion.php");
class Unidad extends  Coneccion
{
    private $dbh            ;    private $unidad    ;
    public function __construct()
    {
        $this->dbh=parent::conecta();
        $this->unidad  =   array();
    }
    private function set_names()
    {
        return $this->dbh->query("SET NAMES 'utf8'");    
    }
    public function edit_unidad()
    {
        if(empty($_POST["Unidad"]))         
        {
            header("Location: EditUnidad.php?m=1&id=".$_POST["id"]);exit;
        }
        
        
        $id=$_POST["id"];
        
        self::set_names();
        
        $sql="UPDATE unidad SET
                     Codigo_Unidad        =   ? ,
                     Unidad               =   ? ,
                     Sector_Id            =   ?       
            where
                     id                   =   ?";

            $stmt=$this->dbh->prepare($sql);
            $stmt->bindValue(1,$_POST["Codigo_Unidad"]      ,   PDO::PARAM_STR);
            $stmt->bindValue(2,$_POST["Unidad"]             ,   PDO::PARAM_STR);
            $stmt->bindValue(3,$_POST["Sector_Id"]          ,   PDO::PARAM_STR);
            $stmt->bindValue(4,$_POST["id"]                 ,   PDO::PARAM_STR);
        $stmt->execute();
        $this->dbh=null;
        header("Location: EditUnidad.php?m=2&id=".$_POST["id"]);exit;
    }
    public function add_unidad()
    {
        if(empty($_POST["Unidad"]) ) 
        {
            header("Location: AddUnidad.php?m=1");exit;
        }
        self::set_names();

        $sql="INSERT INTO unidad
                     values ( NULL , ?, ?, ?);
        ";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["Codigo_Unidad"]      ,   PDO::PARAM_STR);
        $stmt->bindValue(2,$_POST["Unidad"]             ,   PDO::PARAM_STR);
        $stmt->bindValue(3,$_POST["Sector_Id"]          ,   PDO::PARAM_STR);
        $stmt->execute();
        //$id=mysql_insert_id();
        $id= $this->dbh->lastInsertId();
        $this->dbh=null;
        header("Location: AddUnidad.php?m=2");exit;
    }
    public function get_unidades()
    {
        self::set_names();
        $sql="SELECT  unidad.*  
              from unidad
              ;";
        foreach ($this->dbh->query($sql) as $row)
            {
                $this->perfil[]=$row;
            }  
            return $this->perfil;
            $this->dbh=null;
    }
    public function get_unidad_por_id($id)
    {
        if(isset($id))
        {
            self::set_names();
            $sql="SELECT * FROM unidad 
                  WHERE id=?;";
            $stmt=$this->dbh->prepare($sql);
            if($stmt->execute( array($id) ) )
            {
                while($row = $stmt->fetch())
                {
                    $this->unidad[]=$row;
                }
                return $this->unidad;
                $this->dbh=null;
            }
        }else
        {
            header("Location: error.php");
        }
    }
    public function get_unipob_por_id($id)
    {
        if(isset($id))
        {
            self::set_names();
            $sql="SELECT unipob.unidad_id   , 
                         unidad.unidad 
                  from        unipob
                  inner join  unidad on unidad.id = unipob.unidad_id
                  WHERE unipob.poblacion_id = ?";
            $stmt=$this->dbh->prepare($sql);
            if($stmt->execute( array($id) ) )
            {
                while($row = $stmt->fetch())
                {
                    $this->unidad[]=$row;
                }
                return $this->unidad;
                       $this->dbh=null;
            }
        }else
            {
                header("Location: error.php");
            }
    }
}
?>